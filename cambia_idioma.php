<?php
    session_start();
    $idioma_nuevo = $_GET['idioma'];
    $_SESSION['idioma']=$idioma_nuevo;
?>