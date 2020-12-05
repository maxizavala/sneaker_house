<!DOCTYPE html>
<!-- FINAL -->
<?php include('inc/header.php'); ?>
<?php include_once('inc/funciones.php'); ?>
<?php include_once('inc/carrousel.php'); ?>


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
        <h2 class="col-12 text-center ">Categorías:</h2>

        <form action="#" method="GET">
          <?php
          $a_categorias =  LeerArrayJson('json', 'categorias.json'); // Obtengo el array

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
            if ($cat_id == $id_cat and $id_cat != 1000) {

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
        </form>

      </div>
    </div>

    <div class="col-9">

      <div class="row">

        <?php // ------------------------------------------------------------------------ MUESTRO PRODUCTOS CON FILTRO
        $a_productos = LeerArrayJson('json', 'productos.json');
        
        //Si algún botón de filtrado fue presionado, envía el id de la categoria por GET, y solo se muestran los productos de esa categoría.
        // Solo si se envío algo a través del método GET, y que no sea el id 1000, que es de la categoría auxiliar 'Limpiar búsqueda'
        if (isset($_GET['id_categoria']) and $id_cat != 1000) {
          $id_cat = $_GET['id_categoria'];

          foreach ($a_productos as $a_producto) {
            if ($a_producto['id_categoria'] == $id_cat) { // COINCIDENCIA DE CATEGORIAS
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
                    <h3 class="card-title producto"><?php echo $pr_nom ?></h3>
                    <p class="card-text precio">$<?php echo $pr_pre ?></p>
                    <p class="card-text"><?php echo substr($pr_des, 0, 20) ?> ...(+)</p>
                  </div>
                </div>
              </div>

            <?php }
          }
        } else { // ----------------------------------------------------------- MUESTRO PRODUCTOS SIN FILTRO

          /* Si no se envío nada por el método GET, o si se envío el id_categoria=1000 que es de 'Limpiar Búsqueda',
           se muestran todos los productos, independientemente de la categoría. */
          foreach ($a_productos as $a_producto) {
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
                  <h3 class="card-title producto"><?php echo $pr_nom ?></h3>
                  <p class="card-text precio">$<?php echo $pr_pre ?></p>
                  <p class="card-text"><?php echo substr($pr_des, 0, 20) ?> ...(+)</p>
                </div>
              </div>
            </div>

        <?php }
        } ?>

      </div>
    </div>
  </section>

</main>


<?php include('inc/footer.php'); ?>

</html>