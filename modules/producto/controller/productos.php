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
<<<<<<< HEAD
=======
        case 'create':
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->crear($_POST);
             header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objProducto->render("modules/tipo_impuesto/views/form.html", ['modo' => 'create'], "form");
        }
    break;
        case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] :0;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ok = $objProducto->guardarDetalle($_POST);
        header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objProducto->render("modules/tipo_impuesto/views/form.html", ['modo' => 'create'], "form");
        }
    break;
        case 'delete':
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->eliminar($_POST);
             header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objProducto->render("modules/tipo_impuesto/views/form.html", ['modo' => 'create'], "form");
        }
    break;
>>>>>>> b588d6d (✨ Refactor completo: CRUD de tipo_impuesto y producto, controladores corregidos, paginación segura, validaciones, sanitización, render mejorado y arquitectura MVC más sólida.)
        default:
            http_response_code(400);
            echo $objProducto->render("modules/producto/views/error.html", $listado, "error");
    }

?>
