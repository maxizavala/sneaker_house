<?php

    include('connect.php');
    $a_modelos = mysqli_query($enlace, "SELECT CONCAT(marca, ' ',modelo) AS modelo, id_producto FROM producto");

    $q = $_REQUEST["q"]; // string  FORM

    $sugerencia = "";

    if ($q !== "") {

        $q = strtolower($q); // string a minusculas
        $len = strlen($q); // largo del string 

        foreach($a_modelos as $producto) {
            foreach ($producto as $name) {
                if (stristr($q, substr($name, 0, $len)) || (strpos(strtolower($name), $q))) {
                    if ($sugerencia === "") {
                        $sugerencia = "<a href='edit_producto.php?pr=".$producto['id_producto']."' class=\"btn btn-primary\" style=\"margin-bottom: 10px\">".$name."</a>";
                    } else {
                        $sugerencia .= " <a href='edit_producto.php?pr=".$producto['id_producto']."' class=\"btn btn-primary\" style=\"margin-bottom: 10px\">".$name."</a>";
                    }
                }
            }
        }
    } 

    echo $sugerencia === "" ? "Sin sugerencias" : $sugerencia;

?>