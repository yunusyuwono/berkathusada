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
            <div class="col-12">
                <div class="card card-body text-dark">
                Selamat Datang Dokter Klinik Berkat Husada
                </div>
            </div>
            <div class="col-6 col-lg-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Berobat Hari Ini</h6>
                                <?php 
                                $thi=mysqli_fetch_array(mysqli_query($kon,"select count(kode) as jb from riwayat where tgl='".date('Y-m-d')."'"));
                                ?>

                                <h4 class="font-extrabold mb-0"><?=$thi['jb'];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Berobat Bulan Ini</h6>
                                <?php 
                                $thb=mysqli_fetch_array(mysqli_query($kon,"select count(kode) as jb from riwayat where tgl like '%".date('Y-m')."%'"));
                                ?>
                                <h4 class="font-extrabold mb-0"><?=$thb['jb'];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-12">
                 <div class="card">
                    <div class="card-header">
                        <b>Antrian</b>
                    </div>
                    <div class="card-body px-3 py-4-5">
                        <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-responsive">
                        <thead>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>No. Antrian</th>
                            <th>Kode Pelanggan</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Poli</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
                        $antri=mysqli_query($kon,"select *,antrian.id as aid,pelanggan.nama as namaplg, pelanggan.kode as kodeplg from antrian join pelanggan on antrian.kodepasien=pelanggan.kode where antrian.status='Menunggu' or antrian.status='Dokter' order by antrian.tgl desc, antrian.status asc");
                        $no=1;
                        while($a=mysqli_fetch_array($antri))
                        {
                             $poldok=mysqli_fetch_array(mysqli_query($kon,"select * from user join poli on user.id=poli.iddokter where user.id='$a[poli]'"));
                             if($g['nama']==$poldok['nama'])
                             {
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$a['tgl'];?></td>
                                <td><?=$a['noantri'];?></td>
                                <td><?=$a['kodeplg'];?></td>
                                <td><?=$a['namaplg'];?></td>
                                <td>
                                    <?php 
                                    if($a['status']=='Menunggu')
                                    {
                                        $cls="bg-success p-1 text-white";
                                    }
                                    elseif($a['status']=='Dokter')
                                    {
                                        $cls="bg-info p-1 text-white";
                                    }
                                    elseif($a['status']=='Apotek')
                                    {
                                        $cls="bg-warning p-1 text-black";
                                    }
                                    elseif($a['status']=='Batal')
                                    {
                                        $cls="bg-danger p-1 text-white";
                                    }
                                    ?>
                                    <div class="<?=$cls;?>"><b><?=$a['status'];?></b></div>
                                </td>
                                <td>
                                    <?php 
                                   
                                    echo $poldok['poli'].' ('.$poldok['nama'].') ';
                                    ?>
                                </td>
                                <td>
                                    <a href="berobat?id=<?=$a['id'];?>" class="btn btn-sm btn-success"><i class="fas fa-syringe"></i></a>
                                    <a href="antrian.proses?tahap=Dokter&id=<?=$a['aid'];?>" onclick="return confirm('Apa anda yakin untuk melanjutkan antrian ke Apotek ?')" class="btn btn-sm btn-primary"><i class="fas fa-chevron-up"></i></a></td>
                            </tr>
                            <?php
                            if($a['status']=='Dokter')
                            {
                                ?>
                                <tr class="alert-success text-white">
                                    <td><i class="fas fa-chevron-circle-right"></i></td>
                                    <td colspan="6"><b>Ditangani oleh : </b>. Poli : </td>
                                </tr>
                                <?php
                            }
                        }

                            $no++;
                        }
                        ?>
                    </table>
                </div>
                    </div>
                </div>
            </div>          
            </div>        
        </section>
    </div>
</div>

<?php include 'foot.php';?>