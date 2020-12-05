<?php include_once('inc/funciones.php'); ?>


<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="zapatillas, calzado, zapas, nike, adidas">
    <meta name="description" content="Tienda on-line de zapatillas">
    <meta name="author" content="Zavala, Juarez, Alvarado">
    <!-- Bootstrap, CSS y Google Fonts-->
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:ital,wght@0,500;0,700;0,900;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title> <?php echo EtiquetaTitle(); ?> </title>
  </head>
  
  <body>
    <nav class="navbar navbar-expand-md navbar-dark" id="navcolor">
        <div class="container">

      <a class="navbar-brand fontmarca" href="index.php">SNEAKER HOUSE</a>

      <div class="col-auto px-0">
        <p class="foottex mt-4 text-white">Venta de Zapatillas</p>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php MenuDinamico('index.php') ?> ">
            <a class="nav-link fontgral" href="index.php">HOME</a>
          </li>
          <li class="nav-item <?php MenuDinamico('producto.php') ?> ">
            <a class="nav-link fontgral" href="producto.php">PRODUCTO</a>
          </li>
          <li class="nav-item <?php MenuDinamico('contacto.php') ?> ">
            <a class="nav-link fontgral" href="contacto.php">CONTACTO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fontgral" href="carrito.php">
              <img src="imagenes/iconos/cart.png" width="25" height="25">
            </a>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    
    <div class="container px-0 bg-white">
     <h1 class="d-none">Zapatillas</h1>