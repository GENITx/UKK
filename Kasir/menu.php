<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Paket Page</title>
        <link rel="stylesheet" href="css/paket.css">
    </head>
    <body>
        <?php
        include "header.php";
    ?>
        <div class="main_content">
            <div class="header">Tabel Menu</div>
            <div class="info">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include "koneksi.php";
                        $qry_menu=mysqli_query($conn,"select * from menu");
                        $no=0;
                        while($data_menu=mysqli_fetch_array($qry_menu)){
                        $no++;?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$data_menu['nama_paket']?></td>
                            <td>
                                <?php
                                    echo "Rp. ".number_format($data_menu['harga'], 2, ',', '.')."";
                                ?>
                            </td>
                            <td>
                                <a href="ubah_menu.php?id_menu=<?=$data_menu['id_menu']?>">
                                    <button>Ubah</button>
                                </a>
                                |
                                <a
                                    href="hapus_menu.php?id_menu=<?=$data_menu['id_menu']?>"
                                    onclick="return confirm('Apakah anda yakin menghapus data ini?')">
                                    <button>Hapus</button>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
                <br>
                <?php 
                    if ($_SESSION['role'] == 'admin'){
                ?>
                <a href="tambah_menu.php">
                    <button>Tambah Menu</button>
                </a>
                <?php } ?>
            </div>
        </div>
    </body>
</html>