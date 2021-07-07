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

    // id del usuario
    if (isset($_SESSION)) {
        $user = $_SESSION['id'];
    }

    // LIKES: Consulto en la BD si el producto tiene like
    if (isset($_SESSION['user'])) {
        $usuario = $_SESSION['user'];
        $sql = "SELECT likes.producto AS producto FROM likes INNER JOIN usuario ON usuario.id_usuario = likes.usuario WHERE usuario.user = '$usuario' AND producto = $id_producto";
        $result = mysqli_query($enlace, $sql); 
        $a_likes = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $like = $a_likes['producto'];
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
                    <br><br> 
                    <input type="submit" value="Agregar al Carrito" class="btn btn-primary">

                    <?php $like ? $heart = 'like' : $heart = 'dike'; ?>

                    <button type="button" class="btn btn-link" onclick="functionLike('<?php echo $id_producto; ?>')">
                        <img src="imagenes/iconos/<?php echo $heart ?>.png" width="35" height="35" id="<?php echo $id_producto; ?>">
                    </button>

                </form>
            </div>

            <div class="col-sm-0 col-md-4"> </div> 
                           
        </div>

</main>


<?php include('inc/footer.php'); ?>

<script>
    function functionLike(id) {

        var req = new XMLHttpRequest(); // Objeto que permite enviar/recibir datos
        req.open('POST', 'inc/likes.php', true); // Peticion de datos por metodo GET
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Codifica los datos enviados desde el server
        req.onreadystatechange = function () { // Metodo que 'escucha' la respuesta del servidor
        }

        var img = document.getElementById(id).src; // Toma el nombre del archivo (like/dike)

        if (img.slice(-8) == "like.png") {
            document.getElementById(id).src='imagenes/iconos/dike.png';

            var  data = 'id='+id+'&value=dike&user='+'<?php echo $user; ?>';
            req.send(data); // Envio datos
        }
        else {
            document.getElementById(id).src='imagenes/iconos/like.png';

            var  data = 'id='+id+'&value=like&user='+'<?php echo $user; ?>';
            req.send(data); // Envio datos
        }
    }
</script>

</html>