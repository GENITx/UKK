<?php
if($_POST){
    $nama_paket=$_POST['nama_paket'];
    $harga=$_POST['harga'];
    if(empty($nama_paket)){
        echo "<script>alert('nama paket tidak boleh kosong');location.href='tambah_menu.php';</script>";
 
    } elseif(empty($harga)){
        echo "<script>alert('harga tidak boleh kosong');location.href='tambah_menu.php';</script>";
    } else {
        include "koneksi.php";
        $insert=mysqli_query($conn,"insert into menu (nama_paket, harga) value ('".$nama_paket."', '".$harga."')") or die(mysqli_error($conn));
        if($insert){
            echo "<script>alert('Sukses menambahkan paket');location.href='menu.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan paket');location.href='tambah_menu.php';</script>";
        }
    }
}
?>