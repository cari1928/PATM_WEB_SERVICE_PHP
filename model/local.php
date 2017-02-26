<?php

/**
 *
 */
class Local extends SlimApp
{
  private $id    = null;
  private $datos = null;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

}
