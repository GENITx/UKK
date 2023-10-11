<?php
    session_start();
    unset($_SESSION['cart'][$_GET['id_menu']]);
    header('location: keranjang.php');
?>