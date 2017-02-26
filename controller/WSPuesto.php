<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL PUESTOS
 * necesario para que se queden los 'use'
 */
$app->get('/api/puesto/listado', function (Request $request, Response $response) {
  try {
    $web     = new Puesto;
    $puestos = $web->getListadoP();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($puestos));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE EMPLEADO
 */
$app->get('/api/puesto/{id}', function (Request $request, Response $response) {
  try {
    $id  = $request->getAttribute('id');
    $web = new Puesto;
    $web->setId($id);
    $puesto = $web->getPuesto();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($puesto));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * POST ADD EMPLEADO
 */
$app->post('/api/puesto/add', function (Request $request, Response $response) {
  try {
    $datos = array(
      'puesto' => $request->getParam('puesto'),
    );
    //llave foranea pendiente!!!

    $web = new Puesto;
    $web->setDatos($datos);
    $puesto = $web->insPuesto();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($puesto));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE EMPLEADO
 */
$app->put('/api/puesto/update', function (Request $request, Response $response) {
  try {
    $id    = $request->getParam('id');
    $datos = array(
      'id'     => $id,
      'puesto' => $request->getParam('puesto'),
    );
    //llave foranea pendiente!!!

    $web = new Puesto;
    $web->setDatos($datos);
    $puesto = $web->updPuesto();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($puesto));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * DELETE EMPLEADO
 */
$app->delete('/api/puesto/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new Puesto;
    $web->conexion();
    $web->setId($id);
    $web->delPuesto();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Eliminado"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
