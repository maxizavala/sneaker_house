<!DOCTYPE html>

<?php
    include('inc/header.php');
    include_once('inc/funciones.php');
    include('inc/connect.php');

    // Si no hay un producto seleccionado (id) redirecciona al home
    $id_producto = $_GET['id'];
    if ($id_producto == null) {
        header('Location: index.php');
    }

    // Si recibe un POST..
    if ($_POST['talle'] != null) {

        //Establece huso horario Argentina
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fec = date('o-m-d H:i:s');

        // Mensaje producto agregado al carrito
        MensajeEmergente("Se agrego el producto a tu carrito !!", "verde");        
    }

    $sql = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
    $result = mysqli_query($enlace, $sql);
    $a_producto = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $marca = $a_producto['marca'];
    $modelo = $a_producto['modelo'];
    $descripcion = $a_producto['descripcion'];
    $precio = number_format($a_producto['precio'], 2, ',', '.');
    $categoria = $a_producto['categoria'];

?>

<main class="container p-4 bg-white">

        <div class="row mb-3">
            <div class="col-sm-12 col-md-6">
                <h1 class="titindex "> <?php echo "$marca $modelo"; ?> </h1>
                <?php echo "<p class='pr-md-4'>$descripcion</p>"; ?>
                <?php echo "<p class='pr-md-4'> <h3> $$precio </h3> </p>"; ?>
            </div>

            <figure class="col-sm-12 col-md-6 der thumb">
                <?php // ---------------------- IMAGEN
                    echo "<img src='imagenes/productos/$id_producto/grande.jpg' alt='$marca $modelo' title='$marca $modelo' width='800' height='533' class='rounded-lg img-fluid shadow'>";
                ?>
            </figure>
        </div>

        <div class="row">

            <div class="col-sm-0 col-md-4"> </div>

            <div class="col-sm-12 col-md-4">
                <form action="" method="post">
                    <label> Seleccione un talle: </label><br>
                    <?php TalleSegunCategoria($categoria); ?>
                    <br><br> <input type="submit" value="Agregar al Carrito" class="btn btn-primary">
                </form>
            </div>

            <div class="col-sm-0 col-md-4"> </div> 
                           
        </div>

</main>


<?php include('inc/footer.php'); ?>

</html>