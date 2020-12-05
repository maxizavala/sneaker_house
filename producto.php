<!DOCTYPE html>
<?php 
    include('inc/header.php');
    include_once('inc/funciones.php'); 

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
            echo    "<div class='alert alert-warning' role='alert'>
                    Gracias por dejarnos un mensaje!
                    </div>";
            
            $mail = $_POST['correo'];
            $msj = $_POST['mensaje'];
            $val = $_POST['valoracion'];
            
        
            // Guarda el nuevo comentario en el JSON
            $a_comentarios = LeerArrayJson('json', 'comentarios.json');
            $a_comentarios[]= [ "correo" => "$mail",
                                "mensaje" => "$msj",
                                "id_producto" => "$id_prod",
                                "valoracion" => "$val",
                                "fecha" => "$fec"];
            GuardarArrayEnJson('json','comentarios.json',$a_comentarios);
        }
        else if ($tipo == 'carrito') { //Agregar al carrito
            
            // Mensaje producto agregado al carrito
            echo    "<div class='alert alert-success' role='alert'>
                    Se agrego el producto a tu carrito !!
                    </div>";

            $talle = $_POST['talle'];
            $usuario = "usuario@gmail.com";
    
            $a_carrito = LeerArrayJson('json', 'carrito.json');
            $a_carrito[] = [    "id_carrito" => 1,
                                "usuario" => "$usuario",
                                "id_producto" => "$id_producto",
                                "talle" => "$talle",
                                "fecha" => "$fec"];
            GuardarArrayEnJson('json','carrito.json',$a_carrito);                    
        }
    }

    
?>

    
    <article class="px-4">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <?php //Muestra el detalle de cada producto.
                    $a_producto = MostrarProducto('json', 'productos.json', $id_producto); //Array del producto
                    
                    // Elementos del array
                    $marca = $a_producto['marca'];
                    $modelo = $a_producto['modelo'];
                    $categoria = MostrarCategoria('json', 'categorias.json', $a_producto['id_categoria']); //String de la categoria
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
                         <select name="talle" class="form-control">
                            <option>35</option>
                            <option>36</option>
                            <option>37</option>
                            <option>38</option>
                            <option>39</option>
                            <option>40</option>
                            <option>41</option>
                            <option>42</option>
                            <option>43</option>
                            <option>44</option>
                            <option>45</option>
                        </select>
                        <br> <input type="submit" value="Agregar al Carrito" class="btn btn-primary">
                    </div>
                    <input type="hidden" name="id_prod" value="<?php echo $id_producto; ?>">
                    <input type="hidden" name="tipo" value="carrito">
                </form>
            </div>
            
            <figure class="col-sm-12 col-md-6 der thumb mt-5">

                <?php // ---------------------- IMAGEN
                    echo "<img src='imagenes/productos/$id_producto/grande.jpg' alt='Nike Epic Phantom' width='800' height='533' class='rounded-lg img-fluid shadow'>";
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

                <?php
                    //Muestra los comentarios del producto guardados en el Json
                    MostrarComentarios('json', 'comentarios.json', $id_producto);
                ?>
            </div>
        </div>    
    </section>

<?php include('inc/footer.php'); ?>

</html>