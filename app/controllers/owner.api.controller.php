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
        /* if (isset($req->query->filter)) {
            $orderBy = $req->query->filter;
        } */

        $owners = $this->model->getOwners($orderBy, $order, $filter);

        return $this->view->response($owners, 200);
    }

    // /api/propietarios/:id
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

    public function addOwner($req)
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

        $nombre = $req->body->nombre;
        $apellido = $req->body->apellido;
        $imagen = $req->body->imagen;

        $this->model->insertOwner($nombre, $apellido, $imagen);

        return $this->view->response('Propietario creado', 200);
    }
}
