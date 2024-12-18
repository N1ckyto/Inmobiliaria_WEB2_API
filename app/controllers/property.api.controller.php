<?php
require_once './app/models/property.model.php';
require_once './app/views/json.view.php';

class PropertyApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new PropertyModel();
        $this->view = new JSONView();
    }

    public function getPropertyAll($req)
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

        $page = isset($req->query->page) ? (int) $req->query->page : 1;
        $limit = isset($req->query->limit) ? (int) $req->query->limit : 10;

        $properties = $this->model->getProperties($orderBy, $order, $filter, $valor, $page, $limit);

        return $this->view->response($properties, 200);
    }

    public function getProperty($req)
    {
        $id = $req->params->id;

        $properties = $this->model->getProperty($id);

        if (!$properties) {
            return $this->view->response("La propiedad con el id=$id no existe", 404);
        }

        return $this->view->response($properties, 200);
    }

    public function update($req)
    {
        $id = $req->params->id;

        $properties = $this->model->getProperty($id);

        if (!$properties) {
            return $this->view->response("La propiedad con el id=$id no existe", 404);
        }

        $this->validateFields($req); // codigo reutilizado para validar los campos

        $ubicacion = $req->body->ubicacion;
        $m2 = $req->body->m2;
        $modalidad = $req->body->modalidad;
        $id_propietario = $req->body->id_propietario;
        $precio_inicial = $req->body->precio_inicial;
        $precio_flex = $req->body->precio_flex;
        $imagen = $req->body->imagen;

        $this->model->updateProperty($id, $ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen);

        $properties = $this->model->getProperty($id);
        $this->view->response($properties, 200);
    }

    public function addProperty($req)
    {
        $this->validateFields($req);

        $ubicacion = $req->body->ubicacion;
        $m2 = $req->body->m2;
        $modalidad = $req->body->modalidad;
        $precio_inicial = $req->body->precio_inicial;
        $precio_flex = $req->body->precio_flex;
        $id_propietario = $req->body->id_propietario;
        $imagen = $req->body->imagen;


        $this->model->insertProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen);

        return $this->view->response('Propiedad agregada con exito', 200);
    }

    private function validateFields($req)
    {
        if (!isset($req->body->ubicacion) || empty($req->body->ubicacion)) {
            return $this->view->response('Falta completar la ubicación', 400);
        }
        if (!isset($req->body->m2) || empty($req->body->m2)) {
            return $this->view->response('Falta completar los metros cuadrados', 400);
        }
        if (!isset($req->body->modalidad) || empty($req->body->modalidad)) {
            return $this->view->response('Falta completar la modalidad', 400);
        }
        if (!isset($req->body->precio_inicial) || empty($req->body->precio_inicial)) {
            return $this->view->response('Falta completar el precio inicial', 400);
        }
        if (!isset($req->body->precio_flex)) {
            return $this->view->response('Falta completar si el precio es flexible', 400);
        }
        if (!isset($req->body->id_propietario) || empty($req->body->id_propietario)) {
            return $this->view->response('Falta completar quien es el propietario', 400);
        }
        if (!isset($req->body->imagen) || empty($req->body->imagen)) {
            return $this->view->response('Falta completar la URL de la imagen', 400);
        }
    }
}
