<?php
if(array_key_exists("contenido", $_GET)){
    switch($_GET["contenido"]){
        case "productos": 
            $contenido = "productos.php"; 
            $meta["title"] = "Mis productos";
            $meta["description"] = "Mis productos";
        break;
        case "pedidos": 
            $contenido = "pedidos.php";  
            $meta["title"] = "Mis pedidos";
            $meta["description"] = "Los que me van a hacer ganar pasta.";
        break;
        default: 
            $contenido = "centro.php"; 
            $meta["title"] = "Mi tienda";
            $meta["description"] = "Mi tienda es mia";
        break;
    }
}else{
    $contenido = "centro.php"; 
    $meta["title"] = "Mi tienda";
    $meta["description"] = "Mi tienda es mia";
}

?>