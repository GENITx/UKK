<?php
if($_POST){
    $id_menu=$_POST['id_menu'];
    $nama_paket=$_POST['nama_paket'];
    $harga=$_POST['harga'];
    if(empty($nama_paket)){
        echo "<script>alert('nama paket tidak boleh kosong');location.href='ubah_menu.php';</script>";
 
    } elseif(empty($harga)){
        echo "<script>alert('harga tidak boleh kosong');location.href='ubah_menu.php';</script>";
    } else {
        include "koneksi.php";
        $update=mysqli_query($conn,"update menu set nama_paket='".$nama_paket."', harga='".$harga."' where id_menu = '".$id_menu."'") or die(mysqli_error($conn));
        if($update){
            echo "<script>alert('Sukses update paket');location.href='menu.php';</script>";
        } else {
            echo "<script>alert('Gagal update paket');location.href='ubah_menu.php?id_menu=".$id_menu."';</script>";
        }
    }
    }
?>