<article class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Menu </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="modal-body">
                            <p> <a href="perfil.php" class="btn btn-primary btn-lg btn-block">Perfil</a> </p>
                            <p> 
                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#favoritos">
                                    Favoritos
                                </button>
                            </p>
                            <p> <a href="edit_producto.php" class="btn btn-info btn-lg btn-block" <?php if($_SESSION['tipo'] != 'admin') { echo "hidden"; } ?>>Editar Productos</a> </p>
                            <p> <a href="admin.php" class="btn btn-info btn-lg btn-block" <?php if($_SESSION['tipo'] != 'admin') { echo "hidden"; } ?>>Editar Sitio</a> </p>
                            <p> <a href="inc/logout.php" class="btn btn-danger btn-lg btn-block">Salir</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- VENTANA MODAL FAVORITOS -->
<div class="modal fade" id="favoritos" tabindex="-1" role="dialog" aria-labelledby="favoritos" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Favoritos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                    include('inc/connect.php');

                    $usuario = $_SESSION['user'];
                    $sql = "SELECT likes.producto FROM likes INNER JOIN usuario ON usuario.id_usuario = likes.usuario WHERE usuario.user = '$usuario'";
                    $a_favoritos = mysqli_query($enlace, $sql);

                    if (mysqli_num_rows($a_favoritos)==0) {
                        echo    "<div class='jumbotron jumbotron-fluid'>
                                    <div class='container empty-cart'>
                                        <p class='zapas'>No tenés productos agregados a favoritos</p>
                                    </div>
                                </div>";
                    } else {

                    foreach ($a_favoritos as $fav) { // Recorro el array de carrito
                                
                        $pr_id = $fav['producto'];

                        $sqlprod = "SELECT * FROM producto WHERE id_producto = $pr_id";
                        $resultprod = mysqli_query($enlace, $sqlprod);
                        $a_prod = mysqli_fetch_array($resultprod, MYSQLI_ASSOC); // Obtengo el array del producto del carrito


                        $pr_ima = "imagenes/productos/" . $pr_id . ".jpg";
                        $pr_nom = $a_prod['marca'] . ' ' . $a_prod['modelo'];
                ?>

                <div class="row justify-content-center">
                    <div class="card">
                        <h3 class="card-title producto"><?php echo $pr_nom ?></h3>
                        <a href="producto.php?id=<?php echo $pr_id; ?>">
                            <img src="<?php echo $pr_ima; ?>" width="250" height="250" class="rounded img-fluid shadow">
                        </a>
                    </div>
                </div>
                <br>

                <?php
                    } }
                ?>

            </div>
        </div>
    </div>
</div>

                

