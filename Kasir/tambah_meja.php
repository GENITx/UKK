<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Meja</title>
        <link rel="stylesheet" href="css/tambah_usermember.css">
    </head>
    <body>
        <?php
        include "header.php";
    ?>
        <div class="main_content">
            <div class="header">
                <h3>Tambah Meja</h3>
            </div>
            <div class="info">
                <form action="proses_tambah_meja.php" method="post">
                    Nama Meja :
                    <input type="text" name="nama_meja" value="">
                    <br>
                    <input class="submit" type="submit" name="simpan" value="Tambah Meja">
                    <br>
                    
                </form>
            </div>
        </div>

    </body>
</html>