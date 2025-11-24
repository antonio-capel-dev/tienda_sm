<?php
require_once(__DIR__ . "/../classes/producto.class.php");
$objProducto = new Producto($db);
switch($action) {
    case "view":
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header("Location: ?contenido=productos&error=invalid_id");
            exit;
        }
        
        $fila = $objProducto->verdetalle($id);
        if (!$fila) {
            header("Location: ?contenido=productos&error=not_found");
            exit;
        }
        include("modules/producto/views/detalle-view.php");
        break;
        
    case "list":
        $pagina = (isset($_GET["pagina"])) ? (int)$_GET["pagina"] : 1;
        $listado = $objProducto->listarDB($pagina, PAGINADO);
        include("modules/producto/views/list-view.php");
        break;
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->nuevo($_POST);
            if ($ok) {
                header("Location: ?contenido=productos&created=1");
                exit;
            } else {
                $modo = 'create';
                $fila = [];
                $error = true;
                include("modules/producto/views/form-view.php");
            }
        } else {
            $modo = 'create';
            $fila = [];
            include("modules/producto/views/form-view.php");
        }
        break;
    
    case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->guardardetalle($id, $_POST);
            header("Location: ?contenido=productos&updated=" . ($ok ? 1 : 0));
            exit;
        } else {
            $fila = $objProducto->verdetalle($id);
            if (!$fila) {
                header("Location: ?contenido=productos&error=not_found");
                exit;
            }
            $modo = 'edit';
            include("modules/producto/views/form-view.php");
        }
        break;
        
    case 'delete':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->eliminar($id);
            header("Location: ?contenido=productos&deleted=" . ($ok ? 1 : 0));
            exit;
        } else {
            $fila = $objProducto->verdetalle($id);
            if (!$fila) {
                header("Location: ?contenido=productos&error=not_found");
                exit;
            }
            include("modules/producto/views/delete-view.php");
        }
        break;
    default:
        http_response_code(400);
        echo "Acción no válida";
        break;
}
?>