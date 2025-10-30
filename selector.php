<?php
if(array_key_exists("contenido", $_GET)){
    switch($_GET["contenido"]){
        case "productos": 
            $contenido = "productos.php"; 
            $meta["title"] = "Mis productos";
            $meta["description"] = "Mis productos";
        break;
        case "verproducto":
            $contenido = "producto_ver.php";  
            $meta["title"] = "Ver producto";
            $meta["description"] = "Los que me van a hacer ganar pasta.";
        break;
        case "editarproducto":
            $contenido = "producto_editar.php";  
            $meta["title"] = "Ver producto";
            $meta["description"] = "Los que me van a hacer ganar pasta.";
        break;
        case "pedidos": 
            $contenido = "pedidos.php";  
            $meta["title"] = "Mis pedidos";
            $meta["description"] = "Los que me van a hacer ganar pasta.";
        break;
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