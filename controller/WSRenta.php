<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL RENTAS
 */
$app->get('/api/renta/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $locales = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web     = new Renta;
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
 * GET SINGLE RENTA
 */
$app->get('/api/renta/{idLoc}/{idTie}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $renta = array('status'=>"No se pudo obtener la renta");
      if($bitacora->validaToken()) {
        $idLoc = $request->getAttribute('idLoc');
        $idTie = $request->getAttribute('idTie');

        $web = new Renta;
        $web->setIdLocal($idLoc);
        $web->setIdTienda($idTie);
        $renta = $web->getRenta();
      }

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
$app->post('/api/renta/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $renta = array('status'=>"No se pudo añadir");
    if($bitacora->validaToken()) {
      $web = new Renta;
      $web->setIdLocal($request->getParam('id_local'));
      $web->setIdTienda($request->getParam('id_tienda'));
      $renta = $web->insRenta();
    }

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
$app->put('/api/renta/update/{idLoc}/{idTie}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $renta = array('status'=>"No se pudo actualizar");
      if($bitacora->validaToken()) {
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
      }

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
$app->delete('/api/renta/delete/{idLoc}/{idTie}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $renta = array('status'=>"No se pudo añadir");
      if($bitacora->validaToken()) {
        $idLoc = $request->getAttribute('idLoc');
        $idTie = $request->getAttribute('idTie');

        $web = new Renta;
        $web->conexion();
        $web->setIdLocal($idLoc);
        $web->setIdTienda($idTie);
        $web->delRenta();
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"notice" : {"text" : "Eliminado"}}');

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });
