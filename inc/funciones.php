<?php

//Crea un archivo Json a partir de un array en una carpeta especificada.
    function GuardarArrayEnJson($carpeta, $nombre_archivo, $array){ 
        if(!file_exists("../".$carpeta)){ //Si el directorio NO existe...
            mkdir($carpeta); //crea el directorio
        }
        $fp = fopen("../".$carpeta."/".$nombre_archivo, 'w');
        fwrite($fp, json_encode($array));
        fclose($fp);
    }

    //Lee un archivo Json y devuelve un array
	function LeerArrayJson($carpeta, $nombre_archivo){ 
        $fp = fopen($carpeta."/".$nombre_archivo, 'r');
        $json = fread($fp, filesize($carpeta."/".$nombre_archivo));
        fclose($fp);
        $array = json_decode($json, true);
        return $array;
    }
    
    //Muestra el contenido de cada comentario
    function MostrarComentarios($carpeta, $nombre_json, $id_producto){
        $array = LeerArrayJson($carpeta, $nombre_json);
        for ($i=1; $i <= count($array); $i++) { 
            if ($array[$i]['id_producto'] == $id_producto) {
                echo "<p>".$array[$i]['correo']."<p>";
                echo "<p>".$array[$i]['mensaje']."<p>";
                echo "<p>Valoracion: ".$array[$i]['valoracion']."<p>";
                echo "<hr>"; 
            }
        }
    }

    //Muestra el contenido del array de productos
    function MostrarProducto($carpeta, $nombre_json, $id_producto){
        $array = LeerArrayJson($carpeta, $nombre_json);
        for ($i=1; $i <= count($array); $i++) { 
            if ($array[$i]['id_producto'] == $id_producto) {
                $a_producto = $array[$i]; 
            }
        }
        return $a_producto;
    }

    //Mostrar categoria del producto
    function MostrarCategoria($carpeta, $nombre_json, $id_categoria){
        $array = LeerArrayJson($carpeta, $nombre_json);
        $categoria = $array[$id_categoria]['nombre'];
        return $categoria;
    }

    //Etiqueta active del boostrap segun pagina donde se esta
    function MenuDinamico($pagina){
        if (strpos($_SERVER['PHP_SELF'], $pagina)) {
            echo 'active';
        }
    }

    //Etiqueta title segun producto
    function MostrarTitulo($id_producto){
        $array = LeerArrayJson('json', 'productos.json');
        for ($i=1; $i <= count($array); $i++) { 
            if ($array[$i]['id_producto'] == $id_producto) {
                $a_producto = $array[$i]; 
            }
        }
        return $a_producto['marca']." ".$a_producto['modelo'];
    }

    //Etiqueta title segun pagina donde se esta
    function EtiquetaTitle(){
        if (strpos($_SERVER['PHP_SELF'], 'index.php')) {
            echo "Home";
        }
        elseif (strpos($_SERVER['PHP_SELF'], 'producto.php')) {
            echo MostrarTitulo($_REQUEST['id']);
        }
        elseif (strpos($_SERVER['PHP_SELF'], 'contacto.php')) {
            echo "Contacto";
        }
        else {
            echo "Sneaker House";
        }
    }

?>