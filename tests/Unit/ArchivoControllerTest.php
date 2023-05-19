<?php

namespace Tests\Unit;

use App\Models\Usuario;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Archivo;
use App\Http\Controllers\ArchivoController;

class ArchivoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetTotalStorageUsedByUser()
    {
        $user = Usuario::factory()->create();
        Archivo::factory()->create(['usuario_id' => $user->id, 'tamanio_archivo' => 512]);
        Archivo::factory()->create(['usuario_id' => $user->id, 'tamanio_archivo' => 512]);

        $controller = new ArchivoController();

        $this->assertEquals(1024, $controller->getTotalStorageUsedByUser($user->id));
    }
}
