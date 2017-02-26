<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL PROVEEDORES
 */
$app->get('/api/proveedor/listado', function (Request $request, Response $response) {
  try {
    $web         = new Proveedor;
    $proveedores = $web->getListadoP();

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
$app->get('/api/proveedor/{id}', function (Request $request, Response $response) {
  try {
    $id  = $request->getAttribute('id');
    $web = new Proveedor;
    $web->setId($id);
    $proveedor = $web->getProveedor();

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
$app->post('/api/proveedor/add', function (Request $request, Response $response) {
  try {
    $datos = array(
      'nombre'   => $request->getParam('nombre'),
      'rfc'      => $request->getParam('rfc'),
      'correo'   => $request->getParam('correo'),
      'telefono' => $request->getParam('telefono'),
    );
    //llave foranea pendiente!!!

    $web = new Proveedor;
    $web->setDatos($datos);
    $proveedor = $web->insProveedor();

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
$app->put('/api/proveedor/update', function (Request $request, Response $response) {
  try {
    $id    = $request->getParam('id');
    $datos = array(
      'id'       => $id,
      'nombre'   => $request->getParam('nombre'),
      'rfc'      => $request->getParam('rfc'),
      'correo'   => $request->getParam('correo'),
      'telefono' => $request->getParam('telefono'),
    );
    //llave foranea pendiente!!!

    $web = new Proveedor;
    $web->setDatos($datos);
    $proveedor = $web->updProveedor();

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
$app->delete('/api/proveedor/delete/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    $web = new Proveedor;
    $web->conexion();
    $web->setId($id);
    $web->delProveedor();

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
      ->write('{"notice" : {"text" : "Eliminado"}}');

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});
