<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL SERVICIOS
 */
$app->get('/api/servicio/listado', function (Request $request, Response $response) {
  try {
    $web       = new Servicio;
    $servicios = $web->getListadoS();

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
$app->get('/api/servicio/{id}', function (Request $request, Response $response) {
  try {
    $id  = $request->getAttribute('id');
    $web = new Servicio;
    $web->setId($id);
    $servicio = $web->getServicio();

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
$app->post('/api/servicio/add', function (Request $request, Response $response) {
  try {
    $datos = array(
      'servicio' => $request->getParam('servicio'),
      'precio'   => $request->getParam('precio'),
    );
    //llave foranea pendiente!!!

    $web = new Servicio;
    $web->setDatos($datos);
    $servicio = $web->insServicio();

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
$app->put('/api/servicio/update', function (Request $request, Response $response) {
  try {
    $id    = $request->getParam('id');
    $datos = array(
      'id'       => $id,
      'servicio' => $request->getParam('servicio'),
      'precio'   => $request->getParam('precio'),
    );
    //llave foranea pendiente!!!

    $web = new Servicio;
    $web->setDatos($datos);
    $servicio = $web->updServicio();

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
$app->delete('/api/servicio/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new Servicio;
    $web->conexion();
    $web->setId($id);
    $web->delServicio();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Eliminado"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
