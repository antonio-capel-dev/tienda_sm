<?php
    require_once("modules/producto/classes/producto.class.php");
    
    $objProducto = new Producto($db);
    $datos = $objProducto->verdetalle($_GET["id"]);

    //echo "<pre>"; print_r($datos); echo "</pre>";
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form name="frmGuardarProducto" id="frmGuardarProducto" action="index.php?contenido=guardarproducto&id=<?php echo $_GET["id"]; ?>" method="POST">
                <h3 class="card-title"><input type="text" name="nombre" id="nombre" value="<?php echo $datos["nombre"]; ?>"></h3>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center"><img src="<?php echo $datos["imagen"]; ?>" class="img-responsive"></div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h4 class="box-title mt-5">Descripción:</h4>
                        <textarea name="descripcion" id="descripcion" style="width: 100%" rows="10"><?php echo $datos["descripcion"]; ?></textarea>
                        <h2 class="mt-5">
                            <input type="number" step="0.01" name="precio" id="precio" value="<?php echo $datos["precio"]; ?>">€ <?php ?>
                        </h2>
                        <button class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>