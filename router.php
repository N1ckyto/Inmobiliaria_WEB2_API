<?php

require_once 'libs/router.php';

require_once 'app/controllers/property.api.controller.php';
require_once 'app/controllers/owner.api.controller.php';

$router = new Router();

#                   endpoint            verbo            controller                metodo
$router->addRoute('propiedades',        'GET',     'PropertyApiController',   'getPropertyAll');
$router->addRoute('propiedades',        'POST',    'PropertyApiController',   'addProperty');
$router->addRoute('propiedades/:id',    'GET',     'PropertyApiController',   'getProperty');
$router->addRoute('propiedades/:id',    'PUT',     'PropertyApiController',   'update');

$router->addRoute('propietarios',       'GET',     'OwnerApiController',      'getOwnerAll');
$router->addRoute('propietarios',       'POST',    'OwnerApiController',      'addOwner');
$router->addRoute('propietarios/:id',   'GET',     'OwnerApiController',      'getOwner');
$router->addRoute('propietarios/:id',   'PUT',     'OwnerApiController',      'update');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
