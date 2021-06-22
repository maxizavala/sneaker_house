<!DOCTYPE html>
<?php
    include('inc/header.php');
    include_once('inc/funciones.php');
    include('inc/connect.php');
?>

<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
            xmlhttp.open("GET", "inc/sugerencias_art.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<?php
    if ($_POST['modelo'] != null) {

        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        $descripcion = $_POST['descripcion'];
        $prod = $_GET['pr'];

        $sql = "UPDATE producto SET modelo = '$modelo', marca = '$marca', precio = $precio, categoria = $categoria, descripcion = '$descripcion' WHERE id_producto = $prod";

        $result = mysqli_query($enlace, $sql);
    }
?>

<main class="container p-4 bg-white">
    <header class="row container thumb">
        <div class="col-sm-12 px-0">
            <h1 class="titindex">Productos</h1>
        </div>
    </header>
    <p>
        <form action="">
            <input type="text" id="fname" name="fname" class="rounded-pill border-0 colorform py-1 px-2" placeholder="búsqueda de articulos_" onkeyup="showHint(this.value)">
        </form>
    </p>
    <p>
         <span id="txtHint"></span>
    </p>
    
    <?php
        if (!isset($_GET['pr'])) {
    ?>
    
        <div class='jumbotron jumbotron-fluid'>
            <div class='container empty-cart'>
                <p class='zapas'>Acá podés agregar, modificar y eliminar productos</p>
            </div>
        </div>

    <?php
        } else {
            $pr = $_GET['pr'];
            $sql =  "SELECT * FROM producto WHERE id_producto = $pr";
            $result = mysqli_query($enlace, $sql);
            $a_producto = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $modelo = $a_producto['modelo'];
            $marca = $a_producto['marca'];
            $categoria = $a_producto['categoria'];
            $descripcion = $a_producto['descripcion'];
            $precio = $a_producto['precio'];
    ?>
        <br>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <form action="" method="POST">
                        <table>
                            <tr>
                                <td> <b>Modelo:</b> </td> 
                                <td> <input type="text" name="modelo" value="<?php echo $modelo ?>" required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                            </tr>
                            <tr>
                                <td> <b>Marca:</b> </td> 
                                <td> <input type="text" name="marca" value="<?php echo $marca ?>" required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                            </tr>
                            <tr>
                                <td> <b>Precio:</b> </td> 
                                <td> <input type="text" name="precio" value="<?php echo $precio ?>" required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                            </tr>
                            <tr>
                                <td> <b>Categoría:</b> </td> 
                                <td> 
                                    <?php 
                                        $cats = mysqli_query($enlace, "SELECT * FROM categoria");
                                        echo "<select name='categoria' required class='rounded-pill border-0 colorform py-1 px-2'>";
                                            while($row = mysqli_fetch_array($cats)) {
                                                if ($row[0] == $categoria) {
                                                    echo "<option selected value='".$row[0]."'>".$row[1]."</option>";
                                                } else {
                                                echo "<option value='".$row[0]."'>".$row[1]."</option>"; } }
                                        echo "</select> </td>";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td> <b>Descripción:</b> </td> 
                                <td> <textarea name="descripcion" cols="30" rows="10" required class="rounded-lg border-0 colorform py-1 px-2"> <?php echo $descripcion ?> </textarea> </td>
                            </tr>
                            <tr>
                                <td colspan=2 style="text-align: center;"> 
                                    <input type="submit" name="submit" value="Guardar" class="btn btn-success">
                    </form> 
                                    <input type="submit" name="eliminar" value="Eliminar" disabled class="btn btn-danger"> 
                                    <a href="edit_producto.php" class="btn btn-primary">Cancelar</a>
                                </td>
                            </tr>
                        </table>
                    
                </div>
                <div class="col-sm-12 col-md-6">
                     
                    <?php echo "<img src='imagenes/productos/$pr/grande.jpg' width='800' height='533' class='rounded-lg img-fluid shadow'>"; ?>
                    
                </div>
            </div>

    <?php
        }
    ?>

    
</main>

<?php include('inc/footer.php'); ?>

</html>