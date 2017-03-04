<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL ACCESOS
 */
$app->get('/api/acceso/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $accesos = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web     = new Acceso_Proveedor;
      $accesos = $web->getListadoA();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($accesos));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE ACCESO - PROVEEDOR
 */
$app->get('/api/acceso/{idTie}/{idPro}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $acceso = array('status'=>"No se pudo obtener el acceso-proveedor");
      if($bitacora->validaToken()) {
        $idTie = $request->getAttribute('idTie');
        $idPro = $request->getAttribute('idPro');

        $web = new Acceso_Proveedor;
        $web->setIdTienda($idTie);
        $web->setIdProveedor($idPro);
        $acceso = $web->getAccProveedor();
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($acceso));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * POST ADD ACCESO - PROVEEDOR
 */
$app->post('/api/acceso/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $acceso = array('status'=>"No se pudo añadir");
    if($bitacora->validaToken()) {
      $web = new Acceso_Proveedor;
      $web->setIdTienda($request->getParam('id_tienda'));
      $web->setIdProveedor($request->getParam('id_proveedor'));
      $acceso = $web->insAccProveedor();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($acceso));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE ACCESO - PROVEEDOR
 */
$app->put('/api/acceso/update/{idTie}/{idPro}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $acceso = array('status'=>"No se pudo actualizar");
      if($bitacora->validaToken()) {
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
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($acceso));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * DELETE ACCESO - PROVEEDOR
 */
$app->delete('/api/acceso/delete/{idTie}/{idPro}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $acceso = array('status'=>"No se pudo eliminar");
      if($bitacora->validaToken()) {
        $idTien = $request->getAttribute('idTie');
        $idPro  = $request->getAttribute('idPro');

        $web = new Acceso_Proveedor;
        $web->conexion();
        $web->setIdTienda($idTien);
        $web->setIdProveedor($idPro);
        $web->delAccProveedor();
        $acceso = array('status'=>'Eliminado');
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($acceso));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });
