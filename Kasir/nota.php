<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nota</title>
        <link rel="stylesheet" href="css/nota.css">
    </head>
    <body>
        <?php
            include "koneksi.php";
        ?>

        <div class="main_content">
           <a href="histori.php"><button><</button></a> 
            <div class="info">
                <div class="nota">
                    <div class="header">Nota Transaksi</div>
                    <h1>Babayo Cafe</h1>
                    <br>
                    <?php
                    $qry_transaksi = mysqli_query($conn, "select transaksi.*, nama_pelanggan, nama_meja, user.username as nama_user
                                                        from transaksi 
                                                        join user ON user.id_user = transaksi.id_user 
                                                        join meja ON meja.id_meja = transaksi.id_meja
                                                        where transaksi.id_transaksi = '".$_GET['id_transaksi']."'");

                    
                    while ($dt_transksi = mysqli_fetch_array($qry_transaksi)) {
    
                        $total = 0;
                        $harga_sub = "<ol style='list-style:none'>";
                        $harga = "<ol style='list-style:none'>";
                        $qty = "<ol style='list-style:none'>";
                        $nota_paket = "<ol style='list-style:none'>";
                        $qry_menu = mysqli_query($conn,"select * from  detail_transaksi join menu on menu.id_menu=detail_transaksi.id_menu where id_transaksi = ".$dt_transksi['id_transaksi']);
                        while($dt_menu=mysqli_fetch_array($qry_menu)){
                            
                            $subtotal = 0;
                            $subtotal += $dt_menu['harga'] * $dt_menu['qty'];
                            $qty .= "<li>".$dt_menu['qty']."</li><br>";
                            $nota_paket .= "<li>".$dt_menu['nama_paket']."</li><br>";
                            $total += $dt_menu['harga'] * $dt_menu['qty'];
                            $harga.= "<li>"."Rp. ".number_format($dt_menu['harga'], 2, ',', '.').""."</li><br>";
                            $harga_sub.= "<li>"."Rp. ".number_format($subtotal, 2, ',', '.').""."</li><br>";
                        }
                        $nota_paket .= "</ol>";
                        $qty .= "</ol>";
                        $harga .= "</ol>";
                        $harga_sub .= "</ol>";
                        ?>
                    <p class="right">Status Bayar&nbsp;:&nbsp;<?=$dt_transksi['status']?></p>
                    <p>Nama Meja&nbsp;:&nbsp;<?=$dt_transksi['nama_meja']?></p>
                    <p class="right">Tanggal Transaksi&nbsp;:&nbsp;<?=$dt_transksi['tgl_transaksi']?></p>
                    <p class="jeda">Nama User&nbsp;:&nbsp;<?=$dt_transksi['nama_user']?></p>
                    <p class="jeda">Nama Pelanggan&nbsp;:&nbsp;<?=$dt_transksi['nama_pelanggan']?></p>
                    
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$nota_paket?></td>
                                <td><?=$qty?></td>
                                <td><?=$harga?></td>
                                <td><?=$harga_sub?></td>
                            </tr>
                            <tr>
                                <td colspan="3">Total</td>
                                <td colspan="3">
                                    <?php
                                        echo "Rp. ".number_format($total, 2, ',', '.')."";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>