<?php
if($_POST){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];

    include "koneksi.php";
        $insert=mysqli_query($conn,"insert into user (username, email, password, role) value ('".$username."','".$email."','".md5($password)."', '".$role."')");
        if($insert){
            echo "<script>alert('Sukses menambahkan');location.href='login.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan');location.href='login.php';</script>";
        }
    }
?>