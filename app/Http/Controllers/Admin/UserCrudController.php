<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Controlador UserCrudController
 * 
 * Controlador que gestiona las operaciones CRUD para el modelo Usuario en el panel de administración.
 * 
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configura el objeto CrudPanel. Aplica configuraciones a todas las operaciones.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Usuario::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('usuario', 'usuarios');
    }

    /**
     * Define lo que sucede cuando se carga la operación List.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // Define las columnas que se mostrarán en la lista
        CRUD::column('nombre')->type('string');
        CRUD::column('apellidos')->type('string');
        CRUD::column('email')->type('string');
        CRUD::column('rol')->type('string');
        CRUD::column('password')->type('string');
        CRUD::column('email_verified_at')->type('date');
        CRUD::column('remember_token')->type('string');
    }

    /**
     * Define lo que sucede cuando se carga la operación Create.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        // Define los campos que se mostrarán en el formulario de creación
        CRUD::addField(['name' => 'nombre', 'type' => 'text', 'label' => 'Nombre']);
        CRUD::addField(['name' => 'apellidos', 'type' => 'text', 'label' => 'Apellidos']);
        CRUD::addField(['name' => 'email', 'type' => 'email', 'label' => 'Email']);
        CRUD::addField(['name' => 'rol', 'type' => 'text', 'label' => 'Rol']);
        CRUD::addField(['name' => 'password', 'type' => 'password', 'label' => 'Contraseña']);
    }

    /**
     * Define lo que sucede cuando se carga la operación Update.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
