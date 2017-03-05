<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL SERVICIOS
 */
$app->get('/api/servicio/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $servicios = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web       = new Servicio;
      $servicios = $web->getListadoS();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($servicios));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE SERVICIO
 */
$app->get('/api/servicio/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $servicio = array('status'=>"No se pudo obtener el servicio");
    if($bitacora->validaToken()) {
      $id  = $request->getAttribute('id');
      $web = new Servicio;
      $web->setId($id);
      $servicio = $web->getServicio();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($servicio));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * POST ADD SERVICIO
 */
$app->post('/api/servicio/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $servicio = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $datos = array(
        'servicio' => $request->getParam('servicio'),
        'precio'   => $request->getParam('precio'),
      );

      $web = new Servicio;
      $web->setDatos($datos);
      $servicio = $web->insServicio();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($servicio));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE SERVICIO
 */
$app->put('/api/servicio/update/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $servicio = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $id    = $request->getParam('id');
      $datos = array(
        'id'       => $id,
        'servicio' => $request->getParam('servicio'),
        'precio'   => $request->getParam('precio'),
      );

      $web = new Servicio;
      $web->setDatos($datos);
      $servicio = $web->updServicio();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($servicio));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * DELETE SERVICIO
 */
$app->delete('/api/servicio/delete/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $servicio = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $id = $request->getAttribute('id');
      $web = new Servicio;
      $web->conexion();
      $web->setId($id);
      $web->delServicio();
      $servicio = array('status'=>"Eliminado");
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($servicio));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
