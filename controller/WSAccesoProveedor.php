<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL ACCESOS
 */
$app->get('/api/acceso/listado', function (Request $request, Response $response) {
  try {
    $web     = new Acceso_Proveedor;
    $accesos = $web->getListadoA();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($accesos));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE EMPLEADO
 */
$app->get('/api/acceso/{idTie}/{idPro}',
  function (Request $request, Response $response) {
    try {
      $idTie = $request->getAttribute('idTie');
      $idPro = $request->getAttribute('idPro');

      $web = new Acceso_Proveedor;
      $web->setIdTienda($idTie);
      $web->setIdProveedor($idPro);
      $acceso = $web->getAccProveedor();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($acceso));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * POST ADD EMPLEADO
 */
$app->post('/api/acceso/add', function (Request $request, Response $response) {
  try {
    $web = new Acceso_Proveedor;
    $web->setIdTienda($request->getParam('id_tienda'));
    $web->setIdProveedor($request->getParam('id_proveedor'));
    $acceso = $web->insAccProveedor();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($acceso));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE EMPLEADO
 */
$app->put('/api/acceso/update/{idTie}/{idPro}',
  function (Request $request, Response $response) {
    try {
      //llaves
      $idTien = $request->getAttribute('idTie');
      $idPro  = $request->getAttribute('idPro');

      //datos a cambiar
      $datos = array(
        'id_tienda'    => $request->getParam('id_tienda'),
        'id_proveedor' => $request->getParam('id_proveedor'),
      );

      $web = new Acceso_Proveedor;
      //especifica llaves
      $web->setIdTienda($idTien);
      $web->setIdProveedor($idPro);
      //especifica datos
      $web->setDatos($datos);
      $acceso = $web->updAccProveedor();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($acceso));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * DELETE EMPLEADO
 */
$app->delete('/api/acceso/delete/{idTie}/{idPro}',
  function (Request $request, Response $response) {
    try {
      $idTien = $request->getAttribute('idTie');
      $idPro  = $request->getAttribute('idPro');

      $web = new Acceso_Proveedor;
      $web->conexion();
      $web->setIdTienda($idTien);
      $web->setIdProveedor($idPro);
      $web->delAccProveedor();

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"notice" : {"text" : "Eliminado"}}');

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });
