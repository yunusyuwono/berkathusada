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
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">
                                    <a href="#" class="text-white">Distribusi Item</a></li>
                            </ol>
                        </nav>
                        <?php 
            $gntrk=mysqli_query($kon,"select * from distbrg order by id desc limit 1");
            if(mysqli_num_rows($gntrk)==0)
            {
                $nofaktur="DBRG".date('Y').date('m').date('d').sprintf("%05s",1);
                $tglfaktur=date('Y-m-d');
                $sesikasir=$_SESSION['iduser'];
                mysqli_query($kon,"insert into distbrg (nofaktur,tglfaktur,idkasir,status) values ('$nofaktur','$tglfaktur','$sesikasir','proses')");
            }
            else
            {
                $g=mysqli_fetch_array($gntrk);
                if($g['status']=='proses')
                {
                    $nofaktur=$g['nofaktur'];
                }
                elseif($g['status']=='selesai')
                {
                    $nofaktur="DBRG".date('Y').date('m').date('d').sprintf("%05s",($g['id']+1));
                    $tglfaktur=date('Y-m-d');
                    $sesikasir=$_SESSION['iduser'];
                    mysqli_query($kon,"insert into distbrg (nofaktur,tglfaktur,idkasir,status) values ('$nofaktur','$tglfaktur','$sesikasir','proses')");
                    $gnnow=mysqli_fetch_array(mysqli_query($kon,"select * from distbrg where nofaktur='$nofaktur'"));
                    if($gnnow['status']=='proses')
                    {
                        $nofaktur=$gnnow['nofaktur'];
                    }
                }	
            }
            ?>
                        <h4 class="text-white">Distribusi Item #<?=$nofaktur;?></h4>
                    </div>
                    <div class="col-md-6" align="right">
                        <div class="btn-group">
                            <a class="btn btn-lg text-white" href="barang?hal=barangdist"><i class="fas fa-caret-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                
                <div class="row">
                        <form method="get" class="row">
                            <div class="col-lg-6 col-md-6">
                                <label>No. Faktur  Transaksi Masuk</label>
                                <div class="input-group">
                                <input type="text" class="form-control" placeholder="No.Faktur Transaksi Masuk" name="carifaktur" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" name="btnfaktur"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php if(isset($_GET['carifaktur']))
                        {
                            
                            ?>
                            
                            <div class="col-lg-12">
                                <div class="table-responsive mt-3">
                                    <form method="post">
                                    <table class="table table-responsive table-striped table-bordered" style="font-size: 10pt;">
                                        <thead class="bg-primary text-white">
                                            <th>Nama</th>
                                            <th>Jumlah Gudang</th>
                                            <th>Jumlah Klinik</th>
                                            <th>Jumlah Apotek</th>
                                            <th>Jumlah Praktek</th>
                                            <th>Asal Distribusi</th>
                                            <th>Tujuan Distribusi</th>
                                            <th>Jumlah Distribusi</th>
                                        </thead>
                                        <thead>
                                            <th colspan="7">
                                            <?php 
                                            if(isset($_POST['kirim2']))
                                            {
                                                $kode=$_POST['kode'];
                                                $dari=$_POST['dari'];
                                                $ke=$_POST['ke'];
                                                $beri=$_POST['beri'];

                                                foreach ($kode as $kdbrg){
                                                    if($beri[$kdbrg]!=0)
                                                    {
                                                    $simpan=mysqli_query($kon,"insert into distbrg_detail (faktur,kode,jml,dari,ke) values ('$nofaktur','$kdbrg','$beri[$kdbrg]','$dari[$kdbrg]','$ke[$kdbrg]')");
                                                    }
                                                }
                                                if($simpan)
                                                {
                                                    ?>
                                                    <div class="alert alert-success">
                                                        Berhasil
                                                    </div>
                                                    <?php	
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="alert alert-danger">
                                                        Gagal <?php echo mysqli_error($kon);?>
                                                    </div>
                                                    <?php											
                                                }
                                            }
                                            ?>
                                            </th>
                                            <th><button name="kirim2" class="btn btn-primary btn-sm">Kirim</button></th>
                                        </thead>
                                        <?php 
                                        $fktr=$_GET['carifaktur'];
                                        $carifaktur=mysqli_query($kon,"SELECT * FROM barang where nofaktur='$fktr'");
                                        while($c=mysqli_fetch_array($carifaktur))
                                        {
                                            ?>
                                            <tr>
                                                <input type="hidden" name="kode[<?=$c['kode']?>]" value="<?=$c['kode']?>">
                                                <td><b><?=$c['kode'];?></b><br/>
                                                    <?=$c['nama'];?></td>
                                                <td><?=$c['jml'];?></td>
                                                <td><?=$c['jml_klinik'];?></td>
                                                <td><?=$c['jml_apotek'];?></td>
                                                <td><?=$c['jml_praktek'];?></td>
                                                <td>
                                            <input type="radio" name="dari[<?=$c['kode'];?>]" value="Gudang" autocomplete="off" checked required>
                                            Gudang <br>
                                            <input type="radio" name="dari[<?=$c['kode'];?>]" value="Klinik" autocomplete="off" required>
                                            Klinik<br>
                                                <input type="radio" name="dari[<?=$c['kode'];?>]" value="Apotek" autocomplete="off" required>
                                            Apotek<br>
                                                <input type="radio" name="dari[<?=$c['kode'];?>]" value="Praktek" autocomplete="off" required>
                                            Praktek
                                                </td>
                                                <td>
                                                <input type="radio" name="ke[<?=$c['kode'];?>]" value="Gudang" autocomplete="off"  required>
                                            Gudang <br>
                                            <input type="radio" name="ke[<?=$c['kode'];?>]" value="Klinik" autocomplete="off" required>
                                            Klinik<br>
                                                <input type="radio" name="ke[<?=$c['kode'];?>]" value="Apotek" autocomplete="off" checked required>
                                            Apotek<br>
                                                <input type="radio" name="ke[<?=$c['kode'];?>]" value="Praktek" autocomplete="off" required>
                                            Praktek
                                                </td>
                                                <td>
                                                    <input type="number" name="beri[<?=$c['kode'];?>]" min="0" required class="form-control" value="0" style="width:100px">
                                                </td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                    </table>
                                    
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                


				</div>
            
            </div>

            <div class="card card-body mt-2">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead class="bg-primary text-white">
                            <th>#</th>
                            <th>Barang</th>
                            <th>Dari</th>
                            <th>Ke</th>
                            <th>Jumlah</th>
                        </thead>
                        <?php 
                        $dist=mysqli_query($kon,"SELECT * from distbrg_detail where faktur='$nofaktur' order by id desc");
                        $jmldist=0;
                        while ($d = mysqli_fetch_array($dist)){
                            $b=mysqli_fetch_array(mysqli_query($kon,"SELECT * from barang where kode='$d[kode]'"));
                            ?>
                            <tr>
                                <td><a href="barangdist.list.del?id=<?=$d['id'];?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
                                <td><span class="bg-success text-white" style="font-size: 8pt;padding:2pt;border-radiius:5pt"><?=$d['kode'];?></span><br>
                                    <?=$b['nama'];?>
                                </td>
                                <td>
                                    <?=$d['dari'];?>
                                </td>
                                <td>
                                    <?=$d['ke'];?>
                                </td>
                                <td>
                                    <?=$d['jml'];?>
                                </td>
                            </tr>
                            <?php
                            $jmldist=$jmldist+$d['jml'];
                        }
                        ?>
                        <tfoot>
                            <tr class="bg-primary text-white">
                            <td align="right" colspan="4">
                                Total Item Distribusi
                            </td>
                            <td>
                                <?=$jmldist;?>
                            </td>
                            </tr>   
                            <tr>
                            <td align="right" colspan="5">
                                <a href="barangdist.selesai.php?faktur=<?=$nofaktur;?>" class="btn btn-sm btn-success">Selesai</a>
                            </td>
                            </tr>   
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'foot.php';
?>
<script src="assets/js/jquery1-12.min.js"></script>
<script src="trk.js"></script>