<div class="row mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h3>¿Eliminar Impuesto?</h3>
            </div>
            <div class="card-body text-center">
                <p class="lead">
                    Vas a eliminar: <strong><?php echo $fila['impuesto']; ?> (<?php echo $fila['valor']; ?>%)</strong>
                </p>
                <p class="text-muted">Esta acción no se puede deshacer.</p>
                
                <form method="post" action="?contenido=eliminartipoimpuesto&id=<?php echo $fila['id_tipo_impuesto']; ?>">
                    <button type="submit" class="btn btn-danger btn-lg">Sí, eliminar</button>
                    <a href="?contenido=tiposimpuesto" class="btn btn-secondary btn-lg">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>