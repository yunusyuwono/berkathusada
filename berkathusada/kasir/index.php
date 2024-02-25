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
                Selamat Datang User Klinik Berkat Husada
                </div>
                Anda telah menangani transaksi :
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Transaksi Hari Ini</h6>
                                Klinik : 
                                <?php 
                                $thi=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from klinik_trk where status='selesai' and tglfaktur='".date('Y-m-d')."' and idkasir='$g[id]'"));
                                ?>

                                <h4 class="font-extrabold mb-0"><?=$thi['jnf'];?></h4>

                                Apotek : 
                                <?php 
                                $tha=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from apotek_trk where status='selesai' and tglfaktur='".date('Y-m-d')."' and idkasir='$g[id]'"));
                                ?>

                                <h4 class="font-extrabold mb-0"><?=$tha['jnf'];?></h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Transaksi Bulan Ini</h6>
                                <?php 
                                $thb=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from klinik_trk where status='selesai' and tglfaktur like '%".date('Y-m')."%'"));
                                ?>
                                <h4 class="font-extrabold mb-0"><?=$thb['jnf'];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Transaksi Piutang</h6>
                                <?php 
                                $thh=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from klinik_trk where status='selesai' and tglfaktur like '%".date('Y')."%' and status_bayar='hutang'"));
                                ?>
                                <h4 class="font-extrabold mb-0"><?=$thh['jnf'];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
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
                        $antri=mysqli_query($kon,"select *,antrian.id as aid,pelanggan.nama as namaplg, pelanggan.kode as kodeplg from antrian join pelanggan on antrian.kodepasien=pelanggan.kode where antrian.status='Apotek' order by antrian.tgl desc");
                        $no=1;
                        while($a=mysqli_fetch_array($antri))
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
                                    $poldok=mysqli_fetch_array(mysqli_query($kon,"select * from user join poli on user.id=poli.iddokter where user.id='$a[poli]'"));
                                    echo $poldok['poli'].' ('.$poldok['nama'].') ';
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    if($a['status']=='Menunggu')
                                    {
                                        ?>
                                        <a href="antrian.proses?tahap=Menunggu&id=<?=$a['aid'];?>" class="btn btn-sm btn-primary"><i class="fas fa-chevron-up"></i></a>
                                        <?php
                                    }
                                    elseif($a['status']=='Apotek')
                                    {
                                        ?>
                                        <a href="transaksi.input?tahap=Apotek&kodeplg=<?=$a['kodeplg'];?>&antrianid=<?=$a['aid'];?>" class="btn btn-sm btn-success" title="Transaksi"><i class="fas fa-exchange-alt"></i></a>
                                        <?php
                                    }  
                                        ?>
                                    <a href="antrian.proses?tahap=Batal&id=<?=$a['aid'];?>" onclick="return confirm('Apa anda yakin untuk membatalkan antrian ini ?')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
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

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <h6 class="text-muted font-semibold">Barang terlaris</h6>
                        <ol class="list-group">
                            <?php 
                            $no=1;
                            $laris=mysqli_query($kon,"select *,count(klinik_trkdetail.kode) as jbk, barang.nama as namabrg FROM klinik_trkdetail join barang on klinik_trkdetail.kode=barang.kode  GROUP by klinik_trkdetail.kode  ORDER BY jbk  DESC limit 10");
                            while($l=mysqli_fetch_array($laris))
                            {
                                ?>
                                <li class="list-group-item"><?=$no;?>. <?=$l['namabrg'];?></li>    
                                <?php
                                $no++;
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>                
            </div>        
        </section>
    </div>
</div>

<?php include 'foot.php';?>