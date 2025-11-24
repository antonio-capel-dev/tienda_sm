<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo ($modo === 'create') ? 'Nuevo Impuesto' : 'Editar Impuesto'; ?></h1>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="post" action="?contenido=<?php echo ($modo === 'create') ? 'creartipoimpuesto' : 'editartipoimpuesto&id='.$fila['id_tipo_impuesto']; ?>">
            
            <div class="mb-3">
                <label for="impuesto" class="form-label">Nombre del Impuesto</label>
                <input type="text" class="form-control" id="impuesto" name="impuesto" 
                       value="<?php echo isset($fila['impuesto']) ? htmlspecialchars($fila['impuesto']) : ''; ?>" 
                       required placeholder="Ej: IVA Normal">
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor (%)</label>
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" 
                       value="<?php echo isset($fila['valor']) ? $fila['valor'] : ''; ?>" 
                       required placeholder="Ej: 21">
                <small class="form-text text-muted">Introduce el porcentaje sin el símbolo %</small>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="?contenido=tiposimpuesto" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
