<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL PROVEEDORES
 */
$app->get('/api/proveedor/listado/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $proveedores = array('status'=>"No se pudo obtener la lista");
    if($bitacora->validaToken()) {
      $web         = new Proveedor;
      $proveedores = $web->getListadoP();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($proveedores));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * GET SINGLE PROVEEDOR
 */
$app->get('/api/proveedor/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $proveedor = array('status'=>"No se pudo obtener el proveedor");
    if($bitacora->validaToken()) {
      $id  = $request->getAttribute('id');
      $web = new Proveedor;
      $web->setId($id);
      $proveedor = $web->getProveedor();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($proveedor));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * POST ADD EMPLEADO
 */
$app->post('/api/proveedor/add/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $proveedor = array('status'=>"No se pudo añadir");
    if($bitacora->validaToken()) {
      $datos = array(
        'nombre'   => $request->getParam('nombre'),
        'rfc'      => $request->getParam('rfc'),
        'correo'   => $request->getParam('correo'),
        'telefono' => $request->getParam('telefono'),
      );

      $web = new Proveedor;
      $web->setDatos($datos);
      $proveedor = $web->insProveedor();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($proveedor));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * PUT UPDATE EMPLEADO
 */
$app->put('/api/proveedor/update/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $proveedor = array('status'=>"No se pudo actualizar");
    if($bitacora->validaToken()) {
      $id    = $request->getParam('id');
      $datos = array(
        'id'       => $id,
        'nombre'   => $request->getParam('nombre'),
        'rfc'      => $request->getParam('rfc'),
        'correo'   => $request->getParam('correo'),
        'telefono' => $request->getParam('telefono'),
      );

      $web = new Proveedor;
      $web->setDatos($datos);
      $proveedor = $web->updProveedor();
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($proveedor));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

/**
 * DELETE EMPLEADO
 */
$app->delete('/api/proveedor/delete/{id}/{nomUsr}/{pass}/{token}', function (Request $request, Response $response) {
  try {
    $bitacora = new Bitacora;
    $bitacora->setUsuario($request->getAttribute('nomUsr'));
    $bitacora->setPass($request->getAttribute('pass'));
    $bitacora->setToken($request->getAttribute('token'));

    $proveedor = array('status'=>"No se pudo eliminar");
    if($bitacora->validaToken()) {
      $id = $request->getAttribute('id');
      $web = new Proveedor;
      $web->conexion();
      $web->setId($id);
      $web->delProveedor();
      $proveedor = array('status'=>"Eliminado");
    }

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($proveedor));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
