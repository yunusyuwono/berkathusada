<?php 
include 'nav.php';
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div id="main">
    <header class="">
        <a href="#" class="burger-btn d-block p-2">
            <i class="fas fa-bars"></i> Menu 
        </a>
    </header> 
    <div class="page-content">
        <section class="row">
            <div class="col-12 mt-1 mb-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-md-6">
                                <?php 
                                $idp=$_GET['id'];
                                $p=mysqli_fetch_array(mysqli_query($kon,"select * from pelanggan where id='$idp'"));
                                ?>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active  text-white" aria-current="page"><b>Pasien</b></li>
                                    </ol>
                                </nav>
                                <h4 class="text-white"><?=$p['nama'];?></h4></div>
                            <div class="col-md-6" align="right">
                                 <a class="btn btn-primary" href="berobat?id=<?=$idp;?>"><i class="fas fa-caret-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-2">
                        <?php 
                        if(isset($_POST['simpan']))
                        {
                            $tgl=addslashes($_POST['tgl']);
                            $anamnesa=addslashes($_POST['anamnesa']);
                            $diagnosis=addslashes($_POST['diagnosis']);
                            $terapi=addslashes($_POST['terapi']);
                            $iddiag=$_POST['iddiag'];

                            $cr=mysqli_num_rows(mysqli_query($kon,"select * from riwayat where idpasien='$idp'"));
                            $kode='R'.date('Y').sprintf('%03s',$idp).sprintf('%03s',$cr+1);

                            $simpan=mysqli_query($kon,"insert into riwayat (kode,idpasien,iddokter,tgl,anamnesa,diagnosis,terapi,iddiag) values ('$kode','$idp','$g[id]','$tgl','$anamnesa','$diagnosis','$terapi','$iddiag')");
                            if($simpan)
                            {
                                ?>
                                <div class="alert alert-success">
                                    Riwayat berobat berhasil disimpan
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">
                                    Riwayat berobat gagal disimpan . <?=mysqli_error($kon);?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <form method="post">
                            <div class="form-group col-lg-6">
                                <label>Tanggal Berobat</label>
                                <input type="date" name="tgl" class="form-control" required value="<?=date('Y-m-d');?>">
                            </div>
                            <div class="form-group">
                                <label>Kode Diagnosis </label>
                                <select name="iddiag" id="iddiag" class="form-control js-example-basic-single">
                                    <?php
                                    $diag=mysqli_query($kon,"SELECT * from icd order by kode asc");
                                    while($d=mysqli_fetch_array($diag))
                                    {
                                        ?>
                                        <option value="<?=$d['iddiag'];?>"><?=$d['kode'].' '.$d['diagnosa'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Anamnesa</label>
                                <textarea name="anamnesa" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Diagnosis</label>
                                <textarea name="diagnosis" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Terapi</label>
                                <textarea name="terapi" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php 
include 'foot.php';
?>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>