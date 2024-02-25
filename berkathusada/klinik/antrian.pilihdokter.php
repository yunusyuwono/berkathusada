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
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="text-white">Antrian</h4>
                    </div>
                    <div class="col-lg-6" align="right">
                        <a href="antrian.tambah" class="btn btn-lg btn-primary"><i class="fas fa-plus-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body col-md-6">
                <br>
                <form method="post" action="antrian.proses">
                    <label>Pilih Dokter</label>
                    <input type="hidden" name="antrianid" value="<?=$_GET['antrian']?>">
                    <select name="dokter" class="form-control">
                        <option>Pilih Dokter</option>
                    <?php 
                    $dok=mysqli_query($kon,"select * from user join poli on user.id=poli.iddokter where user.status like '%Dokter%'");
                    while ($d=mysqli_fetch_array($dok)) {
                        ?>
                        <option value="<?=$d['user.id'];?>"><?=$d['gelar1'].".".$d['nama'].",".$d['gelar2'];?> - <?=$d['poli'];?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <button name="terap" class="btn btn-primary btn-sm">Terapkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
include 'foot.php';
?>