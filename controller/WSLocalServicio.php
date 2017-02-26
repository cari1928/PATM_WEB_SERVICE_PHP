<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL LOCALES Y SERVICIOS
 */
$app->get('/api/locser/listado', function (Request $request, Response $response) {
  try {
    $web     = new Local_Servicio;
    $locales = $web->getListadoL();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($locales));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE EMPLEADO
 */
$app->get('/api/locser/{idLoc}/{idSer}',
  function (Request $request, Response $response) {
    try {
      $idLoc = $request->getAttribute('idLoc');
      $idSer = $request->getAttribute('idSer');

      $web = new Local_Servicio;
      $web->setIdLocal($idLoc);
      $web->setIdServicio($idSer);
      $locser = $web->getLocServicio();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($locser));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * POST ADD EMPLEADO
 */
$app->post('/api/locser/add', function (Request $request, Response $response) {
  try {
    $web = new Local_Servicio;
    $web->setIdLocal($request->getParam('id_local'));
    $web->setIdServicio($request->getParam('id_servicio'));
    $locser = $web->insLocServicio();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($locser));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE EMPLEADO
 */
$app->put('/api/locser/update/{idLoc}/{idSer}',
  function (Request $request, Response $response) {
    try {
      //llaves
      $idLoc = $request->getAttribute('idLoc');
      $idSer = $request->getAttribute('idSer');

      //datos a cambiar
      $datos = array(
        'id_local'    => $request->getParam('id_local'),
        'id_servicio' => $request->getParam('id_servicio'),
      );

      $web = new Local_Servicio;
      //especifica llaves
      $web->setIdLocal($idLoc);
      $web->setIdServicio($idSer);
      //especifica datos
      $web->setDatos($datos);
      $locser = $web->updLocServicio();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($locser));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * DELETE EMPLEADO
 */
$app->delete('/api/locser/delete/{idLoc}/{idSer}',
  function (Request $request, Response $response) {
    try {
      $idLoc = $request->getAttribute('idLoc');
      $idSer = $request->getAttribute('idSer');

      $web = new Local_Servicio;
      $web->conexion();
      $web->setIdLocal($idLoc);
      $web->setIdServicio($idSer);
      $web->delLocServicio();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"notice" : {"text" : "Eliminado"}}');

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });
