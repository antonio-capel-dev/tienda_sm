<?php
require_once("../config.php");
$fichero="products-100.csv";
$objFichero=fopen($fichero, "r");

$csv = fgetcsv($punterofichero, 1000, ",", '"');
$punterofichero=fopen($fichero, "r");
$cabeceras = fgetcsv($punterofichero, null, ",", '"');
while(($csv = fgetcsv($punterofichero, 10000, ",", '"')) !==FALSE){
    print_r($csv);

    $consulta="INSERT INTO(producto(nombre, descripcion, precio, id_tipo_impuesto) VALUES(:nombre, :descripcion, :precio, :id_tipo_impuesto))";
    $stmt = $db->prepare($consulta);
    $stmt->bindValue(":nombre", $columnas[1]);
    $stmt->bindValue(":descripcion", $columnas[2]);
    $stmt->bindValue(":precio", $columnas[5]);
    $stmt->bindValue(":id_tipo_impuesto", $columnas[1]);
    $stmt->execute();
};


fclose($punterofichero);



?>