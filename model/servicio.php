<?php

/**
 *
 */
class Servicio extends SlimApp
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
 * LISTADO DE SERVICIOS
 * @return array
 */
  public function getListadoS()
  {
    $this->conexion();

    $query = "SELECT * FROM servicio";
    return $this->fetchAll($query);
  }

  /**
   * OBTIENE UN SERVICIO
   * @return array
   */
  public function getServicio()
  {
    $this->conexion();

    $query = "SELECT * FROM servicio WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  /**
   * INSERTA UN SERVICIO
   * @return array
   */
  public function insServicio()
  {
    $this->conexion();
    $this->setTabla('servicio');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * ACTUALIZA UN SERVICIO
   * @return array
   */
  public function updServicio()
  {
    $this->conexion();
    $this->setTabla('servicio');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

  /**
   * ELIMINA UN SERVICIO
   */
  public function delServicio()
  {
    $this->conexion();
    $this->setTabla('servicio');
    $this->delete(array('id' => $this->id));
  }

}
