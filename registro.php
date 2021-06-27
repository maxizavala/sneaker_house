<!DOCTYPE html>
<?php
    include('inc/header.php');
    include_once('inc/funciones.php');
    include('inc/connect.php');
?>

<main class="container p-4 bg-white">
    <header class="row container thumb">
        <div class="col-sm-12 px-0">
            <h1 class="titindex">Nuevo Usuario</h1>
        </div>
    </header>

    <?php
        if ($_POST['usuario'] != null) {
            $user = $_POST['usuario'];
            $pass = $_POST['password'];
            $mail = $_POST['email'];
            $tel = $_POST['telefono'];
            $nombre = $_POST['nombre'];
            $fec_nac = $_POST['fec_nacimiento'];

            $calle = $_POST['calle'];
            $altura = $_POST['altura'];
            if ($_POST['piso-dto'] != null) {
                $piso = $_POST['piso-dto'];
            } else {
                $piso = ''; }
            $direccion = "$calle $altura $piso";

            $ciudad = $_POST['localidad'];
            $cp = $_POST['cp'];
    

            $sql = "INSERT INTO `usuario` (`user`, `pass`, `email`, `telefono`, `nombre`, `fec_nacimiento`, `direccion`, `localidad`, `cp`)
                VALUES ('$user', '$pass', '$mail', '$tel', '$nombre', '$fec_nac', '$direccion', $ciudad, $cp)";
                
            $result = mysqli_query($enlace, $sql);
    ?>

    <div class='jumbotron jumbotron-fluid'>
        <div class='container empty-cart'>
            <p class='zapas'>Bienvenido <?php echo "$nombre"; ?>! ahora podes loguearte con tu usuario y contraseña</p>
        </div>
    </div>

    <?php } else { ?>

    <div class="container p-4 bg-white">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <h2 class="italica mb-3">Ingresá tus datos para registrarte</h2>

            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="usuario" placeholder="Elegí un usuario" required class="rounded-pill border-0 colorform py-1 px-2">
                    <input type="password" name="password" placeholder="Elegí una contraseña" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Tu email" required class="rounded-pill border-0 colorform py-1 px-2">
                    <input type="tel" name="telefono" placeholder="Tu telefono" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div>    
                    <input type="text" name="nombre" placeholder="Tu nombre" required class="rounded-pill border-0 colorform py-1 px-2">
                    <input type="date" name="fec_nacimiento" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <br>
                <p> Datos de entrega: </p>
                <div>
                <div class="form-group">
                    <input type="text" name="calle" placeholder="Calle" required class="rounded-pill border-0 colorform py-1 px-2">
                    <input type="text" name="altura" placeholder="Número" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                    <input type="text" name="piso-dto" placeholder="Piso y departamento" class="rounded-pill border-0 colorform py-1 px-2">
                    <input type="text" name="cp" placeholder="Código postal" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div>

                    <?php // menu localidad
                        $lcl = mysqli_query($enlace, "SELECT * FROM localidad");
                        echo "<select name='localidad' required class='rounded-pill border-0 colorform py-1 px-2'>";
                        echo "<option value=''> </option>";
                            while($row = mysqli_fetch_array($lcl)) {
                                echo "<option value='".$row[0]."'>".$row[1]."</option>"; }
                        echo "</select> </td>";
                    ?>
                    
                </div>
                <div>
                <div class="form-group mt-4">
                    <input type="submit" name="submit" value="Guardar" class="btn btn-primary">
                </div>
            </form>

    <?php } ?>

</main>

<?php include('inc/footer.php'); ?>

</html>