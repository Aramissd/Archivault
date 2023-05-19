<?php

namespace Database\Factories;

use App\Models\Archivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArchivoFactory extends Factory
{
    protected $model = Archivo::class;

    public function definition()
    {
        return [
            'usuario_id' => UsuarioFactory::new(),
            'tamanio_archivo' => $this->faker->randomNumber(3),
        ];
    }
}
