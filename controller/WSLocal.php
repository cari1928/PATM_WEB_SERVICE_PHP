<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL LOCALES
 */
$app->get('/api/local/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $locales = array('status'=>"No se pudo obtener el listado");
    if($bitacora->validaToken()) {
      $web     = new Local;
      $locales = $web->getListadoL();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($locales));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE LOCAL
 */
$app->get('/api/local/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $local = array('status'=>"No se pudo obtener el local");
    if($bitacora->validaToken()) {
      $id  = $request->getAttribute('id');
      $web = new Local;
      $web->setId($id);
      $local = $web->getLocal();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($local));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * POST ADD LOCAL
 */
$app->post('/api/local/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $local = array('status'=>"No se pudo añadir");
    if($bitacora->validaToken()) {
      $datos = array(
        'area'       => $request->getParam('area'),
        'almacen'    => $request->getParam('almacen'),
        'renta_base' => $request->getParam('renta_base'),
      );

      $web = new Local;
      $web->setDatos($datos);
      $local = $web->insLocal();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($local));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE LOCAL
 */
$app->put('/api/local/update/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $local = array('status'=>"No se pudo actualizar");
    if($bitacora->validaToken()) {
      $id    = $request->getParam('id');
      $datos = array(
        'id'         => $id,
        'area'       => $request->getParam('area'),
        'almacen'    => $request->getParam('almacen'),
        'renta_base' => $request->getParam('renta_base'),
      );

      $web = new Local;
      $web->setDatos($datos);
      $local = $web->updLocal();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($local));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * DELETE LOCAL
 */
$app->delete('/api/local/delete/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $local = array('status'=>"No se pudo eliminar");
    if($bitacora->validaToken()) {
      $id = $request->getAttribute('id');
      $web = new Local;
      $web->conexion();
      $web->setId($id);
      $web->delLocal();
      $local = array('status:'=>"Eliminado");
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($local));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
