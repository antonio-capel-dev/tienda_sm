<?php
require_once("../config.php");
$datos= file_get_contents("productos-100.csv");



echo "<pre>"; print_r($lineas); echo "</pre>";


for($x=1; $x<count($lineas); $x++) {

    $columnas = explode(",", $lineas [$x]);
    if (count($columnas) == 13) {
        echo "<pre>"; print_r($columnas); echo "</pre><hr>";
    
    $consulta="INSERT INTO(producto(nombre, descripcion, precio, id_tipo_impuesto) VALUES(:nombre, :descripcion, :precio, :id_tipo_impuesto))";
    $stmt = $db->prepare($consulta);
    $stmt->bindValue(":nombre", $columnas[1]);
    $stmt->bindValue(":descripcion", $columnas[2]);
    $stmt->bindValue(":precio", $columnas[5]);
    $stmt->bindValue(":id_tipo_impuesto", $columnas[1]);
    $stmt->execute();
    }else {
        echo "<pre>"; print_r($columnas); echo "</pre><hr>";

    }
    }

?>