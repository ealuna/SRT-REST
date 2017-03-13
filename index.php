<?php

//Dentro de index.php

require 'getrows.php';

require_once 'configdb.php';

//print conexion::obtenerInstancia()->obtener_bd()->errorCode();
$getdat = $_GET['codigo'];
print getdatos::get_connection($getdat);


?>
