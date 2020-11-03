<!DOCTYPE html>
<?php include('inc/header.php'); ?>
<?php include_once('inc/funciones.php'); ?>
<?php 
    $id_producto = $_GET['id'];
    if ($id_producto == null) {
        header('Location: index.php');
    } 
?>

    
    <article class="px-4">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <?php //Muestra el detalle de cada producto.
                    $a_producto = MostrarProducto('json', 'productos.json', $id_producto);
                    $marca = $a_producto['marca'];
                    $modelo = $a_producto['modelo'];
                    $categoria = MostrarCategoria('json', 'categorias.json', $a_producto['id_categoria']);
                    $descripcion = $a_producto['descripcion'];
                    $precio = $a_producto['precio'];

                    echo "<h1 class='titindex mt-5'>$marca $modelo</h1>";
                    echo "<p class='pr-md-4'> <em><b> $categoria </b></em> </p>";
                    echo "<p class='pr-md-4'>$descripcion</p>";
                    echo "<p class='pr-md-4'> <h3> $$precio,00 </h3> </p>";
                ?>        
            </div>
            <figure class="col-sm-12 col-md-6 der thumb mt-5">
                <?php
                    echo "<img src='imagenes/productos/$id_producto/grande.jpg' alt='Nike Epic Phantom' width='800' height='533' class='rounded-lg img-fluid shadow'>";
                ?>
            </figure>
        </div>
    </article>
    
    <section class="px-4">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="italica mb-3">Dejanos un comentario</h2>
                <form action="#" method="post">
                <div class="form-group">
                    <input type="email" name="correo" placeholder="Mail_" class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                    <textarea name="mensaje" cols="30" rows="10" placeholder="Comentario_" class="rounded-lg border-0 colorform py-1 px-2"></textarea>
                </div>
                <div class="form-group">
                    Valoración:<br>
                    <select name="valoracion" class="rounded-pill border-0 colorform py-1 px-2">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <input type="submit" value="" id="botonimagen" class="img-fluid mb-5">
                </form>
            </div>
            <div class="col-sm-6">
                <h2 class="italica">Últimos comentarios</h2>

                <?php
                    //Muestra los comentarios del producto guardados en el Json
                    MostrarComentarios('json', 'comentarios.json', $id_producto);
                ?>
            </div>
        </div>    
    </section>

<?php include('inc/footer.php'); ?>

</html>