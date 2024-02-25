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
                Selamat Datang User Apotek Berkat Husada
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
                                <h6 class="text-muted font-semibold">Transaksi Hari Ini</h6>
                                <?php 
                                $thi=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from apotek_trk where status='selesai' and tglfaktur='".date('Y-m-d')."'"));
                                ?>

                                <h4 class="font-extrabold mb-0"><?=$thi['jnf'];?></h4>
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
                                $thb=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from apotek_trk where status='selesai' and tglfaktur like '%".date('Y-m')."%'"));
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
                                $thh=mysqli_fetch_array(mysqli_query($kon,"select count(nofaktur) as jnf from apotek_trk where status='selesai' and tglfaktur like '%".date('Y')."%' and status_bayar='hutang'"));
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
                        <h6 class="text-muted font-semibold">Grafik Transaksi per bulan</h6>
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
                            $laris=mysqli_query($kon,"select *,count(apotek_trkdetail.kode) as jbk, barang.nama as namabrg FROM apotek_trkdetail join barang on apotek_trkdetail.kode=barang.kode  GROUP by apotek_trkdetail.kode  ORDER BY jbk  DESC limit 10");
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