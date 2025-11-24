<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tipos de Impuesto</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="?contenido=creartipoimpuesto" class="btn btn-sm btn-success">+ Nuevo Impuesto</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Valor (%)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($listado["datos"]) && count($listado["datos"]) > 0): ?>
                <?php foreach($listado["datos"] as $impuesto): ?>
                <tr>
                    <td><?php echo $impuesto["id_tipo_impuesto"]; ?></td>
                    <td><?php echo htmlspecialchars($impuesto["impuesto"]); ?></td>
                    <td><?php echo $impuesto["valor"]; ?>%</td>
                    <td>
                        <a href="?contenido=vertipoimpuesto&id=<?php echo $impuesto["id_tipo_impuesto"]; ?>">Ver</a> |
                        <a href="?contenido=editartipoimpuesto&id=<?php echo $impuesto["id_tipo_impuesto"]; ?>">Editar</a> |
                        <a href="?contenido=eliminartipoimpuesto&id=<?php echo $impuesto["id_tipo_impuesto"]; ?>" class="text-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No hay tipos de impuesto registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
