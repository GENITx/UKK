<?php
if($_POST){
    $id_meja=$_POST['id_meja'];
    $nama_meja=$_POST['nama_meja'];
    if(empty($nama_meja)){
        echo "<script>alert('nama meja tidak boleh kosong');location.href='ubah_meja.php';</script>";
    } else {
        include "koneksi.php";
            $update=mysqli_query($conn,"update meja set nama_meja='".$nama_meja."'") or die(mysqli_error($conn));
            if($update){
                echo "<script>alert('Sukses update meja');location.href='meja.php';</script>";
            } else {
                echo "<script>alert('Gagal update meja');location.href='ubah_meja.php?id_meja=".$id_meja."';</script>";
            }
        }
        
    } 
?>