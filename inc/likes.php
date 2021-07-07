<?php

    include('connect.php');

    if (isset($_POST)) {
        
        $id = $_POST['id'];
        $user = $_POST['user'];
        $heart = $_POST['value'];

        if ($heart == 'like') {
            $sql = "INSERT INTO likes (producto, usuario) VALUES ($id, $user);";
        } elseif ($heart == 'dike') {
            $sql = "DELETE FROM likes WHERE producto = $id AND usuario = $user;";
        }

        $result = mysqli_query($enlace, $sql);
        
    }
?>