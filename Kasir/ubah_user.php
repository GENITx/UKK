<!DOCTYPE html>
<html>
    <head>
        <title>Ubah User</title>
        <link rel="stylesheet" href="css/ubah_member_user.css">
    </head>
    <body>
        <?php 
    include "header.php";
    include "koneksi.php";
    $qry_get_user = mysqli_query($conn,"select * from user where id_user = '".$_GET['id_user']."'");
    $dt_user=mysqli_fetch_array($qry_get_user);
    ?>
        <div class="main_content">
            <div class="header">
                <h3>Ubah user</h3>
            </div>
            <div class="info">
                <form action="proses_ubah_user.php" method="post">
                    <input type="hidden" name="id_user" value="<?=$dt_user['id_user']?>">
                    Username :
                    <input type="text" name="username" value="<?=$dt_user['username']?>">
                    <br>
                    Email :
                    <input type="text" name="email" value="<?=$dt_user['email']?>">
                    <br>
                    Password :
                    <input type="password" name="password" value="">
                    <br>
                    Role :
                    <?php 
        $arr_role=array('admin'=>'Admin','kasir'=>'Kasir','manager'=>'Manager');
        ?>
                    <select  name="role" class="form-control">
                        <option></option>
                    <?php foreach ($arr_role as $key_role => $val_role):
                if($key_role==$dt_user['role']){
                    $selek="selected";
                } else {
                    $selek="";
                }
             ?>
                        <option value="<?=$key_role?>" <?=$selek?>><?=$val_role?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <input class = "submit" type="submit" name="simpan" value="Ubah User">
                </form>
            </div>
        </div>
    </body>
</html>