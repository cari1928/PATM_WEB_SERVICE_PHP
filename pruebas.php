<?php

require 'slimapp.class.php';

$web->conexion();
$query     = "SELECT * FROM empleado";
$empleados = $web->fetchAll($query);

for ($i = 0; $i < sizeof($empleados); $i++) {
  $puesto = new Puesto;
  $puesto->setId($empleados[$i]['id_puesto']);
  $empleados[$i]['puesto'] = $puesto->getPuesto();
  unset($empleados[$i]['id_puesto']);
}

$web->debug($empleados);
