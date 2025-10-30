<?php
require_once("classes/producto.class.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("Error, no hay producto escogido para editar");
}

$objProducto = new Producto($db);
$producto = $objProducto->editardetalle($_GET["id"]);
echo "<pre>"; print_r($producto); echo "</pre>";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <!-- TARJETA PRINCIPAL -->
                <div class="card shadow">
                    
                    <!-- CABECERA -->
                    <div class="card-header bg-warning text-dark">
                        <h3 class="mb-0">
                            <i class="fas fa-edit"></i> Editar Producto
                        </h3>
                    </div>
                    
                    <!-- CUERPO -->
                    <div class="card-body">
                        
                        <!-- ============================================ -->
                        <!-- AQUÍ EMPIEZA EL FORMULARIO                   -->
                        <!-- ============================================ -->
                        
                        <form action="procesar_editar.php" method="POST" enctype="multipart/form-data" id="formEditar">
                            
                            <!-- ============================================ -->
                            <!-- CAMPO 1: ID OCULTO (hidden)                  -->
                            <!-- Pista: Usa $producto['id_producto']         -->
                            <!-- ============================================ -->
                            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto'];">
                            
                            
                            <!-- ============================================ -->
                            <!-- CAMPO 2: IMAGEN ACTUAL OCULTA                -->
                            <!-- Pista: Usa $producto['imagen']              -->
                            <!-- Pista 2: Recuerda htmlspecialchars()        -->
                            <!-- ============================================ -->
                            <input type="hidden" name="imagen_actual" value="AQUÍ_VA_PHP">
                            
                            
                            <!-- ============================================ -->
                            <!-- CAMPO 3: NOMBRE DEL PRODUCTO                 -->
                            <!-- ============================================ -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-tag"></i> Nombre del producto *
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="nombre" 
                                    name="nombre"
                                    value="AQUÍ_VA_PHP"
                                    required
                                    maxlength="200"
                                    placeholder="Ej: Mesa de roble macizo"
                                >
                                <!-- Pista: Usa $producto['nombre'] -->
                                <!-- Pista 2: Recuerda htmlspecialchars() -->
                            </div>

                            
                            <!-- ============================================ -->
                            <!-- CAMPO 4: DESCRIPCIÓN                         -->
                            <!-- ============================================ -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">
                                    <i class="fas fa-align-left"></i> Descripción *
                                </label>
                                <textarea 
                                    class="form-control" 
                                    id="descripcion" 
                                    name="descripcion" 
                                    rows="5"
                                    required
                                    placeholder="Describe el producto..."
                                >AQUÍ_VA_PHP</textarea>
                                <!-- IMPORTANTE: En textarea el valor va ENTRE las etiquetas -->
                                <!-- Pista: Usa $producto['descripcion'] -->
                                <!-- Pista 2: Recuerda htmlspecialchars() -->
                            </div>

                            
                            <!-- ============================================ -->
                            <!-- CAMPO 5: PRECIO                              -->
                            <!-- ============================================ -->
                            <div class="mb-3">
                                <label for="precio" class="form-label">
                                    <i class="fas fa-euro-sign"></i> Precio (€) *
                                </label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="precio" 
                                    name="precio" 
                                    value="AQUÍ_VA_PHP"
                                    step="0.01"
                                    min="0"
                                    required
                                    placeholder="19.99"
                                >
                                <!-- Pista: Usa $producto['precio'] -->
                                <!-- Pista 2: NO uses htmlspecialchars() en números -->
                            </div>

                            
                            <!-- ============================================ -->
                            <!-- CAMPO 6: IMAGEN ACTUAL (mostrar)             -->
                            <!-- ============================================ -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-image"></i> Imagen actual
                                </label>
                                <div class="border rounded p-3 text-center bg-light">
                                    
                                    <!-- AQUÍ VA UN IF: Si hay imagen, muéstrala. Si no, muestra "Sin imagen" -->
                                    <!-- Pista: if (!empty($producto['imagen'])) -->
                                    
                                    <!-- AQUÍ VA EL IF DE PHP -->
                                    
                                        <img 
                                            src="AQUÍ_VA_LA_RUTA_DE_LA_IMAGEN" 
                                            alt="Imagen actual" 
                                            class="img-fluid rounded"
                                            style="max-height: 200px;"
                                        >
                                        <p class="mt-2 text-muted small">
                                            AQUÍ_VA_BASENAME_DE_LA_IMAGEN
                                        </p>
                                    
                                    <!-- AQUÍ VA EL ELSE -->
                                    
                                        <p class="text-muted">
                                            <i class="fas fa-image"></i> Sin imagen
                                        </p>
                                    
                                    <!-- AQUÍ VA EL ENDIF -->
                                    
                                </div>
                            </div>

                            
                            <!-- ============================================ -->
                            <!-- CAMPO 7: NUEVA IMAGEN (opcional)             -->
                            <!-- ============================================ -->
                            <div class="mb-3">
                                <label for="imagen" class="form-label">
                                    <i class="fas fa-upload"></i> Cambiar imagen (opcional)
                                </label>
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    id="imagen" 
                                    name="imagen"
                                    accept="image/*"
                                >
                                <small class="form-text text-muted">
                                    📁 Formatos: JPG, PNG, GIF, WEBP | 📏 Máx: 2MB
                                </small>
                            </div>

                            
                            <!-- ============================================ -->
                            <!-- BOTONES DE ACCIÓN                            -->
                            <!-- ============================================ -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="index.php?contenido=productos" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> 💾 Guardar cambios
                                </button>
                            </div>

                        </form>
                        <!-- FIN DEL FORMULARIO -->
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript de validación (BONUS) -->
    <script>
        // Validación antes de enviar
        document.getElementById('formEditar').addEventListener('submit', function(e) {
            const precio = document.getElementById('precio').value;
            const nombre = document.getElementById('nombre').value;
            
            // Validar precio positivo
            if (parseFloat(precio) < 0) {
                e.preventDefault();
                alert('⚠️ El precio no puede ser negativo');
                return false;
            }
            
            // Validar nombre no vacío
            if (nombre.trim().length < 3) {
                e.preventDefault();
                alert('⚠️ El nombre debe tener al menos 3 caracteres');
                return false;
            }
        });
    </script>
</body>
</html>