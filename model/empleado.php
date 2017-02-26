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

  /**
   * LISTADO DE EMPLEADOS
   * @return array
   */
  public function getListadoE()
  {
    $this->conexion();

    $query = "SELECT * FROM empleado";
    return $this->fetchAll($query);
  }

  /**
   * OBTIENE UN EMPLEADO
   * @return array
   */
  public function getEmpleado()
  {
    $this->conexion();

    $query = "SELECT * FROM empleado WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  /**
   * INSERTA UN EMPLEADO
   * @return array
   */
  public function insEmpleado()
  {
    $this->conexion();
    $this->setTabla('empleado');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * ACTUALIZA UN EMPLEADO
   * @return array
   */
  public function updEmpleado()
  {
    $this->conexion();
    $this->setTabla('empleado');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

  /**
   * ELIMINA UN EMPLEADO
   */
  public function delEmpleado()
  {
    $this->conexion();
    $this->setTabla('empleado');
    $this->delete(array('id' => $this->id));
  }

}
