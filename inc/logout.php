<?php
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["name"]);
    header("Location:../index.php");
?>