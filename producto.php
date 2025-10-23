<?php
    // echo "A";
    // require("classes/producto.class.php");
    // echo "B";
    require_once("classes/producto.class.php");
    // echo "C"; 
    // include("classes/producto.classs.php");
    // echo "D";
    // include("classes/producto.class.php");
    // echo "E";


    $objProducto = new Producto();
    echo "<pre>"; print_r($objProducto); echo "</pre>";

?>