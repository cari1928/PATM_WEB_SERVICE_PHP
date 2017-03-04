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
$app->get('/api/empleado/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $empleado = array('status'=>"No se pudo obtener el empleado");
    if($bitacora->validaToken()) {
      $web = new Empleado;
      $web->setId($request->getAttribute('id'));
      $empleado = $web->getEmpleado();
    }

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
$app->post('/api/empleado/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $empleado = array('status'=>"No se pudo insertar");
    if($bitacora->validaToken()) {
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
    }

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
$app->put('/api/empleado/update/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $empleado = array('status'=>"No se pudo actualizar");
    if($bitacora->validaToken()) {
      $datos = array(
        'id'         => $request->getParam('id'),
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
    }

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
$app->delete('/api/empleado/delete/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $empleado = array('status'=>"No se pudo eliminar");
    if($bitacora->validaToken()) {
      $id = $request->getAttribute('id');
      $web = new Empleado;
      $web->conexion();
      $web->setId($id);
      $web->delEmpleado();
      $empleado = array('status'=>"Eliminado");
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($empleado));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
