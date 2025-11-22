<?php
require_once("modules/tipo_impuesto/classes/tipo_impuesto.class.php");
$objImpuesto = new Tipo_Impuesto($db);

switch ($action) {

    /* =======================
       LISTADO
       ======================= */
    case "list":
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        $listado = $objImpuesto->listarDB($pagina, PAGINADO);

        $rows = $objImpuesto->renderRows($listado["datos"]);

        $html = file_get_contents("modules/tipo_impuesto/views/list.html");
        $html = str_replace("##CONTENT@@", $rows, $html);

        echo $html;
    break;


    /* =======================
       VER DETALLE
       ======================= */
    case "view":
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

        if ($id <= 0) {
            header("Location: ?module=tipo_impuesto&action=list&error=invalid_id");
            exit;
        }

        $fila = $objImpuesto->verDetalle($id);

        if (!$fila) {
            header("Location: ?module=tipo_impuesto&action=list&error=not_found");
            exit;
        }

        $html = file_get_contents("modules/tipo_impuesto/views/view.html");
        $html = str_replace("##ID@@", $fila["id_tipo_impuesto"], $html);
        $html = str_replace("##IMPUESTO@@", $fila["impuesto"], $html);
        $html = str_replace("##VALOR@@", $fila["valor"], $html);

        echo $html;
    break;


    /* =======================
       CREAR
       ======================= */
    case "create":

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $ok = $objImpuesto->crear($_POST);

            header("Location: ?module=tipo_impuesto&action=list&created=" . ($ok ? 1 : 0));
            exit;
        }

        $html = file_get_contents("modules/tipo_impuesto/views/form.html");
        $html = str_replace("##TITULO@@", "Nuevo impuesto", $html);
        $html = str_replace("##ACTION@@", "?module=tipo_impuesto&action=create", $html);
        $html = str_replace("##ID@@", "", $html);
        $html = str_replace("##IMPUESTO@@", "", $html);
        $html = str_replace("##VALOR@@", "", $html);

        echo $html;
    break;


    /* =======================
       EDITAR
       ======================= */
    case "edit":
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

        if ($id <= 0) {
            header("Location: ?module=tipo_impuesto&action=list&error=invalid_id");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $ok = $objImpuesto->guardarDetalle($id, $_POST);

            header("Location: ?module=tipo_impuesto&action=list&updated=" . ($ok ? 1 : 0));
            exit;
        }

        $fila = $objImpuesto->verDetalle($id);

        if (!$fila) {
            header("Location: ?module=tipo_impuesto&action=list&error=not_found");
            exit;
        }

        $html = file_get_contents("modules/tipo_impuesto/views/form.html");
        $html = str_replace("##TITULO@@", "Editar impuesto", $html);
        $html = str_replace("##ACTION@@", "?module=tipo_impuesto&action=edit&id=$id", $html);
        $html = str_replace("##ID@@", $fila["id_tipo_impuesto"], $html);
        $html = str_replace("##IMPUESTO@@", $fila["impuesto"], $html);
        $html = str_replace("##VALOR@@", $fila["valor"], $html);

        echo $html;
    break;


    /* =======================
       ELIMINAR
       ======================= */
    case "delete":
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

        if ($id <= 0) {
            header("Location: ?module=tipo_impuesto&action=list&error=invalid_id");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $ok = $objImpuesto->eliminar($id);

            header("Location: ?module=tipo_impuesto&action=list&deleted=" . ($ok ? 1 : 0));
            exit;
        }

        $fila = $objImpuesto->verDetalle($id);

        if (!$fila) {
            header("Location: ?module=tipo_impuesto&action=list&error=not_found");
            exit;
        }

        $html = file_get_contents("modules/tipo_impuesto/views/delete.html");
        $html = str_replace("##ID@@", $fila["id_tipo_impuesto"], $html);
        $html = str_replace("##IMPUESTO@@", $fila["impuesto"], $html);
        $html = str_replace("##VALOR@@", $fila["valor"], $html);

        echo $html;
    break;


    /* =======================
       ERROR
       ======================= */
    default:
        echo "Acción inválida";
    break;
}
?>
