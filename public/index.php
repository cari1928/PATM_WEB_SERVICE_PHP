<?php

require '../vendor/autoload.php';
require '../slimapp.class.php';

$configuration = [
  'settings' => [
    'displayErrorDetails' => true,
  ],
];
$c   = new \Slim\Container($configuration);
$app = new \Slim\App($c);

//funciona!!!
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
  "path"   => "/api",
  "secure" => false,
  "users"  => [
    "root" => "root",
  ],
]));

//routes
require "../controller/WSEmpleado.php";
require "../controller/WSLocal.php";
require "../controller/WSProveedor.php";
require "../controller/WSPuesto.php";
require "../controller/WSServicio.php";
require "../controller/WSTienda.php";
require "../controller/WSAccesoProveedor.php";
require "../controller/WSLocalServicio.php";
require "../controller/WSRenta.php";

$app->run();
