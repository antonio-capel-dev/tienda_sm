<?php
if(array_key_exists("contenido", $_GET)){
    switch($_GET["contenido"]){
        case "productos": 
            $contenido = "modules/producto/controller/productos.php"; 
            $action = "list";
            $meta["title"] = "Mis productos";
            $meta["description"] = "Mis productos";
            break;
            
        case "verproducto": 
            $contenido = "modules/producto/controller/productos.php"; 
            $action = "view";
            $meta["title"] = "Ver producto";
            $meta["description"] = "Vamos a ver la ficha del producto.";
            break;
            
        case "editarproducto":
            $contenido = "modules/producto/controller/productos.php"; 
            $action = "edit";
            $meta["title"] = "Editar producto";
            $meta["description"] = "Vamos a editar la ficha del producto.";
            break;
            
        case "crearproducto":
            $contenido = "modules/producto/controller/productos.php"; 
            $action = "create";
            $meta["title"] = "Nuevo producto";
            $meta["description"] = "Añadir un nuevo producto a la tienda.";
            break;
            
        case "eliminarproducto":
            $contenido = "modules/producto/controller/productos.php"; 
            $action = "delete";
            $meta["title"] = "Eliminar producto";
            $meta["description"] = "Eliminar un producto de la tienda.";
            break;
            
        case "tiposimpuesto":
            $contenido = "modules/producto/controller/tipoimpuesto.php";
            $action = "list";
            $meta["title"] = "Tipos de Impuesto";
            $meta["description"] = "Gestión de tipos de impuesto";
            break;
            
        case "vertipoimpuesto":
            $contenido = "modules/producto/controller/tipoimpuesto.php";
            $action = "view";
            $meta["title"] = "Ver Impuesto";
            $meta["description"] = "Detalle del tipo de impuesto";
            break;
            
        case "creartipoimpuesto":
            $contenido = "modules/producto/controller/tipoimpuesto.php";
            $action = "create";
            $meta["title"] = "Nuevo Impuesto";
            $meta["description"] = "Añadir un nuevo tipo de impuesto";
            break;
            
        case "editartipoimpuesto":
            $contenido = "modules/producto/controller/tipoimpuesto.php";
            $action = "edit";
            $meta["title"] = "Editar Impuesto";
            $meta["description"] = "Modificar tipo de impuesto";
            break;
            
        case "eliminartipoimpuesto":
            $contenido = "modules/producto/controller/tipoimpuesto.php";
            $action = "delete";
            $meta["title"] = "Eliminar Impuesto";
            $meta["description"] = "Eliminar tipo de impuesto";
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
} else {
    $contenido = "centro.php"; 
    $meta["title"] = "Mi tienda";
    $meta["description"] = "Mi tienda es mia";
}
?>