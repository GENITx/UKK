<!DOCTYPE html>
<html>
    <head>
        <title>Ubah Meja</title>
        <link rel="stylesheet" href="css/ubah_member_user.css">
    </head>
    <body>
        <?php 
    include "header.php";
    include "koneksi.php";
    $qry_get_meja = mysqli_query($conn,"select * from meja where id_meja = '".$_GET['id_meja']."'");
    $dt_meja=mysqli_fetch_array($qry_get_meja);
    ?>
        <div class="main_content">
            <div class="header">
                <h3>Ubah Meja</h3>
            </div>
            <div class="info">
                <form action="proses_ubah_meja.php" method="post">
                    <input type="hidden" name="id_meja" value="<?=$dt_meja['id_meja']?>">
                    Nama Meja :
                    <input type="text" name="nama_meja" value="<?=$dt_meja['nama_meja']?>">
                    <br>
                    <input class="submit" type="submit" name="simpan" value="Ubah meja">
                </form>
            </div>
        </div>
    </body>
</html>