<!DOCTYPE html>
    <?php 
        include('inc/header.php');
        include_once('inc/funciones.php');
    ?>

    <main class="container p-4 bg-white">
        <header class="row container thumb">
            <div class="col-sm-12 px-0">
                <h1 class="titindex">Carrito de Compras</h1>
            </div>
        </header>

        <?php
            $a_carrito = LeerArrayJson('json', 'carrito.json'); //Extraigo array de productos del carrito

            foreach ($a_carrito as $a_producto) { //Recorro el array y extraigo cada producto
                $pr_id = $a_producto['id_producto'];
                $pr_talle = $a_producto['talle'];

                //Muestra el detalle de cada producto
                $a_productos = LeerArrayJson('json', 'productos.json'); //Extraigo el array de productos gral
                foreach ($a_productos as $a_producto) { //Recorro cada producto
                    if ($a_producto['id_producto'] == $pr_id) { //Si coinciden los id..
                        $pr_ima = "imagenes/productos/" . $pr_id . "/chica.jpg";
                        $pr_nom = $a_producto['marca'] . ' ' . $a_producto['modelo'];
                        $pr_pre = $a_producto['precio'];
                    }
                }
        ?>

        <div class="row">
            <div class="col-sm-3 thumb">
            </div>
            <div class="col-sm-3 thumb">
                <div class="card">
                    <img src="<?php echo $pr_ima ?>" alt="<?php echo $pr_nom ?>" width="250" height="250" class="rounded img-fluid shadow">
                </div>
            </div>
            <div class="col-sm-3 thumb">
                <div class="card">
                    <h3 class="card-title producto"><?php echo $pr_nom ?></h3>
                    <p class="card-text precio">$<?php echo $pr_pre ?></p>
                    <p class="card-text precio"><?php echo "talle: $pr_talle" ?></p>
                </div>
            </div>
            <div class="col-sm-3 thumb">
            </div>
        </div>
        <?php 
            } 
        ?>

        <div class="row">
            <div class="col-sm-3 thumb">
            </div>
            <div class="col-sm-3 thumb">
                <input type="submit" value="Confirmar Compra" class="btn btn-primary">
            </div>
            <div class="col-sm-3 thumb">
                <input type="submit" value="Cancelar Compra" class="btn btn-danger">
            </div>
            <div class="col-sm-3 thumb">
            </div> 
        </div>
    </main>

    <?php include('inc/footer.php'); ?>

</html>