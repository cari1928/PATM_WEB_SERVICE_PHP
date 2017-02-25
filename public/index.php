<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../slimapp.class.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
  $name = $request->getAttribute('name');
  $response->getBody()->write("Hello, $name");

  return $response;
});

//empleados Routes
require "../src/routes/empleados.php";

$app->run();
