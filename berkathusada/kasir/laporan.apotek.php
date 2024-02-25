<?php include "nav.php"; ?>
<div id="main">
    <header class="">
        <a href="#" class="burger-btn d-block p-2">
            <i class="fas fa-bars"></i> Menu 
        </a>
    </header> 
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-md-6">
                            Laporan Transaksi Kasir Apotek
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" class="row">
                            <div class="form-group col-md-5">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="awal" required>
                            </div>
                            <div class="form-group  col-md-5">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="akhir" required>
                            </div>
                            <div class="form-group  col-md-1" align="right">
                                <button class="btn btn-primary btn-block btn-sm mt-4" name="cari">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                            <?php
                            if(isset($_GET['awal']))
                            {
                            ?>
                            <div class="form-group  col-md-1" align="right">
                                <a class="btn btn-primary btn-block btn-sm mt-4" onclick="printDiv('cetak')">
                                    <i class="fas fa-print"></i> Cetak
                            </a>
                            </div>
                            <script type="text/javascript">
                                function printDiv(divName) {
                                var printContents = document.getElementById(divName).innerHTML;
                                var originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;

                                window.print();

                                document.body.innerHTML = originalContents;
                            }
                            </script>
                            <?php 
                            }?>
                        </form>

                        <div class="table-responsive" id="cetak">
                            <center>
                                <h4>LAPORAN TRANSAKSI APOTEK</h4>
                            </center>
                            Kasir : <?=$g['nama'];?><br>
                            <?php 
                            if(isset($_GET['awal']))
                            {
                                if($_GET['awal'] == $_GET['akhir'])
                                {
                                    $periode=$_GET['awal'];
                                }
                                else
                                {
                                    $periode=$_GET['awal'].' s.d '.$_GET['akhir'];
                                }
                                
                                ?>
                                Periode : <?=$periode;?>
                                <?php
                            }
                            ?>
                            <table class="table table-striped table-bordered table-hover" width="100%" style="font-size: 10pt;">
                                <thead class="bg-primary text-white">
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">No. Faktur</th>
                                    <th colspan="5" align="center">Detail transaksi</th>
                                </thead>
                                <thead class="bg-dark text-white">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2">Barang/Tindakan/Jasa</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Jml Biaya</th>
                                </thead>
                            
                        <?php 
                        if(isset($_GET['cari']))
                        {
                            $awal=$_GET['awal'];
                            $akhir=$_GET['akhir'];

                            $ktrk=mysqli_query($kon,"SELECT * from apotek_trk where idkasir='$_SESSION[iduser]' and tglfaktur between '$awal' and '$akhir'  and status='selesai'");
                        }
                        else
                        {
                            $ktrk=mysqli_query($kon,"SELECT * from apotek_trk where idkasir='$_SESSION[iduser]' and status='selesai'");
                        }
                        
                        $akum=0;
                        $no=1;
                        while ($k=mysqli_fetch_array($ktrk)){
                            ?>
                            <tr>
                                <td style="padding:5px"; ><?=$no;?></td>
                                <td style="padding:5px"; ><?=$k['tglfaktur'];?></td>
                                <td style="padding:5px";  colspan="6"><?=$k['nofaktur'];?></td>
                            </tr>
                            <?php
                            $ktrkd=mysqli_query($kon,"SELECT * from apotek_trkdetail where faktur='$k[nofaktur]'");
                            $total=0;
                            while ($kd=mysqli_fetch_array($ktrkd)) {
                                $gn=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM barang where kode='$kd[kode]'"));
                                $gt=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM tindakan where kode='$kd[kode]'"));
                                $gj=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM jasa where kode='$kd[kode]'"));
                                

                                if(isset($gn['kode'])){
                                    $kode=$gn['kode'];
                                    $nama=$gn['nama'];
                                }
                                elseif(isset($gt['kode'])){
                                    $kode=$gt['kode'];
                                    $nama=$gt['nama'];
                                }
                                elseif(isset($gj['kode'])){
                                    $kode=$gj['kode'];
                                    $nama=$gj['nama'];
                                }
                                else
                                {
                                    $kode=$kd['kode'];
                                    $nama='Nama tidak ditemukan';
                                }
                                ?>
                                <tr>
                                    <td style="padding:5px";  colspan="3"></td>
                                    <td style="padding:5px"; ><?=$kode;?></td>
                                    <td style="padding:5px"; ><?php if(isset($nama)){echo $nama;};?></td>
                                    <td style="padding:5px"; ><?=$kd['jml'];?></td>
                                    <td style="padding:5px";  align="right"><?=number_format($kd['harga'],0,',','.');?> (- <?=number_format($kd['diskon']/$kd['jml'],0,',','.');?>)</td>
                                    <td style="padding:5px";  align="right"><?=number_format($kd['biaya'],0,',','.');?></td>
                                </tr>
                                <?php
                                $total=$total+$kd['biaya'];
                            }
                            ?>
                            <tr class="bg-success text-white">
                                <td style="padding:5px"; ></td>
                                <td style="padding:5px";  colspan="6">Total</td>
                                <td style="padding:5px";  align="right"><?= number_format($total,0,',','.'); ?></td>
                            </tr>
                            <tr class="bg-success text-white">
                                <td style="padding:5px"; ></td>
                                <td style="padding:5px";  colspan="6">PPN 11%</td>
                                <?php 
                                if($k['ppn']=='on')
                                {
                                    $ppn = $total*11/100;
                                }
                                else
                                {
                                    $ppn=0;
                                }
                                ?>
                                <td style="padding:5px";  align="right"><?= number_format($ppn,0,',','.'); ?></td>
                            </tr>
                            <tr class="bg-success text-white">
                                <td style="padding:5px"; ></td>
                                <td style="padding:5px";  colspan="6">Biaya Admin</td>
                                <td style="padding:5px";  align="right"><?= number_format($k['admin'],0,',','.'); ?></td>
                            </tr>
                            <tr class="bg-success text-white">
                                <td style="padding:5px"; ></td>
                                <td style="padding:5px";  colspan="6">Total Pembayaran</td>
                                <?php 
                                $tp=$total+$ppn+$k['admin'];
                                ?>
                                <td style="padding:5px";  align="right"><b><?= number_format($tp,0,',','.'); ?></b></td>
                            </tr>
                            <?php


                            $akum=$akum+$tp;
                            $no++;
                        }
                        ?>
                         <tr  class="bg-primary text-white">
                                <td style="padding:5px";  colspan="7">Akumulasi Pendapatan</td>
                                <td style="padding:5px";  align="right"><?=number_format($akum,0,',','.');?></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>


    </div>
</div>
<?php include "foot.php"; ?>