<?php

    //Etiqueta active del boostrap segun pagina donde se esta
    function MenuDinamico($pagina){
        if (strpos($_SERVER['PHP_SELF'], $pagina)) {
            echo 'active';
        }
    }



    //Etiqueta title segun pagina donde se esta
    function EtiquetaTitle(){
        if (strpos($_SERVER['PHP_SELF'], 'index.php')) {
            echo "Home";
        }
        elseif (strpos($_SERVER['PHP_SELF'], 'contacto.php')) {
            echo "Contacto";
        }
        else {
            echo "Sneaker House";
        }
    }

    //Talles segun categoria
    function TalleSegunCategoria($categoria){
        if ($categoria == 1) {
            $min = 40; $max = 45;
        }
        elseif ($categoria == 2){
            $min = 35; $max = 40;
        }
        elseif ($categoria == 3){
            $min = 27; $max = 34;
        }
        echo "<select name='talle' class='form-control'>";
            for ($i=$min; $i <= $max ; $i++) { 
                echo "<option>$i</option>";
            }   
            echo "</select>";
    }

    //Funcion mensaje emergente
    function MensajeEmergente($mensaje, $color){
        switch ($color) {
            case 'amarillo':
                $tipo =  'alert-warning';
                break;
            case 'verde':
                $tipo =  'alert-success';
                break;
            case 'rojo':
                $tipo =  'alert-danger';
                break;
        }
        echo
            "<div class='alert $tipo alert-dismissible fade show' role='alert'>
                $mensaje
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
    }

    //Funcion like-dislike
    function likeDislike($articulo, $usuario){
        include('inc/connect.php');
        
    }

    
?>