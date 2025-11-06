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
    

<div class="container">
    <div class="card">
        <div class="card-body">

        <form action="">
            <h3 class="card-title">input type =<?php echo $datos["imagen"]; ?></h3>
            <h6 class="card-subtitle">globe type chair for rest</h6>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="https://www.bootdey.com/image/430x600/00CED1/000000" class="img-responsive"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">Product description</h4>
                    <p></p>
                    <h2 class="mt-5">
                        $153<small class="text-success">(36%off)</small>
                    </h2>
                    <button class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                        <i class="fa fa-shopping-cart"></i>
                    </button>
                    <a href="index.php?contenido=editarproducto&id$_GET["id"])" class="btn btn-primary btn-rounded">Editar</a>
                    <h3 class="box-title mt-5">Key Highlights</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check text-success"></i>Sturdy structure</li>
                        <li><i class="fa fa-check text-success"></i>Designed to foster easy portability</li>
                        <li><i class="fa fa-check text-success"></i>Perfect furniture to flaunt your wonderful collectibles</li>
                    </ul>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title mt-5">General Info</h3>
        </form>
                  
</body>