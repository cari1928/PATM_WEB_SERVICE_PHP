<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

//GET ALL EMPLEADOS
//necesario para que se queden los 'use'
$app->get('/api/empleados', function (Request $request, Response $response) {
  try {
    $web = new SlimApp;
    $web->conexion();

    $empleados = array();
    $query     = "SELECT * FROM empleado";
    $statement = $web->conn->Prepare($query);
    $statement->Execute();
    $empleados = $statement->FetchAll(PDO::FETCH_ASSOC);
    $web       = null;

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleados));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

//GET SINGLE EMPLEADO
$app->get('/api/empleados/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new SlimApp;
    $web->conexion();

    $query     = "SELECT * FROM empleado WHERE id=" . $id;
    $empleado  = array();
    $statement = $web->conn->Prepare($query);
    $statement->Execute();
    $empleado = $statement->FetchAll(PDO::FETCH_ASSOC);
    $web      = null;

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleado));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

//POST ADD EMPLEADO
$app->post('/api/empleados/add', function (Request $request, Response $response) {
  try {
    $datos = array(
      'nombre'     => $request->getParam('nombre'),
      'apellido_p' => $request->getParam('apellido_p'),
      'apellido_m' => $request->getParam('apellido_m'),
      'rfc'        => $request->getParam('rfc'),
      'direccion'  => $request->getParam('direccion'),
      'correo'     => $request->getParam('correo'),
      'tel_casa'   => $request->getParam('tel_casa'),
      'tel_cel'    => $request->getParam('tel_cel'),
      'genero'     => $request->getParam('genero'),
    );
    //llave foranea pendiente!!!

    $web = new SlimApp;
    $web->conexion();

    $web->setTabla('empleado');
    $web->insert($datos);

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Empleado Added"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

//PUT UPDATE EMPLEADO
$app->put('/api/empleados/update', function (Request $request, Response $response) {
  try {
    $id    = $request->getParam('id');
    $datos = array(
      'id'         => $id,
      'nombre'     => $request->getParam('nombre'),
      'apellido_p' => $request->getParam('apellido_p'),
      'apellido_m' => $request->getParam('apellido_m'),
      'rfc'        => $request->getParam('rfc'),
      'direccion'  => $request->getParam('direccion'),
      'correo'     => $request->getParam('correo'),
      'tel_casa'   => $request->getParam('tel_casa'),
      'tel_cel'    => $request->getParam('tel_cel'),
      'genero'     => $request->getParam('genero'),
    );
    //llave foranea pendiente!!!

    $web = new SlimApp;
    $web->conexion();

    $web->setTabla('empleado');
    $web->update($datos, array('id' => $id));

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Empleado Updated"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

//DELETE EMPLEADO
$app->delete('/api/empleados/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new SlimApp;
    $web->conexion();

    $web->setTabla('empleado');
    $web->delete(array('id' => $id));

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Empleado Deleted"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
