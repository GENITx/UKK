<?php
    session_start();
    include "koneksi.php";
    $cart=@$_SESSION['cart'];
    $id_meja = $_POST['nama_meja'];
    $nama_pelanggan=$_POST['nama_pelanggan'];
    if(count($cart)>0 and $id_meja != NULL){
        mysqli_query($conn,"insert into transaksi (id_meja, id_user, tgl_transaksi, nama_pelanggan, status) value('".$id_meja."', '".$_SESSION['id_user']."', '".date('Y-m-d')."', '".$nama_pelanggan."', 'Belum Bayar')");
        $id=mysqli_insert_id($conn);
        foreach ($cart as $key_menu => $val_menu) {
            mysqli_query($conn,"insert into detail_transaksi (id_transaksi, id_menu, qty) value('".$id."','".$val_menu['id_menu']."', '".$val_menu['qty']."')");
        }
        unset($_SESSION['cart']);
        echo '<script>alert("Pembelian berhasil");location.href="histori.php"</script>';
    }else {
        echo '<script>alert("Belum diisi semua");location.href="keranjang.php"</script>';
    }
?>