<?php

require '../vendor/autoload.php';
require '../slimapp.class.php';

$app = new \Slim\App;

//routes
require "../controller/WSEmpleado.php";
require "../controller/WSLocal.php";
require "../controller/WSProveedor.php";
require "../controller/WSPuesto.php";
require "../controller/WSServicio.php";
require "../controller/WSTienda.php";
require "../controller/WSAccesoProveedor.php";

$app->run();
