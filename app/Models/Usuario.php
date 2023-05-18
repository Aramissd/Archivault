<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

/**
 * Modelo Usuario
 *
 * Representa la tabla de usuarios en la base de datos.
 * Proporciona funcionalidad para la autenticación y autorización de usuarios.
 */
class Usuario extends Model implements AuthenticatableContract, CanResetPassword, MustVerifyEmail
{
    use Authenticatable;
    use Notifiable, CanResetPasswordTrait;
    use \Illuminate\Auth\MustVerifyEmail;
    use CrudTrait;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'rol',
        'password',
    ];

    /**
     * Indica si se deben registrar los timestamps en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Obtiene el identificador de autenticación del usuario.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Obtiene la contraseña de autenticación del usuario.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Relación con el modelo Archivo.
     * Un usuario puede tener muchos archivos asociados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
