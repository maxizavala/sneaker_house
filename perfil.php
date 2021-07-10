<!DOCTYPE html>
<?php
    include('inc/header.php');
    include_once('inc/funciones.php');
?>

<?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];

        // Nuevos datos
        if (isset($_POST['password']) != null) {
            
            $n_pass = $_POST['password'];
            $n_email = $_POST['email'];
            $n_telefono = $_POST['telefono'];
            $n_nombre = $_POST['nombre'];
            $n_direccion= $_POST['direccion'];
            $n_localidad = $_POST['localidad'];;
            $n_cp = $_POST['cp'];

            $sql = "UPDATE usuario SET pass = '$n_pass', email = '$n_email', telefono = '$n_telefono', nombre = '$n_nombre', direccion = '$n_direccion', localidad = $n_localidad, cp = $n_cp WHERE user = '$user'";
            $result = mysqli_query($enlace, $sql);
        }

        // Datos de la BD
        $sql =  "SELECT * FROM usuario WHERE user = '$user'";
        $result = mysqli_query($enlace, $sql);
        $a_usuario = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $usuario = $a_usuario['user'];
        $pass = $a_usuario['pass'];
        $email = $a_usuario['email'];
        $telefono = $a_usuario['telefono'];
        $nombre = $a_usuario['nombre'];
        $fec_nac = $a_usuario['fec_nacimiento'];
        $direccion = $a_usuario['direccion'];
        $localidad = $a_usuario['localidad'];
        $cp = $a_usuario['cp'];
    }
    
    
?>


<main class="container p-4 bg-white">
    <header class="row container thumb">
        <div class="col-sm-12 px-0">
            <h1 class="titindex">Perfil</h1>
        </div>
    </header>

    <div class="row justify-content-center">
        <div>
            <h2 class="italica mb-3">Acá podés editar tus datos de usuario.</h2>

                        <table>
                            <form action="" method="post">
                                <tr>
                                    <td height = "50"> <b>Nombre de usuario:</b> </td>
                                    <td height = "50"> <input type="text" name="user" value="<?php echo "$usuario"; ?>" required class="rounded-pill border-0 colorform py-1 px-2" disabled> </td>
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Modificar email:</b> </td> 
                                    <td height = "50"> <input type="text" name="email" value="<?php echo $email; ?>" required class="rounded-pill border-0 colorform py-1 px-2" autocomplete="off"> </td> 
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Modificar teléfono:</b> </td> 
                                    <td height = "50"> <input type="text" name="telefono" value="<?php echo $telefono; ?>" required class="rounded-pill border-0 colorform py-1 px-2" autocomplete="off"> </td> 
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Modificar nombre:</b> </td> 
                                    <td height = "50"> <input type="text" name="nombre" value="<?php echo $nombre; ?>" required class="rounded-pill border-0 colorform py-1 px-2" autocomplete="off"> </td> 
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Fecha de Nacimiento:</b> </td> 
                                    <td height = "50"> <input type="text" name="fec_nac" value="<?php echo $fec_nac; ?>" required class="rounded-pill border-0 colorform py-1 px-2" disabled> </td> 
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Modificar dirección:</b> </td> 
                                    <td height = "50"> <input type="text" name="direccion" value="<?php echo $direccion; ?>" required class="rounded-pill border-0 colorform py-1 px-2" autocomplete="off"> </td> 
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Modificar localidad:</b> </td> 
                                    <td height = "50"> 
                                    <?php 
                                        $loc = mysqli_query($enlace, "SELECT * FROM localidad");
                                        echo "<select name='localidad' required class='rounded-pill border-0 colorform py-1 px-2'>";
                                            while($row = mysqli_fetch_array($loc)) {
                                                if ($row[0] == $localidad) {
                                                    echo "<option selected value='".$row[0]."'>".$row[1]."</option>";
                                                } else {
                                                echo "<option value='".$row[0]."'>".$row[1]."</option>"; } }
                                        echo "</select> </td>";
                                    ?>
                                </td>
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Modificar código postal:</b> </td> 
                                    <td height = "50"> <input type="text" name="cp" value="<?php echo $cp; ?>" required class="rounded-pill border-0 colorform py-1 px-2" autocomplete="off"> </td> 
                                </tr>
                                <tr>
                                    <td height = "50"> <b>Tu contraseña:</b> </td> 
                                    <td height = "50"> <input type="password" name="password" required class="rounded-pill border-0 colorform py-1 px-2" autocomplete="off"> </td> 
                                </tr>
                                <tr>
                                    <td colspan=2 style="text-align: center;"> <input type="submit" name="submit" value="Guardar" class="btn btn-primary"> </td>
                                </tr>
                            </form>
                        </table>
        </div>
    </div>
</main>

<?php include('inc/footer.php'); ?>

</html>
