<?php
if($_POST){
    $nama_meja=$_POST['nama_meja'];
    if(empty($nama_meja)){
        echo "<script>alert('nama meja tidak boleh kosong');location.href='tambah_meja.php';</script>";
    } else {
        include "koneksi.php";
        $insert=mysqli_query($conn,"insert into meja (nama_meja) value ('".$nama_meja."')") or die(mysqli_error($conn));
        if($insert){
            echo "<script>alert('Sukses menambahkan meja');location.href='meja.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan meja');location.href='tambah_meja.php';</script>";
        }
    }
}
?>