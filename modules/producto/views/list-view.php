

<div class="row-mt-3">
    <div class="col-12">
        <h2>Listado de productos</h2>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
            <?php foreach($listado["datos"] as $producto): ?>
                    <tr>
                    <td><?php echo $producto["id_producto"]; ?></td>
                    <td><?php echo $producto["nombre"]; ?></td>
                    <td class="text-end">
                        <?php
                        if(!empty($producto["precio"])) {
                            echo number_format($producto["precio"], 2, ",", ".") . " €";
                        }
                        ?>
                    </td>

                    <td>
                        <a href="index.php?contenido=editarproducto&id=<?php echo $producto["id_producto"]?>">Editar</a>
                        <a href="index.php?contenido=eliminarproducto&id=<?php echo $producto["id_producto"]?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>    
    </div>
</div>    