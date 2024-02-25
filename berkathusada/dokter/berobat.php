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
                                <a class="btn btn-primary" href="berobat.tambah?id=<?=$idp;?>" title="Buat Diagnosa"><i class="fas fa-plus-circle"></i></a>
                                <a class="btn btn-primary" href="berobat.jasatindakan?id=<?=$idp;?>" title="Buat Jasa dan Tindakan"><i class="fas fa-cog"></i></a>
                                <a class="btn btn-primary" href="pasien"><i class="fas fa-caret-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-2">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered table-responsive">
                                <thead>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Berobat</th>
                                    <th>Anamnesa</th>
                                    <th>Diagnosis</th>
                                    <th>Terapi</th>
                                    <th>Aksi</th>
                                </thead>
                                <?php 
                                $riwayat=mysqli_query($kon,"select *,user.id,user.nama as dokter, user.status from riwayat join user on riwayat.iddokter=user.id where riwayat.idpasien='$idp' and user.status like '%Dokter%' order by riwayat.id desc");
                                $no=1;
                                while($r=mysqli_fetch_array($riwayat))
                                {
                                    ?>
                                    <tr>
                                        <td><?=$no;?></td>
                                        <td><?=$r['kode'];?></td>
                                        <td><?=$r['dokter'];?></td>
                                        <td><?=$r['tgl'];?></td>
                                        <td><?=$r['anamnesa'];?></td>
                                        <td><?=$r['diagnosis'];?></td>
                                        <td><?=$r['terapi'];?></td>
                                        <td><a class="btn btn-sm btn-danger" href="berobat.hapus?idriwayat=<?=$r['id'];?>"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                    $no++;
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