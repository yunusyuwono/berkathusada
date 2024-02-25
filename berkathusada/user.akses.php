<?php 
include 'nav.php';
?>
<div id="main">
    <header class="">
        <a href="#" class="burger-btn d-block p-2">
            <i class="fas fa-bars"></i> Menu 
        </a>
    </header> 
    <div class="page-content">
       
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class=" text-white">Akses User</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <a class="btn btn-lg btn-primary" href="master?hal=user"><i class="fas fa-caret-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body text-dark mt-3">
                    <?php 
                    $id=$_GET['id'];
                    $gid=mysqli_fetch_array(mysqli_query($kon,"select * from user where id='$id'"));

                    if(isset($_POST['simpan']))
                    {
                        $akses=$_POST['akses'];
                        $gak=implode(",",$akses);
                        $upduser=mysqli_query($kon,"update user set status='$gak' where id='$id'");
                        if($upduser)
                        {
                            ?>
                            <div class="alert alert-success">
                                Akses berhasil disimpan
                            </div>
                            <?php
                        }
                        elseif($upduser)
                        {
                            ?>
                            <div class="alert alert-danger">
                                Akses gagal disimpan
                            </div>
                            <?php
                        }
                    }

                    $gidac=mysqli_num_rows(mysqli_query($kon,"select * from user where id='$id' and status like '%Admin Center%'"));
                    $gidap=mysqli_num_rows(mysqli_query($kon,"select * from user where id='$id' and status like '%Apotek%'"));
                    $gidak=mysqli_num_rows(mysqli_query($kon,"select * from user where id='$id' and status like '%Klinik%'"));
                    $gidad=mysqli_num_rows(mysqli_query($kon,"select * from user where id='$id' and status like '%Dokter%'"));
                    $gidar=mysqli_num_rows(mysqli_query($kon,"select * from user where id='$id' and status like '%Praktek%'"));
                    $gidas=mysqli_num_rows(mysqli_query($kon,"select * from user where id='$id' and status like '%Kasir%'"));
                    ?>
                    Berikan Akses User <?=$gid['nama'];?> untuk dapat akses :
                    <form method="post">
                        <div class="form-group">
                            <ul class="list-group" style="list-style: none;">
                                <li class="list-group-item"><input type="checkbox" name="akses[]" <?php if($gidac==1){echo "checked";}  ?> value="Admin Center"> Admin Center </li>
                                <li class="list-group-item"><input type="checkbox" name="akses[]" <?php if($gidap==1){echo "checked";}  ?> value="Apotek"> Apotek </li>
                                <li class="list-group-item"><input type="checkbox" name="akses[]" <?php if($gidak==1){echo "checked";}  ?> value="Klinik"> Klinik </li>
                                <li class="list-group-item"><input type="checkbox" name="akses[]" <?php if($gidad==1){echo "checked";}  ?> value="Dokter"> Dokter </li>
                                <li class="list-group-item"><input type="checkbox" name="akses[]" <?php if($gidar==1){echo "checked";}  ?> value="Praktek"> Praktek </li>
                                <li class="list-group-item"><input type="checkbox" name="akses[]" <?php if($gidas==1){echo "checked";}  ?> value="Kasir"> Kasir </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <button name="simpan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
<?php 
include 'foot.php';
?>