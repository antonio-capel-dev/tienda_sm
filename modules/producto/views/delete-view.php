<div class="row mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h3 class="card-title">¿Estás seguro?</h3>
            </div>
            <div class="card-body text-center">
                <p class="lead">
                     Vas a eliminar el producto:
                      <strong><?php echo $fila['nombre']; ?></strong>
                </p>
                <p class="text-muted">Esta acción no se puede deshacer.</p>

                <form method="post" action=>"?module=producto&action=delete&id=<?php echo $fila['id_producto']; ?>">

                <button type="submit" class="btn btn-danger">Eliminar
                    <i class="fas fa-trash">Si, eliminar</i>
                </button>

                <a href="?module=producto&action=list" class="btn btn-secondary">
                Cancelar</a>
                </form>
            </div>
        </div>
    </div>