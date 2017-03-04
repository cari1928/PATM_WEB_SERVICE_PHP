<?php  

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * GET ALL EMPLEADOS
 * necesario para que se queden los 'use'
 */
$app->get('/api/usuario/validar/{nombre}/{pass}', function (Request $request, Response $response) {
  try {
  	$nombre  = 	$request->getAttribute('nombre');
  	$pass  = $request->getAttribute('pass');

    $web       = new Usuario;
    $web->setNombre($nombre);
    $web->setPass($pass);
    $valUsuario = $web->validaUsuario();

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->write(json_encode($valUsuario));

  } catch (PDOException $e) {
    echo '{"error" : {"text" : ' . $e->getMessage() . '}}';
  }
});

?>