<?php

/**
 *
 */
class Local_Servicio extends SlimApp
{
  private $id_local    = null;
  private $id_servicio = null;
  private $datos       = array(); //especificar array para que funcione

  /**
   * GETTERS
   */
  public function getIdLocal()
  {
    return $this->id_local;
  }

  public function getIdServicio()
  {
    return $this->id_servicio;
  }

  /**
   * SETTERS
   */
  public function setIdLocal($id_local)
  {
    $this->id_local = $id_local;
  }

  public function setIdServicio($id_servicio)
  {
    $this->id_servicio = $id_servicio;
  }

  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

  /**
   * LISTADO DE LOCALES Y SERVICIOS
   * @return array
   */
  public function getListadoL()
  {
    $this->conexion();

    $query   = "SELECT * FROM local_servicio";
    $locales = $this->fetchAll($query);

    for ($i = 0; $i < sizeof($locales); $i++) {
      $local    = new Local;
      $servicio = new Servicio;

      $local->setId($locales[$i]['id_local']);
      $servicio->setId($locales[$i]['id_servicio']);

      $locales[$i]['local']    = $local->getLocal();
      $locales[$i]['servicio'] = $servicio->getServicio();

      unset($locales[$i]['id_local']);
      unset($locales[$i]['id_servicio']);
    }

    return $locales;
  }

  /**
   * OBTIENE UN LOCAL-SERVICIO
   * @return array
   */
  public function getLocServicio()
  {
    $this->conexion();

    $query = "SELECT * FROM local_servicio
    WHERE id_local=" . $this->id_local . " AND id_servicio=" . $this->id_servicio;
    $local_servicio = $this->fetchAll($query);

    if (!isset($local_servicio[0])) {
      return array('notice' => array('text' => "No existe el local_servicio especificado"));
      // return array('local' => $this->id_local, 'servicio' => $this->id_servicio);
    }

    $local    = new Local;
    $servicio = new Servicio;

    $local->setId($local_servicio[0]['id_local']);
    $servicio->setId($local_servicio[0]['id_servicio']);

    $local_servicio[0]['local']    = $local->getLocal();
    $local_servicio[0]['servicio'] = $servicio->getServicio();

    unset($local_servicio[0]['id_local']);
    unset($local_servicio[0]['id_servicio']);

    return $local_servicio;
  }

  /**
   * INSERTA UN LOCAL-SERVICIO
   * @return array
   */
  public function insLocServicio()
  {
    $this->conexion();
    $this->setTabla('local_servicio');
    $local_servicio = array(
      'id_local'    => $this->id_local,
      'id_servicio' => $this->id_servicio,
    );
    $this->insert($local_servicio);
    return $local_servicio;
  }

  /**
   * ACTUALIZA UN LOCAL-SERVICIO
   * @return array
   */
  public function updLocServicio()
  {
    $this->conexion();

    $query = "UPDATE local_servicio
    SET id_local= :id_local, id_servicio= :id_servicio
    WHERE id_local= :id_local_2 AND id_servicio= :id_servicio_2";

    $statement = $this->conn->Prepare($query);
    $statement->bindParam(':id_local', $this->datos['id_local']);
    $statement->bindParam(':id_servicio', $this->datos['id_servicio']);
    $statement->bindParam(':id_local_2', $this->id_local);
    $statement->bindParam(':id_servicio_2', $this->id_servicio);
    $statement->Execute();

    return $this->datos;
  }

  /**
   * ELIMINA UN LOCAL-SERVICIO
   */
  public function delLocServicio()
  {
    $this->conexion();
    $this->setTabla('local_servicio');
    $local_servicio = array(
      'id_local'    => $this->id_local,
      'id_servicio' => $this->id_servicio,
    );
    $this->delete($local_servicio);
  }

}
