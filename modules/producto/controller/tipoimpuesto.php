<?php
require_once(_DIR_"/../classes/tipoimpuesto.class.php");
$objImpuesto = new Tipo_Impuesto($db);

switch ($action) {
    case "view":
        $id = isset($_GET["id"]) ? (int)$_GET['id'] : 0;

        if ($id <= 0) {
            header("Location: ?module=tipo_impuesto&action=list&error=invalid_id");
            exit;
        }
        $datos = $objTipoImpuesto->verDetalle($id) 
            if (!$datos) {
                header("Location: ?module=tipo_impuesto&action=list&error=not_found");
                exit;
        include "modules/producto/views/tipo_impuesto-detalle-view.php";
        break;
        }

    case "list":
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        $listado = $objImpuesto->listarDB($pagina, PAGINADO);

        include "modules/producto/views/tipo_impuesto-list-view.php";
        break;

    case "create":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $ok = $objImpuesto->crear($_POST);
            if ($ok) {
                header("Location: ?module=tipo_impuesto&action=list&created=1");
                exit;
            } else {
                $modo = 'create';
                $fila = [];
                $error = true;
                include "modules/producto/views/tipoimpuesto-form-view.php";
            }             
            
        } else {
            $modo = 'create';
            $fila = [];
            include "modules/producto/views/tipoimpuesto-form-view.php";
        }
        break;
        


        case "edit":
            $id = isset($_GET["id"]) ? (int)$_GET['id'] : 0;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $ok = $objImpuesto->guardarDetalle($id, $_POST);
                if ($ok) {
                    header("Location: ?module=tipo_impuesto&action=list&updated=1");
                    exit;
                } else {
                    $fila = $_POST;
                    if (!$fila) {
                        header("Location: ?module=tipo_impuesto&action=list&error=not_found");
                        exit;
                    }
                    $modo = 'edit';
                    include "modules/producto/views/tipo_impuesto-form-view.php";
                }
                break;

            }
            

            case "delete":
                $id = isset($_GET["id"]) ? (int)$_GET['id'] : 0;
                
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $ok = $objImpuesto->eliminar($id);
                    if ($ok) {
                        header("Location: ?module=tipo_impuesto&action=list&deleted=1");
                        exit;
                    }
                } else {
                    $fila = $objImpuesto->verDetalle($id);
                    if (!$fila) {
                        header("Location: ?module=tipo_impuesto&action=list&error=not_found");
                        exit;
                    }
                

                default:
                    http_response_code(404);
                    echo "Acción no válida";
                    break;
                include "modules/producto/views/tipo_impuesto-delete-view.php";
                break;

                }
            }
?>
