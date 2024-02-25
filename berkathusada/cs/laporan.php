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
        <section class="row">
            <div class="col-12 mt-1 mb-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active  text-white" aria-current="page"><b>Laporan</b></li>
                                    </ol>
                                </nav>
                                <h4 class="text-white">Laporan</h4></div>
                            <div class="col-md-6" align="right">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-2">
                        <form method="post">
                            <div class="row">
                            <div class="form-group col-md-5">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tm" class="form-control" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="ts" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <button name="cari" class="btn btn-primary mt-4 w-100">Cari</button>
                            </div>

                            </div>
                        </form>
                        <div class="table-responsive">
                            <?php 
                            if(isset($_POST['cari']))
                                {
                                    ?>
                                    <div class="alert alert-primary">
                                        Periode tanggal <?=$_POST['tm'];?> s.d <?=$_POST['ts'];?>
                                    </div>
                                    <?php
                                }
                            ?>  
                            <table class="table table-striped table-hover table-bordered table-responsive">
                                <thead>
                                    <th>No.</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Berobat</th>
                                    <th>Anamnesa</th>
                                    <th>Diagnosis</th>
                                    <th>Terapi</th>
                                </thead>
                                <?php 
                                if(isset($_POST['cari']))
                                {
                                    $tm=$_POST['tm'];
                                    $ts=$_POST['ts'];
                                    $riwayat=mysqli_query($kon,"SELECT *,user.id,user.nama as dokter, user.status from riwayat join user on riwayat.iddokter=user.id where user.status like '%Dokter%' and tgl between '$tm' and '$ts'  order by riwayat.id desc");
                                
                                
                                    $no=1;
                                    while($r=mysqli_fetch_array($riwayat))
                                    {
                                        $p=mysqli_fetch_array(mysqli_query($kon,"SELECT * from pelanggan where id='$r[idpasien]'"));
                                        ?>
                                        <tr>
                                            <td><?=$no;?></td>
                                            <td><?=$p['nama'];?><br>
                                                <small><b><?=$p['kode'];?></b></small></td>
                                        <?php 
                                        $o=mysqli_fetch_array(mysqli_query($kon,"SELECT * from poli where iddokter='$r[iddokter]'"));
                                        ?>
                                            <td><?=$r['dokter'];?><br>
                                            <small><b><?=$o['poli'];?></b></small></td>
                                            <td><?=$r['tgl'];?></td>
                                            <td><?=$r['anamnesa'];?></td>
                                            <td><?=$r['diagnosis'];?></td>
                                            <td><?=$r['terapi'];?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                    <tr class="bg-primary text-light">
                                        <td colspan="4" align="right">Jumlah Pasien</td>
                                        <td colspan="3">
                                            <?php 
                                            $jp=mysqli_query($kon,"SELECT * from riwayat where tgl between '$tm' and '$ts' group by kode");
                                            echo mysqli_num_rows($jp);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php 
include 'foot.php';
?>