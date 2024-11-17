<?php
require_once './app/models/owner.model.php';
require_once './app/views/json.view.php';

class OwnerApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new OwnerModel();
        $this->view = new JSONView();
    }

    public function getOwnerAll($req)
    {
        $order = null;

        if (isset($req->query->order)) {
            $order = $req->query->order;
        }

        $orderBy = false;

        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }

        $filter = false;
        if (isset($req->query->filter)) {
            $filter = $req->query->filter;
        }

        $valor = false;
        if (isset($req->query->valor)) {
            $valor = $req->query->valor;
        }

        $owners = $this->model->getOwners($orderBy, $order, $filter, $valor);

        if(!$owners) {
            return $this->view->response("No existe el o los propietarios que cumplan los requisitos", 404);
        };

        return $this->view->response($owners, 200);
    }

    public function getOwner($req)
    {
        $id = $req->params->id;

        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->response("No existe el propietario con el id=$id", 404);
        }

        return $this->view->response($owner, 200);
    }

    public function update($req)
    {
        $id = $req->params->id;

        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->response("El propietario con el id=$id no existe", 404);
        }

        $this->validateFields($req); // codigo reutilizado para validar los campos

        $nombre = $req->body->nombre;
        $apellido = $req->body->apellido;
        $imagen = $req->body->imagen;

        $this->model->updateOwner($id, $nombre, $apellido, $imagen);

        $owner = $this->model->getOwner($id);
        $this->view->response($owner, 200);
    }

    public function addOwner($req)
    {
        $this->validateFields($req); // codigo reutilizado para validar los campos

        $nombre = $req->body->nombre;
        $apellido = $req->body->apellido;
        $imagen = $req->body->imagen;

        $this->model->insertOwner($nombre, $apellido, $imagen);

        return $this->view->response('Propietario creado exitosamente', 200);
    }

    private function validateFields($req)
    {
        if (!isset($req->body->nombre) || empty($req->body->nombre)) {
            return $this->view->response('Falta completar el nombre', 400);
        }
        if (!isset($req->body->apellido) || empty($req->body->apellido)) {
            return $this->view->response('Falta completar el apellido', 400);
        }
        if (!isset($req->body->imagen) || empty($req->body->imagen)) {
            return $this->view->response('Falta completar la imagen', 400);
        }
    }
}
