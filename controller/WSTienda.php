<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL TIENDAS
 */
$app->get('/api/tienda/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $tiendas = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web     = new Tienda;
      $tiendas = $web->getListadoT();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($tiendas));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE TIENDA
 */
$app->get('/api/tienda/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $tienda = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $id  = $request->getAttribute('id');
      $web = new Tienda;
      $web->setId($id);
      $tienda = $web->getTienda();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($tienda));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * POST ADD TIENDA
 */
$app->post('/api/tienda/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $tienda = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $datos = array(
        'nombre'     => $request->getParam('nombre'),
        'h_apertura' => $request->getParam('h_apertura'),
        'h_cierre'   => $request->getParam('h_cierre'),
        'telefono'   => $request->getParam('telefono'),
      );

      $web = new Tienda;
      $web->setDatos($datos);
      $tienda = $web->insTienda();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($tienda));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE TIENDA
 */
$app->put('/api/tienda/update/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $tienda = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $id    = $request->getParam('id');
      $datos = array(
        'id'         => $id,
        'nombre'     => $request->getParam('nombre'),
        'h_apertura' => $request->getParam('h_apertura'),
        'h_cierre'   => $request->getParam('h_cierre'),
        'telefono'   => $request->getParam('telefono'),
      );

      $web = new Tienda;
      $web->setDatos($datos);
      $tienda = $web->updTienda();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($tienda));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * DELETE TIENDA
 */
$app->delete('/api/tienda/delete/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $tienda = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $id = $request->getAttribute('id');
      $web = new Tienda;
      $web->conexion();
      $web->setId($id);
      $web->delTienda();
      $tienda = array('status'=>"Eliminado");
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($tienda));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
