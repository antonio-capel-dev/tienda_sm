<?php
require_once("modules/tipo_impuesto/classes/tipo_impuesto.class.php");
$objImpuesto = new Tipo_Impuesto($db);

switch ($action) {
    case "list":
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $listado = $objImpuesto->listarDB($pagina, PAGINADO);
        echo $objImpuesto->render(['datos' => $listado, 'modo' => 'list']);
        break;

    case 'view':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id <= 0) {
            header("Location: ?module=tipo_impuesto&action=list&error=invalid_id");
            exit;
        }

        $fila = $objImpuesto->obtenerPorId($id);
        if (!$fila) {
            header("Location: ?module=tipo_impuesto&action=list&error=not_found");
            exit;
        }
        echo $objImpuesto->render(['fila' => $fila, 'modo' => 'view']);
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objImpuesto->nuevo($_POST['nombre'], $_POST['porcentaje']);
            header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        } else {
            echo $objImpuesto->render(['modo' => 'create']);
        }
        break;

    case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objImpuesto->modificar($id, $_POST['nombre'], $_POST['porcentaje']);
            header("Location: ?module=tipo_impuesto&action=list&updated=" . ($ok ? 1 : 0));
            exit;
        } else {
            $fila = $objImpuesto->obtenerPorId($id);
            if (!$fila) {
                header("Location: ?module=tipo_impuesto&action=list&error=not_found");
                exit;
            }
            echo $objImpuesto->render(['fila' => $fila, 'modo' => 'edit']);
        }
        break;

    case 'delete':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objImpuesto->baja($id);
            header("Location: ?module=tipo_impuesto&action=list&deleted=" . ($ok ? 1 : 0));
            exit;
        } else {
            $fila = $objImpuesto->obtenerPorId($id);
            if (!$fila) {
                header("Location: ?module=tipo_impuesto&action=list&error=not_found");
                exit;
            }
            echo $objImpuesto->render(['fila' => $fila, 'modo' => 'delete']);
        }
        break;

    default:
        http_response_code(400);
        echo $objImpuesto->render(['error' => 'Acción no válida', 'modo' => 'error']);
        break;
}
?>