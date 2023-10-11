<?php
if($_POST){
    $id_user=$_POST['id_user'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    if(empty($username)){
        echo "<script>alert('username user tidak boleh kosong');location.href='ubah_user.php';</script>";
 
    } elseif(empty($email)){
        echo "<script>alert('email tidak boleh kosong');location.href='ubah_user.php';</script>";
    } elseif(empty($password)){
        echo "<script>alert('password tidak boleh kosong');location.href='ubah_user.php';</script>";
    } else {
        include "koneksi.php";
        if(empty($password)){
            $update=mysqli_query($conn,"update user set username='".$username."', email='".$email."', password='".$password."', role='".$role."' where id_user = '".$id_user."' ") or die(mysqli_error($conn));
            if($update){
                echo "<script>alert('Sukses update user');location.href='user.php';</script>";
            } else {
                echo "<script>alert('Gagal update user');location.href='ubah_user.php?id_user=".$id_user."';</script>";
            }
        } else {
            $update=mysqli_query($conn,"update user set username='".$username."', email='".$email."', password='".md5($password)."', role='".$role."' where id_user = '".$id_user."'") or die(mysqli_error($conn));
            if($update){
                echo "<script>alert('Sukses update user');location.href='user.php';</script>";
            } else {
                echo "<script>alert('Gagal update user');location.href='ubah_user.php?id_user=".$id_user."';</script>";
            }
        }
        
    } 
}
?>