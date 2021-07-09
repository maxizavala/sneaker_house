<!DOCTYPE html>
<?php
    include('inc/header.php');
    include_once('inc/funciones.php');
    include('inc/connect.php');
?>

<main class="container p-4 bg-white">
    <header class="row container thumb">
        <div class="col-sm-12 px-0">
            <h1 class="titindex">Carrito de Compras</h1>
        </div>
    </header>

    <?php
    
        if (isset($_SESSION['id'])) {
            $userid = $_SESSION['id'];
        } else {
            $userid = null;
        }


        //Extraigo array de productos del carrito
        $sql = "SELECT * FROM carrito WHERE carrito.usuario = $userid";
        $a_productos = mysqli_query($enlace, $sql);


        if (isset($_POST["submit"])) {
            // Se vacía el carrito de compras del usuario
            unset($a_productos);
            $a_productos = array();
    
            $sqldelete = "DELETE FROM carrito WHERE carrito.usuario = $userid";
            $result = mysqli_query($enlace, $sqldelete);
    
            if ($_POST["submit"] == "Confirmar Compra") { // Compra confirmada
                MensajeEmergente("Compra confirmada! Gracias por elegirnos.", "verde");
                $mensaje = "Gracias por tu compra, te enviaremos un email con la fecha estimada en la que recibiras tus productos.";
            } else { // Compra cancelada
                MensajeEmergente("Compra cancelada", "rojo");
                $mensaje = "Cancelaste tu compra, el carrito esta vacio.";
            }
        } else {

            $mensaje = null;

            if (!isset($_SESSION['user'])) { // Usuario sin loguear
                $mensaje = "Debes loguearte para poder usar el carrito de compras <3";
            } else {
                if (mysqli_num_rows($a_productos)==0) { // Usuario logueado con carrito vacio.
                    $mensaje = "El carrito de compras aún está vacío.";
                }
            }
        }
        

        // Si el array del carrito está vacío, muestra un mensaje informando que el carrito está vacío.
        if ($mensaje != null) {
            echo    "<div class='jumbotron jumbotron-fluid'>
                        <div class='container empty-cart'>
                            <p class='zapas'>$mensaje</p>
                        </div>
                    </div>";
        } else {
                $total = 0;
            
                foreach ($a_productos as $a_producto) { // Recorro el array de carrito
                
                    $pr_id = $a_producto['producto'];
                    $pr_talle = $a_producto['talle'];
        
                    $sqlprod = "SELECT * FROM producto WHERE id_producto = $pr_id";
                    $resultprod = mysqli_query($enlace, $sqlprod);
                    $a_prod = mysqli_fetch_array($resultprod, MYSQLI_ASSOC); // Obtengo el array del producto del carrito
        
        
                    $pr_ima = "imagenes/productos/" . $pr_id . "/chica.jpg";
                    $pr_nom = $a_prod['marca'] . ' ' . $a_prod['modelo'];
                    $pr_pre = $a_prod['precio'];
        
                    $total = $total + $pr_pre;
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
                            <p class="card-text precio">$<?php echo number_format($pr_pre, 2, ',', '.'); ?></p>
                            <p class="card-text precio"><?php echo "Talle: $pr_talle" ?></p>
                        </div>
                    </div>
                    <div class="col-sm-3 thumb">
                    </div>
                </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-center titindex verde">Total: $<?php echo number_format($total, 2, ',', '.'); ?></h4>
                </div>
            </div>
    </main>
    <div class="container p-4 bg-white">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <h2 class="italica mb-3">Ingresá tus datos para confirmar la compra</h2>
    
                <form action="" method="post">
                    <p>Dirección de envío:</p>
                    <div class="form-group">
                        <input type="text" name="calle" placeholder="Calle_" required class="rounded-pill border-0 colorform py-1 px-2">
                        <input type="text" name="altura" placeholder="Número_" required class="rounded-pill border-0 colorform py-1 px-2">
                    </div>
                    <div class="form-group">
                        <input type="text" name="piso-dto" placeholder="Piso y Departamento_" class="rounded-pill border-0 colorform py-1 px-2">
                        <input type="text" name="cp" placeholder="Código postal_" required class="rounded-pill border-0 colorform py-1 px-2">
                    </div>
                    <div>
                        <input type="text" name="localidad" placeholder="Localidad_" required class="rounded-pill border-0 colorform py-1 px-2">
                    </div>
                    <div>
                        <p>Datos de pago:</p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="numtarj" placeholder="Número de tarjeta_" required class="rounded-pill border-0 colorform py-1 px-2">
                    </div>
                    <div class="form-group">
                        <input type="number" min="1" max="12" name="mes" placeholder="Mes de vencimiento_" required class="rounded-pill border-0 colorform py-1 px-2">
                        <input type="number" min="2020" max="2030" name="anio" placeholder="Año de vencimiento_" required class="rounded-pill border-0 colorform py-1 px-2">
                    </div>
                    <div class="form-group">
                        <input type="password" name="codseg" placeholder="Código de seguridad_" required class="rounded-pill border-0 colorform py-1 px-2" required>
                    </div>
                    <div class="form-group">
                        <div>
                            <p>Cuotas:</p>
                        </div>
                        <select name="cuotas" required class="rounded-pill border-0 colorform py-1 px-3 fechatarjeta">
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <input type="submit" name="submit" value="Confirmar Compra" class="btn btn-primary">
                    </div>
                </form>
    
                <form action="" method="post">
                    <div class="thumb">
                        <input type="submit" name="submit" value="Cancelar Compra" class="btn btn-danger">
                    </div>
                </form>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
    
    <?php 
        }
    ?>
    
    <?php include('inc/footer.php'); ?>
    
    </html>