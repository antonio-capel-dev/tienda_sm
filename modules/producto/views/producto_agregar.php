<?php
require_once("modules/producto/classes/producto.class.php");

$objProducto = new Producto($db);
$datos = $objProducto->verdetalle($_GET["id"]);

?>