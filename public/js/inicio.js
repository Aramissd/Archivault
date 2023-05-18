var totalStorageUsed = parseInt(window.totalStorageUsed);
const STORAGE_LIMIT = 2 * 1024 * 1024; // 2 GB, por ejemplo

function adaptiveFileSize(sizeInBytes) {
  const sizeInKB = sizeInBytes / 1024;
  const sizeInMB = sizeInKB / 1024;
  const sizeInGB = sizeInMB / 1024;

  if (sizeInGB > 1) {
      return sizeInGB.toFixed(2) + " GB";
  } else if (sizeInMB > 1) {
      return sizeInMB.toFixed(2) + " MB";
  } else  {
      return sizeInKB.toFixed(2) + " KB";
  }
}

$(document).on('click', '.delete-btn', function(event) {
  event.preventDefault();
  var form = $(this).closest('form');
  var url = form.attr('action');
  $.ajax({
      url: url,
      type: 'POST',
      data: {
          _method: 'DELETE',
          _token: $('meta[name="csrf-token"]').attr('content')
          
      },
      success: function(data) {
          totalStorageUsed = data.totalStorageUsed * 1024;  // Actualiza totalStorageUsed con el valor del servidor
          form.closest('.archivo-card').remove();
          $('#storage-used').html(`Total de almacenamiento usado: <strong>${adaptiveFileSize(totalStorageUsed)} </strong>`);
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
      }
  });
});
  


$(document).ready(function() {
  var $archivoInput = $("#archivo");
  var chunkSize = 1024 * 1024 * 100; // Tamaño del fragmento en bytes (100 MB en este caso)
  var $modalOverlay = $(".modal-overlay");
  var $modalClose = $(".modal-close");

  $modalClose.on("click", function () {
    $modalOverlay.hide();
  });


  $archivoInput.on("change", async function (e) {
     

        var file = e.target.files[0];
        var totalChunks = Math.ceil(file.size / chunkSize);
        var currentChunk = 0;


        var totalStorageUsedKB = Math.round(totalStorageUsed / 1024);
        var totalFileSizeKB = Math.round(file.size / 1024);
        
        var currentStorageKB = Math.round(totalStorageUsed / 1024);
        var remainingStorageKB = STORAGE_LIMIT - currentStorageKB;
        
        if (totalFileSizeKB > remainingStorageKB || totalStorageUsedKB >= STORAGE_LIMIT) {
          $modalOverlay.show();
          return;
        }
        

  

      function uploadNextChunk() {
      
          var start = currentChunk * chunkSize;
          var end = Math.min(file.size, start + chunkSize);
          var chunk = file.slice(start, end);

          var formData = new FormData();
          formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
          formData.append("archivo", chunk, file.name);
          formData.append("totalChunks", totalChunks);
          formData.append("currentChunk", currentChunk);

          

          
          $.ajax({
              url: window.routes.archivosStore,
              type: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                console.log(data);
                currentChunk++;
              
                

                  // Agregar el nuevo archivo a la vista
                var nombreArchivo = data.nombre;
                // var tipoArchivo = data.tipo;
                // var rutaArchivo = data.ruta;
    
                // var tamanioArchivo = data.tamanio;
                var id = data.id;
                console.log(data);
                $('.result').html('<div class="file-uploaded"><p>El archivo se está subiendo...</p></div>');
                var destroyUrl = routes.archivosDestroy.replace(':id', id);
                var $nuevoArchivo = $(`
                  <div class="archivo-card">
                      <div class="descripcion">
                          <p>${nombreArchivo}</p>
                      </div>
                    <div class="acciones">
                      <a href="${Laravel.storageUrl}/${Laravel.authId}/${nombreArchivo}" class="download-btn" download>
                        <span class="material-symbols-outlined">download</span>
                      </a>
                      <form method="POST" action="${destroyUrl}">
                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="delete-btn">
                          <span class="material-symbols-outlined">delete</span>
                        </button>
                      </form>
                    </div>
                  </div>
                `);
             
                if (currentChunk >= totalChunks) {
                  // Todos los fragmentos han sido cargados
                  $archivoInput.val("");
                  $('.progress').hide();
                  $('.result').html('<div class="file-uploaded"><p>El archivo se ha subido con exito</p></div>');
                  $('.archivos-list').append($nuevoArchivo);
                   //Delete message in div result after 10 seconds
                  setTimeout(function() {
                    $('.file-uploaded').html('');
                  }
                  , 10000);

                  var fileSizeInBytes = file.size;
                  var fileSizeInKB = Math.round(fileSizeInBytes / 1024);
                  totalStorageUsed += fileSizeInKB * 1024;
                  
                  $('#storage-used').html(`Total de almacenamiento usado: <strong>${adaptiveFileSize(totalStorageUsed)}</strong>`);
                           
                  return;
               }
                uploadNextChunk();
                },
                error: function (xhr, status, error) {

                    console.error("Error al cargar el archivo:", error);
                    //Add error message to div result

                  
                    

                },
            });
        }

        uploadNextChunk();
    });




  });


 
  