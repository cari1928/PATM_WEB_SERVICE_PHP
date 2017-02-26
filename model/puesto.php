<?php

/**
 *
 */
class Puesto extends SlimApp
{
  private $id    = null;
  private $datos = array(); //especificar array para que funcione

  /**
   * GETTERS
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * SETTERS
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

  /**
   * LISTADO DE PUESTOS
   * @return array
   */
  public function getListadoP()
  {
    $this->conexion();

    $query = "SELECT * FROM puesto";
    return $this->fetchAll($query);
  }

  /**
   * OBTIENE UN PUESTO
   * @return array
   */
  public function getPuesto()
  {
    $this->conexion();

    $query = "SELECT * FROM puesto WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  /**
   * INSERTA UN PUESTO
   * @return array
   */
  public function insPuesto()
  {
    $this->conexion();
    $this->setTabla('puesto');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * ACTUALIZA UN PUESTO
   * @return array
   */
  public function updPuesto()
  {
    $this->conexion();
    $this->setTabla('puesto');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

  /**
   * ELIMINA UN PUESTO
   */
  public function delPuesto()
  {
    $this->conexion();
    $this->setTabla('puesto');
    $this->delete(array('id' => $this->id));
  }

}
