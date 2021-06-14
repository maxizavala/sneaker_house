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
if ($_POST != null) {

    $tipo = $_POST['tipo']; //Captura si es nuevo comentario o si es carrito.
    $id_prod = $_POST['id_prod'];

    //Establece huso horario Argentina
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fec = date('o-m-d H:i:s');

    if ($tipo == 'comentario') { // Nuevos comentarios

        // Mensaje comentario recibido
        MensajeEmergente("Gracias por dejarnos un mensaje!", "amarillo");

        $mail = $_POST['correo'];
        $msj = $_POST['mensaje'];
        $val = $_POST['valoracion'];


        // Guarda el nuevo comentario en el JSON
        $a_comentarios = LeerArrayJson('json', 'comentarios.json');
        $a_comentarios[] = [
            "correo" => "$mail",
            "mensaje" => "$msj",
            "id_producto" => "$id_prod",
            "valoracion" => "$val",
            "fecha" => "$fec"
        ];
        GuardarArrayEnJson('json', 'comentarios.json', $a_comentarios);
    } else if ($tipo == 'carrito') { //Agregar al carrito

        // Mensaje producto agregado al carrito
        MensajeEmergente("Se agrego el producto a tu carrito !!", "verde");

        $talle = $_POST['talle'];
        $usuario = "usuario@gmail.com";

        $a_carrito = LeerArrayJson('json', 'carrito.json');
        $a_carrito[] = [
            "id_carrito" => 1,
            "usuario" => "$usuario",
            "id_producto" => "$id_producto",
            "talle" => "$talle",
            "fecha" => "$fec"
        ];
        GuardarArrayEnJson('json', 'carrito.json', $a_carrito);
    }
}


?>


<article class="px-4">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-6">
            <?php //Muestra el detalle de cada producto.
            $sql = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
            $result = mysqli_query($enlace, $sql);
            $a_producto = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Elementos del array
            $marca = $a_producto['marca'];
            $modelo = $a_producto['modelo'];
            $categoria = MostrarCategoria('json', 'categorias.json', $a_producto['categoria']); //String de la categoria
            $descripcion = $a_producto['descripcion'];
            $precio = $a_producto['precio'];

            echo "<h1 class='titindex mt-5'>$marca $modelo</h1>";
            echo "<p class='pr-md-4'> <em><b> $categoria </b></em> </p>";
            echo "<p class='pr-md-4'>$descripcion</p>";
            echo "<p class='pr-md-4'> <h3> $$precio,00 </h3> </p>";
            ?>

            <!-- CARRITO DE COMPRAS -------------------------------- -->
            <form action="" method="post">

                <div class="form-group col-md-4">
                    <label>Seleccione un talle</label>
                    <?php TalleSegunCategoria($categoria); ?>
                    <br> <input type="submit" value="Agregar al Carrito" class="btn btn-primary">
                </div>
                <input type="hidden" name="id_prod" value="<?php echo $id_producto; ?>">
                <input type="hidden" name="tipo" value="carrito">
            </form>

        </div>

        <figure class="col-sm-12 col-md-6 der thumb mt-5">

            <?php // ---------------------- IMAGEN
            echo "<img src='imagenes/productos/$id_producto/grande.jpg' alt='$marca $modelo' title='$marca $modelo' width='800' height='533' class='rounded-lg img-fluid shadow'>";
            ?>

        </figure>
    </div>
</article>

<!-- COMENTARIOS -------------------------------- -->

<section class="px-4">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="italica mb-3">Dejanos un comentario</h2>

            <form action="" method="post">
                <div class="form-group">
                    <input type="email" name="correo" placeholder="Mail_" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                    <textarea name="mensaje" cols="30" rows="10" required placeholder="Comentario_" class="rounded-lg border-0 colorform py-1 px-2"></textarea>
                </div>
                <div class="form-group">
                    Valoración:<br>
                    <select name="valoracion" required class="rounded-pill border-0 colorform py-1 px-2">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>

                <input type="hidden" name="id_prod" value="<?php echo $id_producto; ?>">

                <input type="submit" value="" id="botonimagen" class="img-fluid mb-5">
                <input type="hidden" name="tipo" value="comentario">
            </form>

        </div>
        <div class="col-sm-6">
            <h2 class="italica">Últimos comentarios</h2>
            <hr>

            <?php
            //Muestra los comentarios del producto guardados en el Json
            MostrarComentarios('json', 'comentarios.json', $id_producto);
            ?>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>

</html>