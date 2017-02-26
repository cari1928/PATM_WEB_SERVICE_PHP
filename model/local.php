<?php

/**
 *
 */
class Local extends SlimApp
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
 * LISTADO DE LOCALES
 * @return array
 */
  public function getListadoL()
  {
    $this->conexion();

    $query = "SELECT * FROM local";
    return $this->fetchAll($query);
  }

  /**
   * OBTIENE UN LOCAL
   * @return array
   */
  public function getLocal()
  {
    $this->conexion();

    $query = "SELECT * FROM local WHERE id=" . $this->id;
    return $this->fetchAll($query);
  }

  /**
   * INSERTA UN LOCAL
   * @return array
   */
  public function insLocal()
  {
    $this->conexion();
    $this->setTabla('local');
    $this->insert($this->datos);
    return $this->datos;
  }

  /**
   * ACTUALIZA UN LOCAL
   * @return array
   */
  public function updLocal()
  {
    $this->conexion();
    $this->setTabla('local');
    $this->update($this->datos, array('id' => $this->datos['id']));
    return $this->datos;
  }

  /**
   * ELIMINA UN LOCAL
   */
  public function delLocal()
  {
    $this->conexion();
    $this->setTabla('local');
    $this->delete(array('id' => $this->id));
  }

}
