<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivos';

    public $timestamps = false;

    /**
     * Define la relación con el modelo Usuario.
     * Un archivo pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Define la relación con el modelo Archivo.
     * Un archivo puede tener muchos archivos asociados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
