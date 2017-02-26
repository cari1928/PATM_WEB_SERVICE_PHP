<?php

/**
 *
 */
class Proveedor extends SlimApp
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
   * LISTADO DE PROVEEDOR
   * @return array
   */
  public function getListadoP()
  {
    $this->conexion();

    $query = "SELECT * FROM proveedor";
    return $this->fetchAll($query);
  }

  /**
   * OBTIENE UN PROVEEDOR
   * @return array
   */
  public function getProveedor()
  {
    $this->conexion();

    $query = "SELECT * FROM proveedor WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  /**
   * INSERTA UN PROVEEDOR
   * @return array
   */
  public function insProveedor()
  {
    $this->conexion();
    $this->setTabla('proveedor');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * ACTUALIZA UN PROVEEDOR
   * @return array
   */
  public function updProveedor()
  {
    $this->conexion();
    $this->setTabla('proveedor');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

  /**
   * ELIMINA UN PROVEEDOR
   */
  public function delProveedor()
  {
    $this->conexion();
    $this->setTabla('proveedor');
    $this->delete(array('id' => $this->id));
  }

}
