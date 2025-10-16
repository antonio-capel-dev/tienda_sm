<?php
if(array_key_exists("contenido", $_GET)){


switch($_GET["contenido"]){
    case "productos":
    $contenido = "classes/producto.php";
        $meta["title"] = "Mis productos";
        $meta["description"] = "Mis productos";
        break;

    case "pedidos":
      $contenido = "classes/pedidos.php";
            $meta["title"] = "Mis pedidos";
            $meta["description"] = "Los que me van a hacer ganar pasta";
        break;

        default:
            $contenido = "centro.php";
            $meta["title"] = "Mi tienda";
            $meta["description"] = "Mi tienda es mía";
        break; 
        }
}
 else {
    $contenido = "centro.php";
    $meta["title"] = "Mi tienda";
    $meta["description"] = "Mi tienda es mía";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo isset($meta['description']) ? $meta['description'] : ''; ?>">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
  <title><?php echo isset($meta['title']) ? $meta['title'] : 'Mi tienda'; ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

  <?php
  include_once("left-menu.php");
  ?> 

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<?php include_once("header.php"); ?>

<div class="container-fluid">
  <div class="row">
    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <?php 
  include_once($contenido);
      ?>
    </main>
  </div>
</div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="assets/js/dashboard.js"></script>
  </body>
</html>
