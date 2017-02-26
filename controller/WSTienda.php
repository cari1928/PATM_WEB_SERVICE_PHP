<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL TIENDAS
 */
$app->get('/api/tienda/listado', function (Request $request, Response $response) {
  try {
    $web     = new Tienda;
    $tiendas = $web->getListadoT();

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
$app->get('/api/tienda/{id}', function (Request $request, Response $response) {
  try {
    $id  = $request->getAttribute('id');
    $web = new Tienda;
    $web->setId($id);
    $tienda = $web->getTienda();

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
$app->post('/api/tienda/add', function (Request $request, Response $response) {
  try {
    $datos = array(
      'nombre'     => $request->getParam('nombre'),
      'h_apertura' => $request->getParam('h_apertura'),
      'h_cierre'   => $request->getParam('h_cierre'),
      'telefono'   => $request->getParam('telefono'),
    );
    //llave foranea pendiente!!!

    $web = new Tienda;
    $web->setDatos($datos);
    $tienda = $web->insTienda();

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
$app->put('/api/tienda/update', function (Request $request, Response $response) {
  try {
    $id    = $request->getParam('id');
    $datos = array(
      'id'         => $id,
      'nombre'     => $request->getParam('nombre'),
      'h_apertura' => $request->getParam('h_apertura'),
      'h_cierre'   => $request->getParam('h_cierre'),
      'telefono'   => $request->getParam('telefono'),
    );
    //llave foranea pendiente!!!

    $web = new Tienda;
    $web->setDatos($datos);
    $tienda = $web->updTienda();

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
$app->delete('/api/tienda/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new Tienda;
    $web->conexion();
    $web->setId($id);
    $web->delTienda();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Eliminado"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
