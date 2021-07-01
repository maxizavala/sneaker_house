<!DOCTYPE html>
<!-- FINAL -->
<?php 
    include('inc/header.php');
    include_once('inc/funciones.php');
    include_once('inc/carrousel.php'); 
    include('inc/connect.php');
?>


<main class="container p-4 bg-white">
    <header class="row container thumb">
        <div class="col-sm-12 px-0">
            <h1 class="titstore d-inline-block">Bienvenidos a nuestra tienda</h1>
        </div>
        <p class="italica">En nuestra tienda contás con 6 cuotas sin interés y envíos a todo el país!</p>
    </header>

    <section class="row">
        <div class="col-3 bg-dark">
            <!-- MENU LATERAL -------------------------------------------------------------------- -->
            <div class="row p-3 text-white">
            <h2 class="col-12 text-center thumb">Categorías:</h2>

            <form action="#" method="GET">
                <?php
                    $a_categorias = mysqli_query($enlace, "SELECT * FROM categoria");


                    // Si se envío algo por el método GET a la key 'id_categoria', su valor se guarda en $id_cat
                    if (isset($_GET['id_categoria'])) {
                        $id_cat = $_GET['id_categoria'];
                    } else {
                        $id_cat = "";
                    }

                    foreach ($a_categorias as $a_categoria) {
                        $cat_nombre = $a_categoria['nombre'];
                        $cat_id = $a_categoria['id_categoria'];

                        // Si algun botón se presionó anteriormente, quedará en color azul, excepto el botón de 'Limpiar búsqueda'
                        if ($cat_id == $id_cat) {

                ?> <!-- boton seleccionado -->
                    <div class="my-3"><a class="btn btn-primary" href="index.php?id_categoria=<?php echo $cat_id ?>" role="button"><?php echo $cat_nombre ?></a></div>
                <?php
                        } else {
                ?> <!-- boton sin seleccionar -->
                    <div class="my-3"><a class="btn btn-info" href="index.php?id_categoria=<?php echo $cat_id ?>" role="button"><?php echo $cat_nombre ?></a></div>
                <?php
                        }
                    }
                ?>
                <div class="my-3"><a class="btn btn-info" href="index.php" role="button">Limpiar búsqueda</a></div>
            </form>

            </div>
        </div>

        <div class="col-9">

            <div class="row">

            <?php 
                // PRODUCTOS: Consulto los productos en BD
                $a_productos = mysqli_query($enlace, "SELECT * FROM producto");

                // LIKES: Consulto en la BD los likes del usuario y los guardo en un array unidimensional
                $a_likes = [];
                if (isset($_SESSION['user'])) {
                    $usuario = $_SESSION['user'];
                    $sql = "SELECT likes.producto FROM likes INNER JOIN usuario ON usuario.id_usuario = likes.usuario WHERE usuario.user = 'zeta'";
                    $result = mysqli_query($enlace, $sql);
                
                    foreach ($result as $key => $value) {
                        foreach ($value as $like) {
                            $a_likes[] = $like;
                        }
                    }     
                }

                
                
                // MUESTRO PRODUCTOS CON FILTRO ---------------------------------------------------------------------------------------------------
                //Si algún botón de filtrado fue presionado, envía el id de la categoria por GET, y solo se muestran los productos de esa categoría.
                if (isset($_GET['id_categoria'])) {
                    $id_cat = $_GET['id_categoria'];

                    foreach ($a_productos as $a_producto) {
                        if ($a_producto['categoria'] == $id_cat) { // COINCIDENCIA DE CATEGORIAS
                            $pr_id = $a_producto['id_producto'];
                            $pr_ima = "imagenes/productos/" . $pr_id . "/chica.jpg";
                            $pr_nom = $a_producto['marca'] . ' ' . $a_producto['modelo'];
                            $pr_pre = $a_producto['precio'];
                            $pr_des = $a_producto['descripcion'];
            ?>

                <div class="col-sm-6 thumb">
                    <div class="card">
                        <a href="producto.php?id=<?php echo $pr_id ?>" class="mx-auto"><img src="<?php echo $pr_ima ?>" alt="<?php echo $pr_nom ?>" width="350" height="250" class="rounded img-fluid shadow"></a>
                        <div class="card-body p-2 anchocard mx-auto img-fluid">
                            <h3 class="card-title producto">
                                <button type="button" class="btn btn-link">
                                    <?php in_array("$pr_id", $a_likes) ? $heart = 'like' : $heart = 'dike'; ?>
                                    <img src="imagenes/iconos/<?php echo $heart ?>.png" width="25" height="25">
                                </button>
                                <?php echo $pr_nom ?>
                            </h3>
                            <p class="card-text precio">$<?php echo $pr_pre ?></p>
                            <p class="card-text"> <?php echo substr($pr_des, 0, 30)."..."; ?> </p>
                        </div>
                    </div>
                </div>

                <?php   }
                    }
                } else { // MUESTRO PRODUCTOS SIN FILTRO -------------------------------------------------------------------

            /* Si no se envío nada por el método GET, se muestran todos los productos, independientemente de la categoría. */
                    foreach ($a_productos as $a_producto) {
                        $pr_id = $a_producto['id_producto'];
                        $pr_ima = "imagenes/productos/" . $pr_id . "/chica.jpg";
                        $pr_nom = $a_producto['marca'] . ' ' . $a_producto['modelo'];
                        $pr_pre = $a_producto['precio'];
                        $pr_des = $a_producto['descripcion'];
                ?>

                <div class="col-sm-6 thumb">
                    <div class="card">
                        <a href="producto.php?id=<?php echo $pr_id ?>" class="mx-auto"><img src="<?php echo $pr_ima; ?>" alt="<?php echo $pr_nom ?>" width="350" height="250" class="rounded img-fluid shadow"></a>
                        <div class="card-body p-2 anchocard mx-auto img-fluid">
                            <h3 class="card-title producto"> 
                                <?php in_array("$pr_id", $a_likes) ? $heart = 'like' : $heart = 'dike'; ?>
                                <button type="button" class="btn btn-link" onclick="functionLike('<?php echo $pr_id; ?>')">
                                    <img src="imagenes/iconos/<?php echo $heart ?>.png" width="25" height="25" id="<?php echo $pr_id ?>">
                                </button>
                                <?php echo $pr_nom ?> 
                            </h3>
                            <p class="card-text precio">$<?php echo $pr_pre ?></p>
                            <p class="card-text"> <?php echo substr($pr_des, 0, 30)."..."; ?> </p>
                        </div>
                    </div>
                </div>

            <?php }
            } ?>

            </div>
        </div>
    </section>
</main>

<script>
    function functionLike(id) {
        var img = document.getElementById(id).src;
        if (img.slice(-8) == "like.png") {
            document.getElementById(id).src='imagenes/iconos/dike.png';
        }
        else {
            document.getElementById(id).src='imagenes/iconos/like.png';
        }
    }
</script>

<?php include('inc/footer.php'); ?>

</html>