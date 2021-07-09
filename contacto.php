<!DOCTYPE html>
<?php 
  include('inc/header.php'); 
  include_once('inc/funciones.php'); 
  include('inc/connect.php');
  include('inc/enviodemail.php');
?>

<?php

    // Datos de la BD
    $sql =  "SELECT * FROM sitio";
    $result = mysqli_query($enlace, $sql);
    $a_sitio = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $telefono = $a_sitio['telefono'];
    $direccion = $a_sitio['direccion'];
    $horario = $a_sitio['horario'];

    // Nuevos mensajes
    if (isset($_POST['mensaje'])) {

        $name = $_POST['nombre'];
        $mail = $_POST['correo'];
        $tlf = $_POST['telefono'];
        $dept = $_POST['departamento'];
        $msj = $_POST['mensaje'];
    }
?>

  <div class="container p-4 bg-white">
    <div class="row">
     
      <section class="col-md-7 thumb">      
       <h1 class="titcont"> <?php echo $telefono; ?> </h1>       
       <p class="italica">Nos encontramos en la zona de Palermo Soho.</p>
          <figure class="thumbmapa">
                <img src="imagenes/mapa.jpg" alt="Mapa" width="700" height="500" class="rounded img-fluid">
            </figure>            
                <p class="dire"> <?php echo "Nos encontramos en: $direccion"; ?> </p>                       
                <p class="hora"> <?php echo "Nuestro horario: $horario"; ?> </p>       
            </section>
            
        <aside class="col-md-5">
            <h2 class="titulos">Contactanos</h2>
            <p>Dejanos tu consulta, que en breve te responderemos!</p>


            <form action="#" method="POST" class="mt-md-5">
               <div class="form-group">
                <input type="text" name="nombre" placeholder="Nombre_Apellido_" required class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                  <input type="email" name="correo" placeholder="Mail_" required class="rounded-pill border-0 colorform py-1 px-2">
                  </div>
                <div class="form-group">
                <input type="tel" name="telefono" placeholder="Teléfono_" class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                  <select name="departamento" required class="rounded-pill border-0 colorform py-1 px-2">
                    <option value="Ventas">Ventas</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Quejas">Quejas</option>
                  </select>
                </div>  
                <div class="form-group">
                <textarea name="mensaje" cols="30" rows="10" required placeholder="Comentario_" class="rounded-lg border-0 colorform py-1 px-2"></textarea>
                </div>
                <button type="submit" value="" id="botonimagen" class="img-fluid"></button>
            
            
            </form>
        </aside>
        
        </div>
      </div>
    
  <?php include('inc/footer.php'); ?>
    
</html>