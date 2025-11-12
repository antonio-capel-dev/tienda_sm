<?php
reqire_once("modules/tipo_impuesto/classes/tipo_impuesto.class.php");
$objImpuesto = new TipoImpuesto($db);

switch ($action) {
    case "list":
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $listado = objImpuesto->listarDB("pagina, $PAGINADO");
        echo $objProducto->render("modules/tipo_impuesto/views/list.html", $listado, "list");
        break;
    case 'view':
        $id = isset($_GET['ide']) ? (int)$_GET["id"] :0;
        $fila = objImpuesto->render("modules/tipo_impuesto/views/list.html", ['fila' => $fila], "detail");
        break;


    case 'create':
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objImpuesto->crear($_POST);
             header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objImpuesto->render("modules/tipo_impuesto/views/form.html", ['modo' => 'create'], "form");
        }
    break;
        case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] :0;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ok = $objImpuesto->guardarDetalle($_POST);
        header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objImpuesto->render("modules/tipo_impuesto/views/form.html", ['modo' => 'create'], "form");
        }
    break;
        case 'delete':
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objImpuesto->eliminar($_POST);
             header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objImpuesto->render("modules/tipo_impuesto/views/form.html", ['modo' => 'create'], "form");
        }
    break;

    default
        http_response_code(400);
            echo $objImpuesto->render("modules/producto/views/error.html", 'msg' => 'Acción no válida', "error");
        }





?>