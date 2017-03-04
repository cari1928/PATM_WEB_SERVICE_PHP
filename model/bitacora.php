<?php

class Bitacora extends SlimApp
{
  private $usuario    = null;
  private $pass    = null;
  private $token    = null;
  private $datos = array(); //especificar array para que funcione

  /**
   * GETTERS
   */
  public function getUsuario()
  {
    return $this->usuario;
  } 

  public function getPass()
  {
    return $this->pass;
  }

  public function getToken()
  {
    return $this->token;
  }

  /**
   * SETTERS
   */
  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
  }

  public function setPass($pass)
  {
    $this->pass = $pass;
  }

  public function setToken($token)
  {
    $this->token = $token;
  }

/**
 * FUNCIONES
 */
  
  /**
   * Inserción en Bitácora
   * @return array Datos insertados
   */
  public function insAcceso()
  {
    $this->conexion();
    $this->setTabla('bitacora');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * Verifica que el token ingresado esté dentro del límite de tiempo
   * @return boolean Token válido o no, válido=true
   */
  public function validaToken() 
  {
    $this->conexion();

  	$query = "SELECT * FROM bitacora 
    WHERE usuario='".$this->usuario."' 
    AND password='".$this->pass."' 
    AND token='".$this->token."' 
    AND NOW() BETWEEN fecini and fecfin";

  	$valida = $this->fetchAll($query);
  	if(isset($valida[0])) {
  		return true;
  	}

  	return false;
  }

}
