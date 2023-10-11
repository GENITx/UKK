<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaksi Page</title>
        <link rel="stylesheet" href="css/keranjang.css">
    </head>
    <body>
        <?php
        include "header.php";
    ?>
        <div class="main_content">
            <div class="header">Keranjang</div>
            <div class="info">
                <!-- Tabel Keranjang -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
            $total = 0;
            if (@$_SESSION['cart']){
            foreach ($_SESSION['cart'] as $key_menu => $val_menu): 
                $subtotal = $val_menu['qty'] * $val_menu['harga'];
                $total += $subtotal;
            ?>
                    <tbody>
                        <tr>
                            <td class="no"><?=($key_menu+1)?></td>
                            <td class="nama"><?=$val_menu['nama_paket']?></td>
                            <td class="harga">
                                <?php
                            echo "Rp. ".number_format($val_menu['harga'], 2, ',', '.')."";
                        ?>
                            </td>
                            <td><?=$val_menu['qty']?></td>
                            <td>
                                <?php
                            echo "Rp. ".number_format($val_menu['total_harga'], 2, ',', '.')."";
                        ?>
                            </td>
                            <td class="x">
                                <a
                                    href="hapus_cart.php?id_menu=<?=$key_menu?>"
                                    onclick="return confirm('Anda yakin menghapus ini?');">
                                    <strong>X</strong>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="3">Total</td>
                            <td colspan="3">
                                <?php
                            echo "Rp. ".number_format($total, 2, ',', '.')."";
                        ?>
                            </td>
                        </tr>
                        <?php
                }
                ?>
                    </tbody>
                </table>
                
                <?php
                include "koneksi.php";
            ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pembelian</h5>
                        <div class="card-text">
                            <form action="checkout.php" method="post">
                                Nama Pelanggan :
                            <input id="nama_pelanggan" type="text" name="nama_pelanggan" value="">
                            <br>
                            Pilih Meja : 
                                <select name="nama_meja" id="">
                                    <option value=""></option>
                                    <?php
                        include "koneksi.php";
                        $qry_meja=mysqli_query($conn,"select * from meja");
                        $no=0;
                        while($data_meja=mysqli_fetch_array($qry_meja)){
                        $no++;?>
                                    <option value="<?=$data_meja['id_meja']?>"><?=$no?>
                                        -
                                        <?=$data_meja['nama_meja']?></option>
                                    <?php
                        }
                    ?>
                                </select>
                                <br>
                                <input class="button" type="submit" value="Checkout">
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                $qry_menu=mysqli_query($conn,"select * from menu");
                while($data_menu=mysqli_fetch_array($qry_menu)){?>
                <form action="masukkankeranjang.php" method="post">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?=$data_menu['nama_paket']?></h5>
                            <p class="card-text">
                                <?php
                                echo "Rp. ".number_format($data_menu['harga'], 2, ',', '.')."";
                            ?>
                            </p>
                            <input type="hidden" name="id_menu" value="<?=$data_menu['id_menu']?>">
                            <input class="jml" type="number" min="1" value="1" name="jml_beli"><br>
                            <input class="button" type="submit" value="Tambah">
                        </div>
                    </div>
                </form>
                <?php
                }
            ?>
                
                
            </div>
        </div>
    </body>
</html>