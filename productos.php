<?php

    require_once("classes/producto.class.php");
    
    $objProducto = new Producto($db);
    $pagina=(isset($_GET["pagina"]))?$_GET["pagina"]:1;
    

    $listado = $objProducto->listarDB($pagina, PAGINADO);


     echo "<pre>"; print_r($listado); echo "</pre>";
    
?>
<div class="row mt-3">
    <h2>Listado de productos</h2> <a href="btn btn-succes">Nuevo producto</a>
</div>
<div class="row mt-3">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php
            foreach($listado["datos"] as $id=>$prod){
                $precio=($prod["precio"]!="")?number_format($prod["precio"], 2, ",", ".")." €":"";
                echo '<tr>';
<<<<<<< HEAD
                    echo '<td>'.$prod.'</td>';
                    echo '<td>'.$prod["nombre"].'</td>';
                    echo '<td align="right">'.$precio.'</td>';
                    echo '<td>';
                    echo '<a href="index.php?contenido=verproducto&id='.$prod["id_producto"].'"Ver</a>';
=======
                    echo '<td>'.$prod["id_producto"].'</td>';
                    echo '<td>'.$prod["nombre"].'</td>';
                    echo '<td align="right">'.$precio.'</td>';
                    echo '<td>';
                    echo '<a href="index.php?contenido=verproducto&id='.$prod["id_producto"].'">Ver</a>';
>>>>>>> b588d6d (✨ Refactor completo: CRUD de tipo_impuesto y producto, controladores corregidos, paginación segura, validaciones, sanitización, render mejorado y arquitectura MVC más sólida.)
                    echo '</td>';
                echo '</tr>';
                
            }
<<<<<<< HEAD
                                                                                                          ?> 
=======
                                                                                                                   ?> 
>>>>>>> b588d6d (✨ Refactor completo: CRUD de tipo_impuesto y producto, controladores corregidos, paginación segura, validaciones, sanitización, render mejorado y arquitectura MVC más sólida.)
    </table>
    <div class="paginado">
        <?php

            if($listado["paginas"]>0){
        
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
<<<<<<< HEAD
               
    
=======
>>>>>>> b588d6d (✨ Refactor completo: CRUD de tipo_impuesto y producto, controladores corregidos, paginación segura, validaciones, sanitización, render mejorado y arquitectura MVC más sólida.)
            }
        ?>
    </div>
</div>