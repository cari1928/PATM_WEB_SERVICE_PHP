<?php

class Bitacora extends SlimApp
{
  private $nombre    = null;
  private $pass    = null;
  private $token    = null;
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

  public function insAcceso()
  {
    $this->conexion();
    $this->setTabla('bitacora');
    $this->insert($this->datos);
    return $this->datos;
  }

  public function validaToken() {
    $this->conexion();

  	$query = "SELECT * FROM bitacora 
  	WHERE usuario='".$this->usuario."' AND password='".$this->password."' 
  	AND token='".$this->token."' and NOW() BETWEEN fecini and fecfin";
  	$valida = $this->fetchAll($query);

  	if(isset($valida[0])) {
  		return true;
  	}

  	return false;
  }

}
