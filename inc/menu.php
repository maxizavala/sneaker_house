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
                            <p> <a href="edit_producto.php" class="btn btn-primary btn-lg btn-block <?php if($_SESSION['tipo'] != 'admin') { echo "disabled"; } ?>">Editar Productos</a> </p>
                            <p> <a href="admin.php" class="btn btn-primary btn-lg btn-block <?php if($_SESSION['tipo'] != 'admin') { echo "disabled"; } ?>">Editar Sitio</a> </p>
                            <p> <a href="inc/logout.php" class="btn btn-danger btn-lg btn-block">Salir</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
