<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL EMPLEADOS
 * necesario para que se queden los 'use'
 */
$app->get('/api/empleado/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    //se obtienen los parámetros
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $empleados = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web       = new Empleado;
      $empleados = $web->getListadoE();
    }

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleados));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE EMPLEADO
 */
$app->get('/api/empleado/{id}', function (Request $request, Response $response) {

  try {
    $id  = $request->getAttribute('id');
    $web = new Empleado;
    $web->setId($id);
    $empleado = $web->getEmpleado();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleado));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * POST ADD EMPLEADO
 */
$app->post('/api/empleado/add', function (Request $request, Response $response) {
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
      'id_puesto'  => $request->getParam('id_puesto'),
    );

    $web = new Empleado;
    $web->setDatos($datos);
    $empleado = $web->insEmpleado();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleado));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE EMPLEADO
 */
$app->put('/api/empleado/update', function (Request $request, Response $response) {
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
      'id_puesto'  => $request->getParam('id_puesto'),
    );

    $web = new Empleado;
    $web->setDatos($datos);
    $empleado = $web->updEmpleado();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleado));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * DELETE EMPLEADO
 */
$app->delete('/api/empleado/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new Empleado;
    $web->conexion();
    $web->setId($id);
    $web->delEmpleado();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Eliminado"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
