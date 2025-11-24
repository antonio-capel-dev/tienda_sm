<div class="row mt-3">
    <div class="col-md-6 offset-md-3">
        <h2>Detalle del Impuesto</h2>
        
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?php echo $datos['id_tipo_impuesto']; ?></p>
                <p><strong>Nombre:</strong> <?php echo $datos['impuesto']; ?></p>
                <p><strong>Valor:</strong> <?php echo $datos['valor']; ?>%</p>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="?contenido=editartipoimpuesto&id=<?php echo $datos['id_tipo_impuesto']; ?>" class="btn btn-primary">Editar</a>
            <a href="?contenido=tiposimpuesto" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
