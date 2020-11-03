<!DOCTYPE html>
<?php include('inc/header.php'); ?>
    
    <div class="container p-4 bg-white">
     <div class="row">
     
      <section class="col-md-7 thumb">      
       <h1 class="titcont">0810-666-3400</h1>       
       <p class="italica">Nos encontramos en la zona de Palermo Soho.</p>
          <figure class="thumbmapa">
                <img src="imagenes/mapa.jpg" alt="Mapa" width="700" height="500" class="rounded img-fluid">
            </figure>            
                <p class="dire">Honduras 4916 - Palermo - Capital Federal - Buenos Aires</p>                       
                <p class="hora">Abrimos de Lunes a Sábados - de 10 a 21hs</p>       
            </section>
            
        <aside class="col-md-5">
            <h2 class="titulos">Contactanos</h2>
            <p>Dejanos tu consulta, que en breve te responderemos!</p>
            
            <form action="#" method="POST" class="mt-md-5">
               <div class="form-group">
                <input type="text" name="nombre" placeholder="Nombre_Apellido_" class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                  <input type="email" name="correo" placeholder="Mail_" class="rounded-pill border-0 colorform py-1 px-2">
                  </div>
                <div class="form-group">
                <input type="tel" name="telefono" placeholder="Teléfono_" class="rounded-pill border-0 colorform py-1 px-2">
                </div>
                <div class="form-group">
                  <select name="menu" class="rounded-pill border-0 colorform py-1 px-2">
                    <option value="none">...</option>
                    <option value="ventas">Ventas</option>
                    <option value="rrhh">Recursos Humanos</option>
                    <option value="quejas">Quejas</option>
                  </select>
                </div>  
                <div class="form-group">
                <textarea name="mensaje" cols="30" rows="10" placeholder="Comentario_" class="rounded-lg border-0 colorform py-1 px-2"></textarea>
                </div>
                <input type="submit" value="" id="botonimagen" class="img-fluid">
            </form>
        </aside>
        
        </div>
        </div>
    
        <?php include('inc/footer.php'); ?>
    
    </html>