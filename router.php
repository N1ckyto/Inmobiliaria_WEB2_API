<?php

require_once 'libs/router.php';

require_once 'app/controllers/property.api.controller.php';
require_once 'app/controllers/owner.api.controller.php';
//require_once 'app/middlewares/jwt.auth.middleware.php';
$router = new Router();

//$router->addMiddleware(new JWTAuthMiddleware());

#                 endpoint        verbo      controller              metodo
$router->addRoute('propiedades',            'GET',     'PropertyApiController',   'getPropertyAll');
$router->addRoute('propiedades/:id',            'GET',     'PropertyApiController',   'getProperty');
$router->addRoute('propietarios',            'GET',     'OwnerApiController',   'getOwnerAll');
$router->addRoute('propietarios/:id',            'GET',     'OwnerApiController',   'getOwner');
//$router->addRoute('tareas/:id',            'DELETE',  'TaskApiController',   'delete');
//$router->addRoute('tareas',                'POST',    'TaskApiController',   'create');
//$router->addRoute('tareas/:id',            'PUT',     'TaskApiController',   'update');
//$router->addRoute('tareas/:id/finalizada', 'PUT',     'TaskApiController',   'setFinalize');

//$router->addRoute('usuarios/token',            'GET',     'UserApiController',   'getToken');

//print_r($_SERVER); para ver lo que contiene el server
//die();
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
