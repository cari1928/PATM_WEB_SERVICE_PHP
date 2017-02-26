<?php

/**
 *
 */
class Renta extends SlimApp
{
  private $id_local  = null;
  private $id_tienda = null;
  private $datos     = array(); //especificar array para que funcione

  /**
   * GETTERS
   */
  public function getIdLocal()
  {
    return $this->id_local;
  }

  public function getIdTienda()
  {
    return $this->id_tienda;
  }

  /**
   * SETTERS
   */
  public function setIdLocal($id_local)
  {
    $this->id_local = $id_local;
  }

  public function setIdTienda($id_tienda)
  {
    $this->id_tienda = $id_tienda;
  }

  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

  /**
   * LISTADO DE LOCALES Y TIENDAS
   * @return array
   */
  public function getListadoL()
  {
    $this->conexion();

    $query   = "SELECT * FROM renta";
    $locales = $this->fetchAll($query);

    for ($i = 0; $i < sizeof($locales); $i++) {
      $local  = new Local;
      $tienda = new Tienda;

      $local->setId($locales[$i]['id_local']);
      $tienda->setId($locales[$i]['id_tienda']);

      $locales[$i]['local']  = $local->getLocal();
      $locales[$i]['tienda'] = $tienda->getTienda();

      unset($locales[$i]['id_local']);
      unset($locales[$i]['id_tienda']);
    }

    return $locales;
  }

  /**
   * OBTIENE UN LOCAL-SERVICIO
   * @return array
   */
  public function getRenta()
  {
    $this->conexion();

    $query = "SELECT * FROM renta
    WHERE id_local=" . $this->id_local . " AND id_tienda=" . $this->id_tienda;
    $renta = $this->fetchAll($query);

    if (!isset($renta[0])) {
      return array('notice' => array('text' => "No existe el renta especificado"));
      // return array('local' => $this->id_local, 'tienda' => $this->id_tienda);
    }

    $local  = new Local;
    $tienda = new Tienda;

    $local->setId($renta[0]['id_local']);
    $tienda->setId($renta[0]['id_tienda']);

    $renta[0]['local']  = $local->getLocal();
    $renta[0]['tienda'] = $tienda->getTienda();

    unset($renta[0]['id_local']);
    unset($renta[0]['id_tienda']);

    return $renta;
  }

  /**
   * INSERTA UN LOCAL-SERVICIO
   * @return array
   */
  public function insRenta()
  {
    $this->conexion();
    $this->setTabla('renta');
    $renta = array(
      'id_local'  => $this->id_local,
      'id_tienda' => $this->id_tienda,
    );
    $this->insert($renta);
    return $renta;
  }

  /**
   * ACTUALIZA UN LOCAL-SERVICIO
   * @return array
   */
  public function updRenta()
  {
    $this->conexion();

    $query = "UPDATE renta
    SET id_local= :id_local, id_tienda= :id_tienda
    WHERE id_local= :id_local_2 AND id_tienda= :id_tienda_2";

    $statement = $this->conn->Prepare($query);
    $statement->bindParam(':id_local', $this->datos['id_local']);
    $statement->bindParam(':id_tienda', $this->datos['id_tienda']);
    $statement->bindParam(':id_local_2', $this->id_local);
    $statement->bindParam(':id_tienda_2', $this->id_tienda);
    $statement->Execute();

    return $this->datos;
  }

  /**
   * ELIMINA UN LOCAL-SERVICIO
   */
  public function delRenta()
  {
    $this->conexion();
    $this->setTabla('renta');
    $renta = array(
      'id_local'  => $this->id_local,
      'id_tienda' => $this->id_tienda,
    );
    $this->delete($renta);
  }

}
