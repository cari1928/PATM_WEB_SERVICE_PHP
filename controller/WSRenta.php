<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL LOCALES Y TIENDAS
 */
$app->get('/api/renta/listado', function (Request $request, Response $response) {
  try {
    $web     = new Renta;
    $locales = $web->getListadoL();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($locales));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE RENTA
 */
$app->get('/api/renta/{idLoc}/{idTie}',
  function (Request $request, Response $response) {
    try {
      $idLoc = $request->getAttribute('idLoc');
      $idTie = $request->getAttribute('idTie');

      $web = new Renta;
      $web->setIdLocal($idLoc);
      $web->setIdTienda($idTie);
      $renta = $web->getRenta();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($renta));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * POST ADD RENTA
 */
$app->post('/api/renta/add', function (Request $request, Response $response) {
  try {
    $web = new Renta;
    $web->setIdLocal($request->getParam('id_local'));
    $web->setIdTienda($request->getParam('id_tienda'));
    $renta = $web->insRenta();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($renta));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE RENTA
 */
$app->put('/api/renta/update/{idLoc}/{idTie}',
  function (Request $request, Response $response) {
    try {
      //llaves
      $idLoc = $request->getAttribute('idLoc');
      $idTie = $request->getAttribute('idTie');

      //datos a cambiar
      $datos = array(
        'id_local'  => $request->getParam('id_local'),
        'id_tienda' => $request->getParam('id_tienda'),
      );

      $web = new Renta;
      //especifica llaves
      $web->setIdLocal($idLoc);
      $web->setIdTienda($idTie);
      //especifica datos
      $web->setDatos($datos);
      $renta = $web->updRenta();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($renta));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * DELETE RENTA
 */
$app->delete('/api/renta/delete/{idLoc}/{idTie}',
  function (Request $request, Response $response) {
    try {
      $idLoc = $request->getAttribute('idLoc');
      $idTie = $request->getAttribute('idTie');

      $web = new Renta;
      $web->conexion();
      $web->setIdLocal($idLoc);
      $web->setIdTienda($idTie);
      $web->delRenta();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"notice" : {"text" : "Eliminado"}}');

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });
