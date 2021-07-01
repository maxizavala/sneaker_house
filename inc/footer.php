<?php
    // links Redes Sociales
    $sql =  "SELECT facebook, instagram FROM sitio";
    $result = mysqli_query($enlace, $sql);
    $a_sitio = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $link_fb = $a_sitio['facebook'];
    $link_ig = $a_sitio['instagram'];
?>

</div>
<footer class="pb-4 pl-3 pl-md-0 py-md-0 ">
    <div class="container">
        <div class="row justify-content-center justify-content-sm-between">
            <div class="col-auto px-0 mx-3 d-none d-lg-block">
                <p class="foottex mt-4">Juarez Francisco - Seinhart Victoria - Zavala Maximiliano</p>
            </div>
            <div class="col-auto my-auto">
                <a href='http://<?php echo $link_fb; ?>' target="_blank"> <img src="imagenes/iconos/fb.png" width="25" height="25" alt="facebook"> </a>
                <a href='http://<?php echo $link_ig; ?>' target="_blank"> <img src="imagenes/iconos/ig.png" width="25" height="25" alt="instagram"> </a>
            </div>
        </div>
    </div>
</footer>
    
    <!-- JavaScript -->
    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>