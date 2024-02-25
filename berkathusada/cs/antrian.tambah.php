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
                        <a href="antrian" class="btn btn-primary"><i class="fas fa-caret-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php 
                if(isset($_POST['simpan']))
                {
                    $tgl=addslashes($_POST['tgl']);
                    $plg=addslashes($_POST['plg']);
                    $poli=addslashes($_POST['poli']);
                    $gan=mysqli_fetch_array(mysqli_query($kon,"select max(noantri) as tna from antrian where tgl='$tgl'"));
                    $noan=$gan['tna']+1;
                    $status='Menunggu';
                    $simpan=mysqli_query($kon,"insert into antrian (tgl,noantri,kodepasien,poli,status) values ('$tgl','$noan','$plg','$poli','$status')");
                    if($simpan)
                    {
                        ?>
                        <div class="alert alert-success">
                            Antrian berhasil dibuat
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-danger">
                            Antrian gagal dibuat. <?=mysqli_error($kon);?>
                        </div>
                        <?php
                    }
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tgl" value="<?=date('Y-m-d');?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pasien</label>
                        <select name="plg" class="form-control">
                            <?php 
                            $plg=mysqli_query($kon,"select * from pelanggan order by kode asc");
                            while ($p=mysqli_fetch_array($plg)) {
                                ?>
                                <option value="<?=$p['kode'];?>"><?=$p['kode'];?> <?=$p['nama'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Poli</label>
                        <select name="poli" class="form-control">
                            <?php 
                            $plg=mysqli_query($kon,"select *,poli.poli as npoli,user.nama as namadok,user.gelar1 as glr1, user.gelar2 as glr2 from poli join user on poli.iddokter=user.id order by poli.poli asc");
                            while ($p=mysqli_fetch_array($plg)) {
                                ?>
                                <option value="<?=$p['iddokter'];?>"><?=$p['npoli'];?> - <?=$p['glr1'].'. '.$p['namadok'].', '.$p['glr2'];?></option>
                                <?php
                            }
                            ?>
                        </select>
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