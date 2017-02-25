<?php

/**
 *
 */
class Empleado extends SlimApp
{
  private $id    = null;
  private $datos = array(); //especificar array para que funcione

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

  public function getListadoE()
  {
    $this->conexion();

    $query = "SELECT * FROM empleado";
    return $this->fetchAll($query);
  }

  public function getEmpleado()
  {
    $this->conexion();

    $query = "SELECT * FROM empleado WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  public function insEmpleado()
  {
    $this->conexion();
    $this->setTabla('empleado');
    $this->insert($this->datos);
    return $this->datos;
  }

  public function updEmpleado()
  {
    $this->conexion();
    $this->setTabla('empleado');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

}
