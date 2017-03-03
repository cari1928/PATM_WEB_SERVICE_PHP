<?php

/**
 *
 */
class Usuario extends SlimApp
{
  private $nombre    = null;
  private $pass    = null;
  private $token    = null;
  private $status    = null;
  private $datos = array(); //especificar array para que funcione

  /**
   * GETTERS
   */
  public function getNombre()
  {
    return $this->nombre;
  }

  /**
   * SETTERS
   */
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  /**
   * GETTERS
   */
  public function getPass()
  {
    return $this->pass;
  }

  /**
   * SETTERS
   */
  public function setPass($pass)
  {
    $this->pass = $pass;
  }

  /**
   * GETTERS
   */
  public function getToken()
  {
    return $this->token;
  }

  /**
   * SETTERS
   */
  public function setToken($token)
  {
    $this->token = $token;
  }

  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

  /**
   * FUNCIONES
   */

  public function validaUsuario()
  {
    $this->conexion();

    $query     = "SELECT * FROM usuario WHERE nombre='".$this->nombre."' and password='".$this->pass."'";

    $usuario = $this->fetchAll($query);

    if(isset($usuario[0])) {
    	$this->generaToken($this->nombre, $this->pass);
    	$bitacora = new Bitacora;

    	$datos = array('usuario'=>$this->nombre, 'password'=>$this->pass, 'token'=>$this->token);
    	$bitacora->setDatos($datos);
    	return $bitacora->insAcceso();
    } 

    return array('status'=>$query);
  }

  public function generaToken($nombre, $pass){
  	$cadena = date('l jS \of F Y h:i:s A') . $nombre . $pass;
  	$this->token = md5($cadena);
  }

}
