<?php
require_once("../../classes/producto.class.php");
$objProducto = new Producto($db);

switch($action) {
    case "view":
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header("Location: ?module=producto&action=list&error=invalid_id");
            exit;
        }
        
        $datos = $objProducto->verdetalle($id);
        if (!$datos) {
            header("Location: ?module=producto&action=list&error=not_found");
            exit;
        }
        echo $objProducto->render("modules/producto/views/view.html", $datos, "detail");
        break;
        
    case "list":
        $pagina = (isset($_GET["pagina"])) ? (int)$_GET["pagina"] : 1;
        $listado = $objProducto->listarDB($pagina, PAGINADO);
        echo $objProducto->render("modules/producto/views/list.html", $listado, "list");
        break;
        

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->nuevo($_POST);
            if ($ok) {
                header("Location: ?module=producto&action=list&created=1");
                exit;
            } else {
                // If creation fails, show form again (optional: pass error message)
                echo $objProducto->render("modules/producto/views/form.html", ['modo' => 'create', 'error' => true], "form");
            }
        } else {
            echo $objProducto->render("modules/producto/views/form.html", ['modo' => 'create'], "form");
        }
        break;
    
        
    case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->guardardetalle($id, $_POST);
            header("Location: ?module=producto&action=list&updated=" . ($ok ? 1 : 0));
            exit;
        } else {
            $fila = $objProducto->editardetalle($id);
            if (!$fila) {
                header("Location: ?module=producto&action=list&error=not_found");
                exit;
            }
            echo $objProducto->render("modules/producto/views/form.html", ['modo' => 'edit', 'fila' => $fila], "form");
        }
        break;
        
    case 'delete':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $objProducto->eliminar($id);  
            header("Location: ?module=producto&action=list&deleted=" . ($ok ? 1 : 0));  
            exit;
        } else {
            $fila = $objProducto->verdetalle($id);
            if (!$fila) {
                header("Location: ?module=producto&action=list&error=not_found");
                exit;
            }
            echo $objProducto->render("modules/producto/views/delete.html", ['modo' => 'delete', 'fila' => $fila], "delete");  
        }
        break;

    default:
        http_response_code(400);
        echo $objProducto->render("modules/producto/views/error.html", ['error' => 'Acción no válida'], "error");  
        break;
}
?>