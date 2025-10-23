<?php
require_once("classes/impuestosclass.php");

$objImpuesto = new Impuestos($db);
$pagina=(isset($_GET["pagina"]))?$_GET["pagina"]:1;

$listado = $objImpuesto->listar($pagina, PAGINADO);
$listadoDB = $objImpuesto->listarDB($pagina, PAGINADO);


 function listar($pagina, $paginado){
            $arrADevolver=array();
            $pagina-=1;

            $listado = $this->listado();

            $inicio=$pagina * $paginado;
            $fin=$inicio + $paginado;
            if($fin>count($listado)){
                $fin=count($listado);
            }
            

            for($x=$inicio; $x<$fin; $x++){
                $arrADevolver[$x]=$listado[$x];
            }
            
            return array("total"=>count($listado), "paginas"=>ceil(count($listado)/$paginado), "paginaActual"=>$pagina + 1, "datos"=>$arrADevolver);
        }






?>