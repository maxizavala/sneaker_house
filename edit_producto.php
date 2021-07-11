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
            xmlhttp.open("GET", "inc/sugerencias.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<?php
    if (isset($_POST)) {

        // Actualizar modelo existente
        if ($_POST['guardar'] != null) {

            $modelo = $_POST['modelo'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            $descripcion = $_POST['descripcion'];
            $prod = $_GET['pr'];
    
            $sql = "UPDATE producto SET modelo = '$modelo', marca = '$marca', precio = $precio, categoria = $categoria, descripcion = '$descripcion' WHERE id_producto = $prod";
    
            $result = mysqli_query($enlace, $sql);
        }

        // Nuevo modelo
        elseif ($_POST['n_modelo'] != null) {

            //Obtengo nuevo id de producto
            $new_id = mysqli_fetch_array(mysqli_query($enlace, "SELECT MAX(id_producto)+1 AS id FROM PRODUCTO;"), MYSQLI_ASSOC)['id'];
            
            $modelo = $_POST['n_modelo'];
            $marca = $_POST['n_marca'];
            $precio = $_POST['n_precio'];
            $categoria = $_POST['n_categoria'];
            $descripcion = $_POST['n_descripcion'];

            $sql = "INSERT INTO producto (id_producto, modelo, marca, precio, categoria, descripcion) VALUES ($new_id, '$modelo', '$marca', $precio, $categoria, '$descripcion');";   

            // Subir imagen
            $extensiones = array(0=>'image/jpg',1=>'image/jpeg'); // Extensiones aceptadas
            $max_size = 1024 * 1024 * 8; // Tamaño maximo
            $ruta_index = dirname(realpath(__FILE__)); // Index del proyecto
        //    $extension = pathinfo($_FILES['n_imagen']['name'])['extension']; // extension del archivo
            $ruta_destino = "$ruta_index/imagenes/productos/$new_id.jpg"; // ruta destino

            if ( in_array($_FILES['n_imagen']['type'], $extensiones) ) { // Si el archivo es jpg, jpeg, png...

                if ( $_FILES['n_imagen']['size']< $max_size ) { // Si el archivo es menor al tamaño maximo...

                    copy($_FILES['n_imagen']['tmp_name'], $ruta_destino); // Copia la imagen desde la carpeta temp

                    if( copy($_FILES['n_imagen']['tmp_name'], $ruta_destino) ) {
                        
                        // Nuevo articulo creado
                        $result = mysqli_query($enlace, $sql);
                        MensajeEmergente("Nuevo articulo creado", "verde");

                    }
                } else {
                    MensajeEmergente("El tamaño de la imagen es demasiado grande", "rojo");
                }
            } else {
                MensajeEmergente("Debe cargar una imagen JPG o JPEG", "rojo");
            }
        }

        // Eliminar modelo
        elseif ($_POST['delete'] != null) {
            $del_prod = $_POST['delete'];
            $sql = "DELETE FROM producto WHERE id_producto = $del_prod;";
            $result = mysqli_query($enlace, $sql);
            MensajeEmergente("Articulo Eliminado", "rojo");
        }

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
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#new_producto">
                Nuevo Articulo
            </button>
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
                                <td height = "50"> <b>Modelo:</b> </td> 
                                <td height = "50"> <input type="text" name="modelo" value="<?php echo $modelo ?>" required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                            </tr>
                            <tr>
                                <td height = "50"> <b>Marca:</b> </td> 
                                <td height = "50"> <input type="text" name="marca" value="<?php echo $marca ?>" required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                            </tr>
                            <tr>
                                <td height = "50"> <b>Precio:</b> </td> 
                                <td height = "50"> <input type="text" name="precio" value="<?php echo $precio ?>" required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                            </tr>
                            <tr>
                                <td height = "50"> <b>Categoría:</b> </td> 
                                <td height = "50"> 
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
                                <td height = "50"> <b>Descripción:</b> </td> 
                                <td height = "50"> <textarea name="descripcion" cols="30" rows="10" required class="rounded-lg border-0 colorform py-1 px-2"><?php echo "$descripcion" ?></textarea> </td>
                            </tr>
                            <tr>
                                <td height = "50" colspan=2 style="text-align: center;"> 
                                    <input type="submit" name="guardar" value="Guardar" class="btn btn-success btn-block"> 
                                </td>
                            </tr>
                    </form>
                    <form action="edit_producto.php" method="POST">
                            <tr>
                                <td height = "50" colspan=2 style="text-align: center;">
                                    <button type="submit" name="delete" class="btn btn-danger" value="<?php echo $_GET['pr']; ?>"> Eliminar </button>
                                    <a href="edit_producto.php" class="btn btn-primary">Cancelar</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6">
                     
                    <?php echo "<img src='imagenes/productos/$pr.jpg' width='800' height='600' class='rounded-lg img-fluid shadow'>"; ?>
                    
                </div>
            </div>

    <?php
        }
    ?>

    <!-- Modal Nuevo Producto -->
    <div class="modal fade" id="new_producto" tabindex="-1" role="dialog" aria-labelledby="new_producto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                   
                    <div class="row justify-content-center">
                        <div>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td> <b>Modelo:</b> </td> 
                                        <td> <input type="text" name="n_modelo"  required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                                    </tr>
                                    <tr>
                                        <td> <b>Marca:</b> </td> 
                                        <td> <input type="text" name="n_marca"  required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                                    </tr>
                                    <tr>
                                        <td> <b>Precio:</b> </td> 
                                        <td> <input type="text" name="n_precio"  required class="rounded-pill border-0 colorform py-1 px-2"> </td>
                                    </tr>
                                    <tr>
                                        <td> <b>Categoría:</b> </td> 
                                        <td> 
                                            <?php 
                                                $cats = mysqli_query($enlace, "SELECT * FROM categoria");
                                                echo "<select name='n_categoria' required class='rounded-pill border-0 colorform py-1 px-2'>";
                                                    while($row = mysqli_fetch_array($cats)) {
                                                        echo "<option value='".$row[0]."'>".$row[1]."</option>"; }
                                                echo "</select> </td>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <b>Descripción:</b> </td> 
                                        <td> <textarea name="n_descripcion" cols="30" rows="10"  required class="rounded-lg border-0 colorform py-1 px-2"></textarea> </td>
                                    </tr>
                                    <tr>
                                        <td> <b>Imagen:</b> </td> 
                                        <td> <input type="file" name="n_imagen" required> </td>
                                    </tr>
                                </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" value="Guardar" class="btn btn-success">
                </div>
                            </form> 
            </div>
        </div>
    </div>

    
</main>

<?php include('inc/footer.php'); ?>

</html>