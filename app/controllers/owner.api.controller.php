<?php
require_once './app/models/owner.model.php';
require_once './app/views/json.view.php';

class OwnerApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new OwnerModel(); // Adaptado a OwnerModel
        $this->view = new JSONView();
    }

    public function getOwnerAll($req, $res)
    {
        $orderBy = false;

        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }

        $owners = $this->model->getOwners($orderBy);

        return $this->view->response($owners);
    }

    // /api/propietarios/:id
    public function getOwner($req, $res)
    {

        $id = $req->params->id;
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->response("No existe el propietario con el id=$id", 404);
        }

        return $this->view->response($owner);
    }

    public function update($req, $res)
    {
        $id = $req->params->id;

        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->response("El propietario con el id=$id no existe", 404);
        }

        if (empty($req->body->nombre) || empty($req->body->apellido) || empty($req->body->imagen)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $apellido = $req->body->apellido;
        $imagen = $req->body->imagen;

        $this->model->updateOwner($id, $nombre, $apellido, $imagen);

        $owner = $this->model->getOwner($id);
        $this->view->response($owner, 200);
    }
    
    /* public function addOwners()
    {
        // Obtiene las propiedades de la DB
        $owners = $this->model->getOwners();

        // Envía las propiedades a la vista
        return $this->view->addOwners($owners);
    }
    public function addOwner()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError('Falta completar el apellido');
        }
        if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
            return $this->view->showError('Falta completar la imagen');
        }


        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $imagen = $_POST['imagen'];


        $id = $this->model->insertOwner($nombre, $apellido, $imagen);


        $owners = $this->model->getOwners();

        return $this->view->showOwners($owners);
    }

    public function viewOwner($id)
    {
        $owner = $this->model->getOwner($id);
        $properties = $this->model->countPropertiesByOwner($id);
        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Envía el propietario a la vista
        return $this->view->viewOwner($owner, $properties);
    }

    public function updateOwner()
    {
        $id = $_POST['id'];
        // Valida si el propietario existe
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Actualiza el propietario (puedes ajustar los campos a actualizar según tus necesidades)
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $imagen = $_POST['imagen'];

        $this->model->updateOwner($id, $nombre, $apellido, $imagen);
        return $this->view->showAlert("Propietario editado!");
    }

    public function deleteOwner($id)
    {
        // Valida si el propietario existe
        $owner = $this->model->getOwner($id);
        $properties = $this->model->countPropertiesByOwner($id);
        if ($properties > 0) {
            return $this->view->showError("No se puede borrar un propietario con $properties propiedades a su nombre, borralas primero");
        }
        // Elimina el propietario de la base de datos
        $this->model->deleteOwner($id);

        return $this->view->showAlert("Propietario eliminado!");
    } */
}
