<?php
    $enlace = mysqli_connect('localhost', 'root', '', 'sneaker_house');

    if (!$enlace) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
    }

    echo 'Éxito... ' . mysqli_get_host_info($enlace) . "\n";

    $result = mysqli_query($enlace, "SELECT * FROM categoria");

    while($row = mysqli_fetch_array($result)) {
        echo $row['nombre']."<br>"; 
    }

    mysqli_close($enlace);
?>
