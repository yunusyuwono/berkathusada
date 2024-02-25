<?php 
include 'nav.php';

$so=$_GET['so'];
$g=mysqli_fetch_array(mysqli_query($kon,"select * from so_master where kode='$so'"));
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
                                <li class="breadcrumb-item"><a href="#" class="text-white">Stok Opname</a></li>
                                <li class="breadcrumb-item active"><a href="#" class="text-white"><?=$so;?></a></li>
                            </ol>
                        </nav>
                        <h4 class="text-white">Stok Opname #<?=$so;?></h4>
                    </div>
                    <div class="col-md-6" align="right">
                        <div class="btn-group">
                            <a class="btn btn-lg text-white" href="stokopname"><i class="fas fa-caret-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <?php 
                if(isset($_POST['kirim']))
                {
                    $kode=$_POST['kode'];
                    $jmlr=addslashes($_POST['jmlr']);
                    $ket=addslashes($_POST['ket']);
                    
                    $cos=mysqli_fetch_array(mysqli_query($kon,"select * from so_cek where kode='$so' and kodebarang='$kode'"));
                    if(!empty($cos['stokreal']))
                    {
                    $simpan=mysqli_query($kon,"update so_cek set stokreal='$jmlr',ket='$ket' where id='$cos[id]'");                        
                    }
                    else
                    {
                    $simpan=mysqli_query($kon,"insert into so_cek (kode,kodebarang,stokreal,ket) values('$so','$kode','$jmlr','$ket')");
                    }

                    if($simpan)
                    {
                        mysqli_query($kon,"UPDATE barang set jml='$jmlr' where kode='$kode'");
                    ?>
                    <div class="alert alert-success">
                        Berhasil disimpan
                    </div>
                    <?php
                    }
                    elseif($simpan)
                    {
                    ?>
                    <div class="alert alert-success">
                        Gagal disimpan
                    </div>
                    <?php
                    }
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-responsive">
                        <thead>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jumlah Stok</th>
                            <th>Kadaluarsa</th>
                            <th>Jumlah Stok Real</th>
                            <th>Selisih</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </thead>
                        <?php 
                        
                        $no=1;
                        $barang=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
                        while ($b=mysqli_fetch_array($barang)) {
                            if($g['lokasi']=='Gudang/Centre')
                            {
                                $jumlah=$b['jml'];    
                            }
                            elseif($g['lokasi']=='Apotek')
                            {
                                $jumlah=$b['jml_apotek'];    
                            }
                            elseif($g['lokasi']=='Klinik')
                            {
                                $jumlah=$b['jml_klinik'];    
                            }
                           
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$b['kode'];?></td>
                                <td><?=$b['nama'];?></td>
                                <td><?=$jumlah;?></td>
                                <td><?=$b['ed'];?></td>
                                <?php 
                                $cso=mysqli_fetch_array(mysqli_query($kon,"select * from so_cek where kodebarang='$b[kode]' and kode='$so'"));
                                if(!isset($cso['stokreal']))
                                {
                                    ?>
                                    <td colspan="3">Belum ada data</td>
                                    <?php
                                }
                                else
                                {                                
                                ?>
                                <td><?=$cso['stokreal'];?></td>
                                <td><?=$jumlah-$cso['stokreal'];?></td>
                                <td><?=$cso['ket'];?></td> 
                                <?php }
                                ?>
                                <td>
                                    <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#input<?=$b['id'];?>"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="input<?=$b['id'];?>">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">Form Stok Barang Fisik (<?=$b['nama'];?>)</div>
                                          <div class="modal-body">
                                              <form method="post">
                                                <div class="form-group">
                                                    <input type="hidden" name="kode" value="<?=$b['kode'];?>">
                                                    <label>Jumlah Stok Real</label>
                                                    <input type="number" name="jmlr" class="form-control" min="0" value="0">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="ket" placeholder="Keterangan"></textarea>
                                                </div>
                                                    <button class="btn btn-primary" name="kirim"><i class="fas fa-paper-plane"></i></button>
                                                </form>
                                            </div>
                                      </div>
                                  </div>
                              </div>  

                            <?php
                            $no++;
                        }
                        ?>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'foot.php';
?>