<?php
if(array_key_exists("contenido", $_GET)){
    switch($_GET["contenido"]){
        case "productos": 
            $contenido = "modules/producto/controller/productos.php"; 
            $action="list";
            $meta["title"] = "Mis productos";
            $meta["description"] = "Mis productos";
        break;
        case "verproducto": 
            $contenido = "modules/producto/controller/productos.php"; 
            $action="view";
            $meta["title"] = "Ver producto";
            $meta["description"] = "Vamos a ver la ficha del producto.";
        break;
        case "editarproducto":
            $contenido = "modules/producto/controller/productos.php"; 
            $meta["title"] = "Editar producto";
            $meta["description"] = "Vamos a editar la ficha del producto.";
        break;
        case "guardarproducto":
            $contenido = "modules/producto/controller/productos.php"; 
            $meta["title"] = "Guardar producto";
            $meta["description"] = "Vamos a guardar los cambios del producto.";
        break;
        case "crearproducto":
            $contenido = "modules/producto/controller/productos.php"; 
            $action="create";
            $meta["title"] = "Nuevo producto";
            $meta["description"] = "Añadir un nuevo producto a la tienda.";
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