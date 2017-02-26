<?php

/**
 *
 */
class Acceso_Proveedor extends SlimApp
{
  private $id_tienda    = null;
  private $id_proveedor = null;
  private $datos        = array(); //especificar array para que funcione

  /**
   * GETTERS
   */
  public function getIdTienda()
  {
    return $this->id_tienda;
  }

  public function getIdProveedor()
  {
    return $this->id_proveedor;
  }

  /**
   * SETTERS
   */
  public function setIdTienda($id_tienda)
  {
    $this->id_tienda = $id_tienda;
  }

  public function setIdProveedor($id_proveedor)
  {
    $this->id_proveedor = $id_proveedor;
  }

  public function setDatos($datos)
  {
    $this->datos = $datos;
  }

  /**
   * LISTADO DE ACCESOS
   * @return array
   */
  public function getListadoA()
  {
    $this->conexion();

    $query   = "SELECT * FROM acceso_proveedor";
    $accesos = $this->fetchAll($query);

    for ($i = 0; $i < sizeof($accesos); $i++) {
      $tienda    = new Tienda;
      $proveedor = new Proveedor;

      $tienda->setId($accesos[$i]['id_tienda']);
      $proveedor->setId($accesos[$i]['id_proveedor']);

      $accesos[$i]['tienda']    = $tienda->getTienda();
      $accesos[$i]['proveedor'] = $proveedor->getProveedor();

      unset($accesos[$i]['id_tienda']);
      unset($accesos[$i]['id_proveedor']);
    }

    return $accesos;
  }

  /**
   * OBTIENE UN ACCESO
   * @return array
   */
  public function getAccProveedor()
  {
    $this->conexion();

    $query = "SELECT * FROM acceso_proveedor
    WHERE id_tienda=" . $this->id_tienda . " AND id_proveedor=" . $this->id_proveedor;
    $acceso_proveedor = $this->fetchAll($query);

    if (!isset($acceso_proveedor[0])) {
      // return array('notice' => array('text' => "No existe el acceso_proveedor especificado"));
      return array('tienda' => $this->id_tienda, 'proveedor' => $this->id_proveedor);
    }

    $tienda    = new Tienda;
    $proveedor = new Proveedor;

    $tienda->setId($acceso_proveedor[0]['id_tienda']);
    $proveedor->setId($acceso_proveedor[0]['id_proveedor']);

    $acceso_proveedor[0]['tienda']    = $tienda->getTienda();
    $acceso_proveedor[0]['proveedor'] = $proveedor->getProveedor();

    unset($acceso_proveedor[0]['id_tienda']);
    unset($acceso_proveedor[0]['id_proveedor']);

    return $acceso_proveedor;
  }

  /**
   * INSERTA UN ACCESO
   * @return array
   */
  public function insAccProveedor()
  {
    $this->conexion();
    $this->setTabla('acceso_proveedor');
    $acceso_proveedor = array(
      'id_tienda'    => $this->id_tienda,
      'id_proveedor' => $this->id_proveedor,
    );
    $this->insert($acceso_proveedor);
    return $acceso_proveedor;
  }

  /**
   * ACTUALIZA UN ACCESO
   * @return array
   */
  public function updAccProveedor()
  {
    $this->conexion();

    $query = "UPDATE acceso_proveedor
    SET id_tienda= :id_tienda, id_proveedor= :id_proveedor
    WHERE id_tienda= :id_tienda_2 AND id_proveedor= :id_proveedor_2";

    $statement = $this->conn->Prepare($query);
    $statement->bindParam(':id_tienda', $this->datos['id_tienda']);
    $statement->bindParam(':id_proveedor', $this->datos['id_proveedor']);
    $statement->bindParam(':id_tienda_2', $this->id_tienda);
    $statement->bindParam(':id_proveedor_2', $this->id_proveedor);
    $statement->Execute();

    return $this->datos;
  }

  /**
   * ELIMINA UN ACCESO
   */
  public function delAccProveedor()
  {
    $this->conexion();
    $this->setTabla('acceso_proveedor');
    $acceso_proveedor = array(
      'id_tienda'    => $this->id_tienda,
      'id_proveedor' => $this->id_proveedor,
    );
    $this->delete($acceso_proveedor);
  }

}
