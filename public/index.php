<?php

require '../vendor/autoload.php';
require '../slimapp.class.php';

$app = new \Slim\App;

//routes
require "../controller/WSEmpleado.php";
require "../controller/WSLocal.php";
require "../controller/WSProveedor.php";

$app->run();
