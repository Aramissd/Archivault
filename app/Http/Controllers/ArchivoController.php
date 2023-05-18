<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Archivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador para la gestión de archivos.
 */
class ArchivoController extends Controller
{
    /**
     * Función para convertir el tamaño del archivo a una unidad de medida legible.
     *
     * @param int $sizeInBytes Tamaño del archivo en bytes.
     * @return string Tamaño del archivo convertido a la unidad apropiada (Bytes, KB, MB, GB).
     */
    function adaptiveFileSize($sizeInBytes) {
        $sizeInKB = $sizeInBytes / 1024;
        $sizeInMB = $sizeInKB / 1024;
        $sizeInGB = $sizeInMB / 1024;
    
        if ($sizeInGB > 1) {
            return number_format($sizeInGB, 2) . " GB";
        } else if ($sizeInMB > 1) {
            return number_format($sizeInMB, 2) . " MB";
        } else if ($sizeInKB > 1) {
            return number_format($sizeInKB, 2) . " KB";
        } else {
            return $sizeInBytes . " Bytes";
        }
    }
    
    
    
     /**
     * Función para calcular el total de almacenamiento utilizado por un usuario.
     *
     * @param int $userId ID del usuario.
     * @return int Total de almacenamiento utilizado por el usuario en bytes.
     */
      public function getTotalStorageUsedByUser($userId)
      {
          $archivos = Archivo::where('usuario_id', $userId)->get();
          $totalStorageUsed = 0;
  
          foreach ($archivos as $archivo) {
              $totalStorageUsed += $archivo->tamanio_archivo * 1024;
          }
  
          return $totalStorageUsed;
      }

    

 /**
     * Método para eliminar un archivo.
     *
     * @param int $id ID del archivo.
     * @return \Illuminate\Http\Response Respuesta HTTP.
     */
    public function destroy($id)
    {
        
        $archivo = Archivo::find($id);
        if ($archivo) {
            $archivo->delete();
        }
        $file_path = storage_path('app/public/' . Auth::id() . '/' . $archivo->nombre);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    
        // Calcula el total de almacenamiento utilizado después de la eliminación del archivo
        $totalStorageUsed = Archivo::where('usuario_id', Auth::id())->sum('tamanio_archivo');
    
        return response()->json([
            'nombre' => $archivo->nombre,
            'tipo' => $archivo->tipo,
            'ruta' => $archivo->ruta,
            'tamanio_archivo' => $archivo->tamanio_archivo,
            'id' => $archivo->id,
            'usuario_id' => $archivo->usuario_id,
            'totalStorageUsed' => $totalStorageUsed  // Envia el total del almacenamiento utilizado
        ]);    
            // Guarda el totalStorageUsed en una variable de sesión

    }

    
    

  /**
     * Método para mostrar los archivos del usuario autenticado.
     *
     * @return  \Illuminate\Http\Response Respuesta HTTP.
     */
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $archivos = $user->archivos;
        $userId = auth()->id();
        $totalStorageUsed = $this->getTotalStorageUsedByUser($userId);
        $storageLimit = 2 * 1024 * 1024; // 2 GB en kilobytes

        return view('inicio', ['archivos' => $archivos, 'totalStorageUsed' => $totalStorageUsed, 'storage_limit' => $storageLimit]);
    }
     /**
     * Método para almacenar un archivo subido por el usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request Request HTTP con el archivo subido.
     * @return \Illuminate\Http\JsonResponse Respuesta HTTP en formato JSON.
     */
    public function store(Request $request)
    {
        try {

            
            $carpetaUsuario = Auth::id();
    
            // Crear la carpeta del usuario si no existe
            $carpetaUsuarioPath = 'public/' . $carpetaUsuario;
            if (!Storage::exists($carpetaUsuarioPath)) {
                Storage::makeDirectory($carpetaUsuarioPath);
            }
            //Limite de almacenamiento 
            $currentStorage = $this->getTotalStorageUsedByUser(Auth::id());
            $storageLimit = 2 * 1024 * 1024; // 2 GB en kilobytes


            $newFileSize = $request->file('archivo')->getSize() / 1024;

            if ($currentStorage + $newFileSize > $storageLimit) {
                return response()->json([
                    'error' => 'Se ha superado el límite de almacenamiento de 2 GB.',
                ], 400);
            }

            $archivo = $request->file('archivo');
            $nombreArchivo = $archivo->getClientOriginalName();
    
            $totalChunks = (int)$request->input('totalChunks', 1);
            $currentChunk = (int)$request->input('currentChunk', 0);
    
            $tempPath = storage_path('app/chunks/' . $nombreArchivo . '-' . $currentChunk);

            $archivo->move(dirname($tempPath), basename($tempPath));
    
            if ($currentChunk === $totalChunks - 1) {
                $finalPath = 'public/' . $carpetaUsuario . '/' . $nombreArchivo;
                $ruta = Storage::path($finalPath);
    
                $outputFile = fopen($ruta, 'wb');
    
                for ($i = 0; $i < $totalChunks; $i++) {
                    $chunkPath = storage_path('app/chunks/' . $nombreArchivo . '-' . $i);
                    $chunkFile = fopen($chunkPath, 'rb');
    
                    stream_copy_to_stream($chunkFile, $outputFile);
    
                    fclose($chunkFile);
                    unlink($chunkPath);
                }
    
                fclose($outputFile);
    
                $size_file = filesize($ruta) / 1024;
                
                $extension = pathinfo($ruta, PATHINFO_EXTENSION);
    
                $archivo = new Archivo();
                $archivo->nombre = $nombreArchivo;
                $archivo->ruta = $finalPath;
                $archivo->usuario_id = Auth::user()->id;
                $archivo->tipo = $extension;
                $archivo->tamanio_archivo = $size_file;
    
                $archivo->save();
    
                return response()->json([
                    'nombre' => $nombreArchivo,
                    'tipo' => $extension,
                    'ruta' => $ruta,
                    'tamanio' => $size_file,
                    'id' => $archivo->id,
                    'usuario_id' => $carpetaUsuario,
                ]);
            }
    
            return response()->json([
                'message' => 'Chunk ' . $currentChunk . ' uploaded.',
            ]);

        } catch (\Exception $e) {
            Log::error('Error al cargar el archivo: ' . $e->getMessage());
    
            // Devuelve una respuesta de error al cliente
            return response()->json([
                'error' => 'Error al cargar el archivo: ' . $e->getMessage(),
            ], 500);
        }
    }

    


}



?>


