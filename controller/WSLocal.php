<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL LOCALES
 */
$app->get('/api/local/listado', function (Request $request, Response $response) {
  try {
    $web     = new Local;
    $locales = $web->getListadoL();

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
$app->get('/api/local/{id}', function (Request $request, Response $response) {
  try {
    $id  = $request->getAttribute('id');
    $web = new Local;
    $web->setId($id);
    $local = $web->getLocal();

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
$app->post('/api/local/add', function (Request $request, Response $response) {
  try {
    $datos = array(
      'area'       => $request->getParam('area'),
      'almacen'    => $request->getParam('almacen'),
      'renta_base' => $request->getParam('renta_base'),
    );
    //llave foranea pendiente!!!

    $web = new Local;
    $web->setDatos($datos);
    $local = $web->insLocal();

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
$app->put('/api/local/update', function (Request $request, Response $response) {
  try {
    $id    = $request->getParam('id');
    $datos = array(
      'id'         => $id,
      'area'       => $request->getParam('area'),
      'almacen'    => $request->getParam('almacen'),
      'renta_base' => $request->getParam('renta_base'),
    );
    //llave foranea pendiente!!!

    $web = new Local;
    $web->setDatos($datos);
    $local = $web->updLocal();

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
$app->delete('/api/local/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new Local;
    $web->conexion();
    $web->setId($id);
    $web->delLocal();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Eliminado"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
