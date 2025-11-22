<?php
    require_once("classes/producto.class.php");
    
    $objProducto = new Producto($db);
    if($objProducto->guardardetalle($_GET["id"], $_POST)){
        echo "Enhorabuena, producto guardado con éxito.";
        echo '<a href="index.php?contenido=verproducto&id='.$_GET["id"].'">Volver al producto</a>';
        echo '<br>';
        echo '<a href="index.php?contenido=productos">Volver al listado</a>';
    }else{
        echo "Error al guardar";
        echo '<a href="index.php?contenido=verproducto&id='.$_GET["id"].'">Volver al producto</a>';
        echo '<br>';
        echo '<a href="index.php?contenido=productos">Volver al listado</a>';
    }

    //echo "<pre>"; print_r($datos); echo "</pre>";
?>