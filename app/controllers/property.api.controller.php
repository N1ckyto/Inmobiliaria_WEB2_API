<?php
require_once './app/models/property.model.php';
require_once './app/views/json.view.php';

class PropertyApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new PropertyModel(); // Adaptado a PropertyModel
        $this->view = new JSONView();
    }

    public function getPropertyAll($req, $res)
    {
        $modalidad = null;
        $page = null;
        $pageSize = null;

        if (isset($req->query->order)) {
            $order = $req->query->order;
        }

        $orderBy = false;

        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }

        $properties = $this->model->getProperties($order, $orderBy, $page, $pageSize);

        return $this->view->response($properties, 200);
    }

    // /api/propiedades/:id
    public function getProperty($req, $res)
    {

        $id = $req->params->id;

        $properties = $this->model->getProperty($id);

        if (!$properties) {
            return $this->view->response("La propiedad con el id=$id no existe", 404);
        }

        return $this->view->response($properties, 200);
    }

    public function update($req, $res)
    {
        $id = $req->params->id;

        $properties = $this->model->getProperty($id);

        if (!$properties) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

        if (empty($req->body->ubicacion) || empty($req->body->m2) || empty($req->body->modalidad) || empty($req->body->id_propietario) || empty($req->body->precio_inicial) || empty($req->body->precio_flex) || empty($req->body->imagen)) {
            return $this->view->response('Faltan completar datos', 400);
        }

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

    public function addProperty($req, $res)
{
    if (!isset($req->body['ubicacion']) || empty($req->body['ubicacion'])) {
        return $res->send($this->view->showError('Falta completar la ubicación'));
    }
    if (!isset($req->body['m2']) || empty($req->body['m2'])) {
        return $res->send($this->view->showError('Falta completar los metros cuadrados'));
    }
    if (!isset($req->body['modalidad']) || empty($req->body['modalidad'])) {
        return $res->send($this->view->showError('Falta completar la modalidad'));
    }
    if (!isset($req->body['precio_inicial']) || empty($req->body['precio_inicial'])) {
        return $res->send($this->view->showError('Falta completar el precio inicial'));
    }
    if (!isset($req->body['precio_flexible'])) {
        return $res->send($this->view->showError('Falta completar si el precio es flexible'));
    }
    if (!isset($req->body['propietario']) || empty($req->body['propietario'])) {
        return $res->send($this->view->showError('Falta completar quien es el propietario'));
    }


    if (!isset($req->body['imagen']) || empty($req->body['imagen'])) {
        return $res->send($this->view->showError('Falta completar la URL de la imagen'));
    }


    $ubicacion = $req->body['ubicacion'];
    $m2 = $req->body['m2'];
    $modalidad = $req->body['modalidad'];
    $precio_inicial = $req->body['precio_inicial'];
    $precio_flex = isset($req->body['precio_flexible']) ? $req->body['precio_flexible'] : 0;
    $id_propietario = $req->body['propietario'];
    $imagen = $req->body['imagen'];


    $id = $this->model->insertProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen);

    $properties = $this->model->getProperties();
    $owners = $this->model->getOwners();

    return $res->send($this->view->addProperties($properties, $owners));
}



    public function showDetails($id)
    {
        // Obtiene los detalles de la propiedad por id
        $propertyDetails = $this->model->getDetails($id);

        // Envía los detalles a la vista
        return $this->view->viewDetails($propertyDetails);
    }

    public function showEdit($id)
    {
        $property = $this->model->getProperty($id);
        if (!$property) {
            return $this->view->showError("No existe la propiedad con el id=$id");
        }
        $propertyDetails = $this->model->getDetails($id);
        $owners = $this->model->getOwners();
        return $this->view->showEdit($id, $propertyDetails, $property, $owners);
    }

    public function updateProperty()
    {
        if (!isset($_POST['ubicacion']) || empty($_POST['ubicacion'])) {
            return $this->view->showError('Falta completar la ubicación');
        }
        if (!isset($_POST['m2']) || empty($_POST['m2'])) {
            return $this->view->showError('Falta completar los metros cuadrados');
        }
        if (!isset($_POST['modalidad']) || empty($_POST['modalidad'])) {
            return $this->view->showError('Falta completar la modalidad');
        }
        if (!isset($_POST['precio_inicial']) || empty($_POST['precio_inicial'])) {
            return $this->view->showError('Falta completar el precio inicial');
        }
        if (!isset($_POST['precio_flexible'])) {
            return $this->view->showError('Falta completar si el precio es flexible');
        }
        if (!isset($_POST['propietario']) || empty($_POST['propietario'])) {
            return $this->view->showError('Falta completar quien es el propietario');
        }

        // Opcional: validación para imagen
        if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
            return $this->view->showError('Falta completar la URL de la imagen');
        }

        // Obtiene los datos del formulario
        $ubicacion = $_POST['ubicacion'];
        $m2 = $_POST['m2'];
        $modalidad = $_POST['modalidad'];
        $precio_inicial = $_POST['precio_inicial'];
        $precio_flex = isset($_POST['precio_flexible']) ? $_POST['precio_flexible'] : 0;
        $id_propietario = $_POST['propietario'];
        $imagen = $_POST['imagen']; // Nueva línea para agregar la imagen
        $id = $_POST['id'];

        //Actualiza la propiedad (ajustar los campos a actualizar según tus necesidades)
        $property = $this->model->updateProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen, $id);
        return $this->view->showAlert("Propiedad editada!");
    }

    public function deleteProperty($id)
    {
        // Valida si la propiedad existe
        $property = $this->model->getProperty($id);

        if (!$property) {
            return $this->view->showAlert("Propiedad eliminada exitosamente!");
        }

        // Elimina la propiedad de la base de datos
        $this->model->deleteProperty($id);

        header('Location: ' . BASE_URL);
    } 
}
