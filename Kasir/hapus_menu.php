<?php 
    if($_GET['id_menu']){
        include "koneksi.php";
        $qry_hapus=mysqli_query($conn,"delete from menu where id_menu='".$_GET['id_menu']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses hapus paket');location.href='menu.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus paket');location.href='menu.php';</script>";
        }
    }
?>