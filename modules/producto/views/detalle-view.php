
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($datos['impuesto']); ?></h5>
                <table class="table table-borderless">
                    <tr>
                        <th>ID:</th>
                        <td><?php echo $datos['id_tipo_impuesto']; ?></td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><?php echo htmlspecialchars($datos['impuesto']); ?></td>
                    </tr>
                    <tr>
                        <th>Valor:</th>
                        <td><?php echo $datos['valor']; ?>%</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="?contenido=tiposimpuesto" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
