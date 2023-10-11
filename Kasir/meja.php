<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meja Page</title>
        <link rel="stylesheet" href="css/member_user.css">
    </head>
    <body>
        <?php
        include "header.php";
    ?>
        <div class="main_content">
            <div class="header">Tabel Meja</div>
            <div class="info">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Meja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include "koneksi.php";
                        $qry_meja=mysqli_query($conn,"select * from meja");
                        $no=0;
                        while($data_meja=mysqli_fetch_array($qry_meja)){
                        $no++;?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$data_meja['nama_meja']?></td>
                            <td>
                                <a href="ubah_meja.php?id_meja=<?=$data_meja['id_meja']?>">
                                    <button>Ubah</button>
                                </a>
                                |
                                <a
                                    href="hapus_meja.php?id_meja=<?=$data_meja['id_meja']?>"
                                    onclick="return confirm('Apakah anda yakin menghapus data ini?')">
                                    <button>Hapus</button>
                                </a>
                            </td>
                          
                        </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                </table>
                <br>
                <a href="tambah_meja.php">
                    <button>Tambah Meja</button>
                </a>
            </div>
        </div>
    </body>
</html>