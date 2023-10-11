<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaksi Page</title>
        <link rel="stylesheet" href="css/histori.css">
    </head>
    <body>
        <?php
        include "header.php";
    ?>
        <div class="header">
            Histori Page
        </div>
        
        <div class="main_content">
            <div class="info">
                <?php
                if ($_SESSION['role'] == 'manager'){
                ?>
            <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form method="post" class="form-inline">
                                    <div class="input-group mb-3">
                                        Dari Tanggal : 
                                        <input type="date" name="dari_tgl" required="required" class="form-control">
                                        Sampai Tanggal :
                                        <input type="date" name="sampai_tgl" required="required" class="form-control">
                                        <button type="submit" name="filter_tgl" class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                                <br>
                                <?php
                                    if (isset($_POST['filter_tgl'])){
                                        $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
                                        $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
                                        echo "Dari tanggal ".$dari_tgl." Sampai tanggal ".$sampai_tgl;
                                    }
                                    ?>
                                <br>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
            ?>
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Meja</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama User</th>
                            <th>Nama Paket - Qty - Harga</th>
                            <th>Total Harga</th>
                            <th>Tgl Order</th>
                            <th>Status Bayar</th>
                            <?php
                ?>  
                            <?php 
                    if ($_SESSION['role'] == 'kasir'){
                ?>
                            <th>Nota</th>
                        <?php } ?>
                        </tr>
                    </thead>
            
                    <tbody>

                        <?php
            include "koneksi.php";
            $no=0;
            if (isset($_POST['filter_tgl'])) {
                $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
                $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
                $qry_histori=mysqli_query($conn, "select transaksi.*, meja.nama_meja as nama_meja, user.username  as nama_user from transaksi join user ON user.id_user = transaksi.id_user join meja ON meja.id_meja = transaksi.id_meja where tgl_transaksi between '$dari_tgl' and '$sampai_tgl'");
                while($dt_histori=mysqli_fetch_array($qry_histori)){
                    $total=0;
                    $no++;
                    $paket_dibeli="<ol>";
                    $jumlah_barang="<ol>";
                    $qry_menu = mysqli_query($conn,"select * from  detail_transaksi join menu on menu.id_menu=detail_transaksi.id_menu where id_transaksi = ".$dt_histori['id_transaksi']);
                    while($dt_menu=mysqli_fetch_array($qry_menu)){
                        $subtotal = 0;
                        $subtotal += $dt_menu['harga'] * $dt_menu['qty'];
                        $paket_dibeli.="<li class = 'menu'>".$dt_menu['nama_paket']."&nbsp;&nbsp;-&nbsp;&nbsp;".$dt_menu['qty']."&nbsp;&nbsp;-&nbsp;&nbsp;"."Rp. ".number_format($subtotal, 2, ',', '.').""."</li>";
                        $jumlah_barang.="<li>".$dt_menu['qty']."</li>";
                        $total += $dt_menu['harga'] * $dt_menu['qty'];
                    }
                    $paket_dibeli.="</ol>";

                    ?>
                    <tr>
                            <td><?=$no?></td>
                            <td><?=$dt_histori['nama_meja']?></td>
                            <td><?=$dt_histori['nama_pelanggan']?></td>
                            <td><?=$dt_histori['nama_user']?></td>
                            <td><?=$paket_dibeli?></td>
                            <td>
                                <?php
                            echo "Rp. ".number_format($total, 2, ',', '.')."";
                        ?>
                            </td>
                            <td><?=$dt_histori['tgl_transaksi']?></td>
                            <td><?=$dt_histori['status']?></td>
                            
                            <td>
                                <?php
                            if ($dt_histori['status'] == "Belum Bayar") {
                            ?>
                                <a href="ubah_status.php?id_transaksi=<?=$dt_histori['id_transaksi']?>">
                                    <button>Lunas</button>
                                </a>
                                
                            <?php
                            } 
                            ?>
                                
                            
                            <?php 
                                if ($dt_histori['status'] == 'Lunas'){
                            ?> 
                            <?php
                            if ($_SESSION['role'] == 'kasir'){
                                ?>
                            <a href="nota.php?id_transaksi=<?=$dt_histori['id_transaksi']?>">
                                    <button class="done">O</button>
                                </a>
                        </td>
                        <?php
                            }
                            ?>
                            <?php
                                }
                            
                            ?>
                        </tr>
                        <?php
                    }
                } else {
            $qry_histori=mysqli_query($conn, "select transaksi.*, meja.nama_meja as nama_meja, user.username  as nama_user from transaksi join user ON user.id_user = transaksi.id_user join meja ON meja.id_meja = transaksi.id_meja order by id_transaksi desc");
            while($dt_histori=mysqli_fetch_array($qry_histori)){
                    $total=0;
                    $no++;
                    $paket_dibeli="<ol>";   
                    $jumlah_barang="<ol>";
                    $qry_menu = mysqli_query($conn,"select * from  detail_transaksi join menu on menu.id_menu=detail_transaksi.id_menu where id_transaksi = ".$dt_histori['id_transaksi']);
                    while($dt_menu=mysqli_fetch_array($qry_menu)){
                        $subtotal = 0;
                        $subtotal += $dt_menu['harga'] * $dt_menu['qty'];
                        $paket_dibeli.="<li class = 'menu'>".$dt_menu['nama_paket']."&nbsp;&nbsp;-&nbsp;&nbsp;".$dt_menu['qty']."&nbsp;&nbsp;-&nbsp;&nbsp;"."Rp. ".number_format($subtotal, 2, ',', '.').""."</li>";
                        $jumlah_barang.="<li>".$dt_menu['qty']."</li>";
                        $total += $dt_menu['harga'] * $dt_menu['qty'];
                    }
                    $paket_dibeli.="</ol>";
                    ?>
                    <tr>
                            <td><?=$no?></td>
                            <td><?=$dt_histori['nama_meja']?></td>
                            <td><?=$dt_histori['nama_pelanggan']?></td>
                            <td><?=$dt_histori['nama_user']?></td>
                            <td><?=$paket_dibeli?></td>
                            <td>
                                <?php
                            echo "Rp. ".number_format($total, 2, ',', '.')."";
                        ?>
                            </td>
                            <td><?=$dt_histori['tgl_transaksi']?></td>
                            <td><?=$dt_histori['status']?></td>
                            
                            <td>
                                <?php
                            if ($dt_histori['status'] == "Belum Bayar") {
                            ?>
                                <a href="ubah_status.php?id_transaksi=<?=$dt_histori['id_transaksi']?>">
                                    <button>Lunas</button>
                                </a>
                                
                            <?php
                            } 
                            ?>
                                
                            
                            <?php 
                                if ($dt_histori['status'] == 'Lunas'){
                            ?> 
                            <?php
                            if ($_SESSION['role'] == 'kasir'){
                                ?>
                            <a href="nota.php?id_transaksi=<?=$dt_histori['id_transaksi']?>">
                                    <button class="done">O</button>
                                </a>
                        </td>
                        <?php
                            }
                            ?>
                            <?php
                                }
                            
                            ?>
                        </tr>
                        <?php
                }
            }
            ?>
            <?php
                    // include "koneksi.php";
                    // if (isset($_POST['filter_tgl'])) {
                    // $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
                    // $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
                    // $qry_histori=mysqli_query($conn, "select transaksi.*, meja.nama_meja as nama_meja, user.username  as nama_user from transaksi join user ON user.id_user = transaksi.id_user join meja ON meja.id_meja = transaksi.id_meja order by id_transaksi where tgl_transaksi between '$dari_tgl' and '$sampai_tgl'");
                    // // $qry_histori = mysqli_query($conn,"select * from transaksi where tgl_transaksi between '$dari_tgl' and '$sampai_tgl'");
                    // } else {
                    // $qry_histori=mysqli_query($conn, "select transaksi.*, meja.nama_meja as nama_meja, user.username  as nama_user from transaksi join user ON user.id_user = transaksi.id_user join meja ON meja.id_meja = transaksi.id_meja order by id_transaksi desc");
                    // }
                    // ?>
                        
                    </tbody>
                </table>
                <!-- <a href="hapus_histori.php" onclick="return confirm('Yakin menghapus
                seluruh histori?');"> <button>Hapus Seluruh Histori</button> </a> -->
            </div>
        </div>

    </body>
</html>