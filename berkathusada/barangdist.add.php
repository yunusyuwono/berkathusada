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
                        <?php 
                        if(isset($_POST['kirim']))
                        {
                            $kode=addslashes($_POST['kode']);
                            $beri=addslashes($_POST['beri']);
                            $dari=addslashes($_POST['dari']);
                            $ke=addslashes($_POST['ke']);

                            $simpan=mysqli_query($kon,"insert into distbrg_detail (faktur,kode,jml,dari,ke) values ('$nofaktur','$kode','$beri','$dari','$ke')");
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
                        <form method="post" class="row">
                            <div class="col-lg-6 col-md-6">
                                <label>Kode Barang</label>
                                <input list="barang" class="form-control" placeholder="Cari dengan Kode atau Nama Barang" onclick="reset()" name="kode" autofocus id="kode" onkeyup="isi_otomatis()" onchange="isi_otomatis()">
                                <datalist id="barang">
                                    <?php 
                                    $tbarang=mysqli_query($kon,"select * from barang where status='STOK'  order by nama asc");
                                    while($t=mysqli_fetch_array($tbarang))
                                    {
                                        ?>
                                        <option value="<?=$t['kode'];?>"><?=$t['kode'];?>  <?=$t['nama'];?></option>
                                        <?php
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <b>Jumlah Stok saat ini :</b>
                            </div>    
                            
                            <div class="col-lg-2 col-md-2 mt-2">
                                <label>Jumlah Gudang</label>
                                <input type="number" name="jml" id="jml" class="form-control" required min="0" value="0" onkeyup="cekstok()" onkeyup="hitung()" max="hitung()" readonly>
                            </div>
                            <div class="col-lg-2 col-md-2 mt-2">
                                <label>Jumlah Klinik</label>
                                <input type="number" name="jml_klinik" id="jml_klinik" class="form-control" required min="0" value="0" onkeyup="cekstok()" onkeyup="hitung()" max="hitung()" readonly>
                            </div>
                            <div class="col-lg-2 col-md-2 mt-2">
                                <label>Jumlah Apotek</label>
                                <input type="number" name="jml_apotek" id="jml_apotek" class="form-control" required min="0" value="0" onkeyup="cekstok()" onkeyup="hitung()" max="hitung()" readonly>
                            </div>
                            <div class="col-lg-3 col-md-2 mt-2">
                                <label>Jumlah Tempat Praktek</label>
                                <input type="number" name="jml_praktek" id="jml_praktek" class="form-control" required min="0" value="0" onkeyup="cekstok()" onkeyup="hitung()" max="hitung()" readonly>
                            </div>
                            <div class="col-lg-3 col-md-2  mt-2">
                                <label>Total</label>
                                <input type="number" name="total" id="total" class="form-control" min="0" readonly>
                            </div>

                            <div class="col-lg-12 mt-3">
                            <b>Distribusi Baru :</b>
                            </div>    
                        
                            <div class="col-lg-8 mt-3">
                            Dari :
                                <div class="row">
                                        <div for="dari" class="col-3">
                                            <input type="radio" name="dari" id="dari" value="Gudang" autocomplete="off" checked required>
                                        Gudang</div>
                                        <div for="dari" class="col-3">
                                        <input type="radio" name="dari" id="dari" value="Klinik" autocomplete="off" required>
                                        Klinik</div>
                                        <div for="dari" class="col-3">
                                            <input type="radio" name="dari" id="dari" value="Apotek" autocomplete="off" required>
                                        Apotek</div>
                                        <div for="dari" class="col-3">
                                            <input type="radio" name="dari" id="dari" value="Praktek" autocomplete="off" required>
                                        Praktek</div>
                                </div>
                            </div>
                            <div class="col-lg-8 mt-3">
                            Ke :
                                <div class="row">
                                        <div for="dari" class="col-3">
                                            <input type="radio" name="ke" id="dari" value="Gudang" autocomplete="off" required>
                                        Gudang</div>
                                        <div for="dari" class="col-3">
                                        <input type="radio" name="ke" id="dari" value="Klinik" autocomplete="off" required>
                                        Klinik</div>
                                        <div for="dari" class="col-3">
                                            <input type="radio" name="ke" id="dari" value="Apotek" autocomplete="off" checked required>
                                        Apotek</div>
                                        <div for="dari" class="col-3">
                                            <input type="radio" name="ke" id="dari" value="Praktek" autocomplete="off" required>
                                        Praktek</div>

                                        
                                </div>
                            </div>
                            <div class="col-md-4">
                            Jumlah stok yang diberikan :
                            
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" name="beri" id="beri" class="form-control" min="0" onkeyup="newdist()" required >
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" name="kirim" id="kirim"><i class="fas fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
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