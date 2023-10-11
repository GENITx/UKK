<!DOCTYPE html>
<html>
    <head>
        <title>Ubah Paket</title>
        <link rel="stylesheet" href="css/ubah_member_user.css">
    </head>
    <body>
        <?php 
    include "header.php";
    include "koneksi.php";
    $qry_get_menu = mysqli_query($conn,"select * from menu where id_menu = '".$_GET['id_menu']."'");
    $data_menu=mysqli_fetch_array($qry_get_menu);
    ?>
        <div class="main_content">
            <div class="header">
                <h3>Ubah Paket</h3>
            </div>
            <div class="info">
                <form action="proses_ubah_menu.php" method="post">
                    <input type="hidden" name="id_menu" value="<?=$data_menu['id_menu']?>">
                    Nama paket :
                    <input type="text" name="nama_paket" value="<?=$data_menu['nama_paket']?>">
                    <br>
                    Harga :
                    <input type="text" name="harga" value="<?=$data_menu['harga']?>">
                    <br>
                    <input class="submit" type="submit" name="simpan" value="Ubah menu">
                </form>
            </div>
        </div>
    </body>
</html>