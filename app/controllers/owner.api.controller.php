<?php
require_once '../views/json.view.php';
require_once '../models/owner.model.php';

class OwnerApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new OwnerModel(); 
        $this->view = new JSONView();
    }

    public function getOwnerAll($req, $res)
    {
        $order = null;

        if (isset($req->query->order)) {
            $order = $req->query->order;
        }

        $orderBy = false;
        $filter = false; // filtra por cantidad de propiedades

        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }

        $owners = $this->model->getOwners($orderBy, $order);

        return $this->view->response($owners, 200);
    }

    // /api/propietarios/:id
    public function getOwner($req, $res)
    {

        $id = $req->params->id;
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->response("No existe el propietario con el id=$id", 404);
        }

        return $this->view->response($owner, 200);
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
    

    public function addOwner($req, $res)
    {
      
        if (!isset($req->body['nombre']) || empty($req->body['nombre'])) {
            return $res->send($this->view->showError('Falta completar el nombre'));

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
        if (!isset($req->body['apellido']) || empty($req->body['apellido'])) {
            return $res->send($this->view->showError('Falta completar el apellido'));
        }
        if (!isset($req->body['imagen']) || empty($req->body['imagen'])) {
            return $res->send($this->view->showError('Falta completar la imagen'));
        }
    

        $nombre = $req->body['nombre'];
        $apellido = $req->body['apellido'];
        $imagen = $req->body['imagen'];
    

        $id = $this->model->insertOwner($nombre, $apellido, $imagen);
    

        $owners = $this->model->getOwners();
    
        return $res->send($this->view->showOwners($owners));
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
