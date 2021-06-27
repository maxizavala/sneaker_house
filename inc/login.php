
<form action="#" method="POST">
    <article class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="modal-body">
                                <p>Usuario: </p>
                                <p>Contraseña: </p>
                            </div>
                            <div class="modal-body">
                                <p> <input type="text" name="user" required minlength="4" maxlength="8" size="10" autocomplete="off"></p>
                                <p> <input type="password" name="pass" required minlength="4" maxlength="8" size="10"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="registro.php" class="btn btn-success">Registrate</a>
                            <input type="submit" value="Ingresar" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</form>
