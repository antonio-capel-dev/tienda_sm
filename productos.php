<?php

    require_once("classes/producto.class.php");
    
    $objProducto = new Producto($db);
    $pagina=(isset($_GET["pagina"]))?$_GET["pagina"]:1;
    
    
    $listado = $objProducto->listar($pagina, PAGINADO);
    $listadoDB = $objProducto->listardb($pagina, PAGINADO);

    $objProducto->listado();

    //echo "<pre>"; print_r($listado); echo "</pre>";
?>
<div class="row mt-3">
    <h2>Listado de productos</h2>
</div>
<div class="row mt-3">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Producto</th>
        </tr>
        <?php
            foreach($listado["datos"] as $id=>$prod){
                $precio=($prodm);
                echo '<tr>';
                    echo '<td>'.$id.'</td>';
                    echo '<td>'.$prod.'</td>';
                echo '</tr>';
            }
        ?> 
    </table>
    <div class="paginado">
        <?php

            if($listado["paginas"]>0){
                //echo '<a href="?contenido=productos&pagina=1">1</a>';
                echo '<nav aria-label="Page navigation example">';
                echo '<ul class="pagination">';
                echo '<li class="page-item disabled"><a class="page-link">anterior</a></li>';
                for($x=0; $x<$listado["paginas"]; $x++){
                    if(isset($_GET["pagina"]) && ($x+1)==$_GET["pagina"]){
                        $activeClass=" active ";
                    }else{
                        $activeClass="";
                    }
                    echo '<li class="page-item'.$activeClass.'"><a class="page-link" href="?contenido=productos&pagina=' . ($x + 1) . '">' . ($x + 1) . '</a></li>';
                }
                echo '<li class="page-item"><a class="page-link">siguiente</a></li>';
                echo '</ul>';
                echo '</nav>';
               
                //echo '<a href="?contenido=productos&pagina='.$listado["paginas"].'">'.$listado["paginas"].'</a>';
            }

        ?>
    </div>
</div>