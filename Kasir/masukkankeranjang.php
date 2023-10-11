<?php
    session_start();
    if($_POST){
        include "koneksi.php";
        
        $qry_get_menu=mysqli_query($conn,"select * from menu where id_menu = '".$_POST['id_menu']."'");
        $dt_menu=mysqli_fetch_array($qry_get_menu);
        $_SESSION['cart'][]=array(
            'id_menu'=>$dt_menu['id_menu'],
            'nama_paket'=>$dt_menu['nama_paket'],
            'harga'=>$dt_menu['harga'],
            'qty'=>$_POST['jml_beli'],
            'total_harga' =>$dt_menu['harga']*$_POST['jml_beli']
        );
    }
    header('location: keranjang.php');
?>