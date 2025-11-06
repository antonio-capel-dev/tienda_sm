<?php
    require_once("modules/producto/classes/producto.class.php");
    $objProducto = new Producto($db);

    switch($action){
        case "view":
            $datos = $objProducto->verdetalle($_GET["id"]);
            echo $objProducto->render("modules/producto/views/view.html", $datos, "detail");
        break;
        case "list":
            $pagina=(isset($_GET["pagina"]))?$_GET["pagina"]:1;
            $listado = $objProducto->listarDB($pagina, PAGINADO);
            echo $objProducto->render("modules/producto/views/list.html", $listado, "list");
        break;
        default:
            http_response_code(400);
            echo $objProducto->render("modules/producto/views/error.html", $listado, "error");
    }

?>
