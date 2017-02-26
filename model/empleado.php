<?php

/**
 *
 */
class Empleado extends SlimApp
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
   * LISTADO DE EMPLEADOS
   * @return array
   */
  public function getListadoE()
  {
    $this->conexion();

    $query     = "SELECT * FROM empleado";
    $empleados = $this->fetchAll($query);

    for ($i = 0; $i < sizeof($empleados); $i++) {
      $puesto = new Puesto;
      $puesto->setId($empleados[$i]['id_puesto']);
      $empleados[$i]['puesto'] = $puesto->getPuesto();
      unset($empleados[$i]['id_puesto']);
    }

    return $empleados;
  }

  /**
   * OBTIENE UN EMPLEADO
   * @return array
   */
  public function getEmpleado()
  {
    $this->conexion();

    $query    = "SELECT * FROM empleado WHERE id=" . $this->id;
    $empleado = $this->fetchAll($query);

    if (!isset($empleado[0])) {
      return array('notice' => array('text' => "No existe el empleado especificado"));
    }

    $puesto = new Puesto;
    $puesto->setId($empleado[0]['id_puesto']);
    $empleado[0]['puesto'] = $puesto->getPuesto();
    unset($empleado[0]['id_puesto']);

    return $empleado;
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
