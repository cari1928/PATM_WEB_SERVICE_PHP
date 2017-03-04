<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL LOCALES Y SERVICIOS
 */
$app->get('/api/locser/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $locales = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web     = new Local_Servicio;
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
 * GET SINGLE LOCALES-SERVICIO
 */
$app->get('/api/locser/{idLoc}/{idSer}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $locser = array('status'=>"No se pudo obtener el local-servicio");
      if($bitacora->validaToken()) {
        $idLoc = $request->getAttribute('idLoc');
        $idSer = $request->getAttribute('idSer');

        $web = new Local_Servicio;
        $web->setIdLocal($idLoc);
        $web->setIdServicio($idSer);
        $locser = $web->getLocServicio();
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($locser));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * POST ADD LOCALES-SERVICIO
 */
$app->post('/api/locser/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $locser = array('status'=>"No se pudo añadir");
    if($bitacora->validaToken()) {
      $web = new Local_Servicio;
      $web->setIdLocal($request->getParam('id_local'));
      $web->setIdServicio($request->getParam('id_servicio'));
      $locser = $web->insLocServicio();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($locser));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE LOCALES-SERVICIO
 */
$app->put('/api/locser/update/{idLoc}/{idSer}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $locser = array('status'=>"No se pudo actualizar");
      if($bitacora->validaToken()) {
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
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($locser));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });

/**
 * DELETE LOCALES-SERVICIO
 */
$app->delete('/api/locser/delete/{idLoc}/{idSer}/{nomUsr}/{pass}/{token}',
  function (Request $request, Response $response) {
    try {
      $bitacora = new Bitacora;
      $bitacora->setUsuario($request->getAttribute('nomUsr'));
      $bitacora->setPass($request->getAttribute('pass'));
      $bitacora->setToken($request->getAttribute('token'));

      $locser = array('status'=>"No se pudo eliminar");
      if($bitacora->validaToken()) {
        $idLoc = $request->getAttribute('idLoc');
        $idSer = $request->getAttribute('idSer');

        $web = new Local_Servicio;
        $web->conexion();
        $web->setIdLocal($idLoc);
        $web->setIdServicio($idSer);
        $web->delLocServicio();
        $locser = array('status'=>"Eliminado");
      }

      return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($locser));

    } catch (PDOException $e) {
      echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
    }
  });
