<?php

/**
 *
 */
class Tienda extends SlimApp
{
  private $id    = null;
  private $datos = null;

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
 * LISTADO DE TIENDAS
 * @return array
 */
  public function getListadoT()
  {
    $this->conexion();

    $query = "SELECT * FROM tienda";
    return $this->fetchAll($query);
  }

  /**
   * OBTIENE UN TIENDA
   * @return array
   */
  public function getTienda()
  {
    $this->conexion();

    $query = "SELECT * FROM tienda WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  /**
   * INSERTA UN TIENDA
   * @return array
   */
  public function insTienda()
  {
    $this->conexion();
    $this->setTabla('tienda');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * ACTUALIZA UN TIENDA
   * @return array
   */
  public function updTienda()
  {
    $this->conexion();
    $this->setTabla('tienda');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

  /**
   * ELIMINA UN TIENDA
   */
  public function delTienda()
  {
    $this->conexion();
    $this->setTabla('tienda');
    $this->delete(array('id' => $this->id));
  }

}
