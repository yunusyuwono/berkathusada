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
                                 <a class="btn btn-primary" href="berobat?id=<?=$idp;?>"><i class="fas fa-caret-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-2">
                        <?php 
                        if(isset($_POST['simpan']))
                        {
                            $entri=date('Y-m-d');
                            $layanan=addslashes($_POST['layanan']);
                            $layanan2=addslashes($_POST['layanan2']);
                            $jumlah=$_POST['jumlah'];
                            
                            $simpan=mysqli_query($kon,"insert into rtj (idpelanggan,layanan,idlayanan,jumlah,entri) values ('$idp','$layanan','$layanan2','$jumlah','$entri')");
                            if($simpan)
                            {
                                ?>
                                <div class="alert alert-success">
                                    Layanan berhasil disimpan
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">
                                    Layanan gagal disimpan . <?=mysqli_error($kon);?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <form method="post">
                            <div class="form-group">

                                <label>Pilih Jenis Layanan</label>
                                <select class="form-control" name="layanan" id="layanan">
                                    <option value="">Pilih Jenis Layanan</option>
                                    <option value="jasa">Jasa</option>
                                    <option value="tindakan">Tindakan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="layanan2" id="layanan2" class="form-control" required>
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="jumlah" name="jumlah" style="display: none;">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>No.</th>
                                    <th>Jenis Layanan</th>
                                    <th>Layanan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </thead>
                                <?php 
                                $grtj=mysqli_query($kon,"SELECT * from rtj where idpelanggan='$idp' and entri='".date('Y-m-d')."' order by layanan asc");
                                $no=1;
                                while ($g=mysqli_fetch_array($grtj)) {
                                    if($g['layanan']=='jasa')
                                    {
                                        $q = mysqli_fetch_array(mysqli_query($kon, "select * from jasa where id='$g[idlayanan]'"));
                                    }
                                    elseif($g['layanan']=='tindakan')
                                    {
                                        $q = mysqli_fetch_array(mysqli_query($kon, "select * from tindakan where id='$g[idlayanan]'"));
                                    }
                                    ?>
                                    <tr>
                                    <td><?=$no;?></td>
                                    <td><?=$g['layanan'];?></td>
                                    <td><?=$q['nama'];?></td>
                                    <td><?=$g['jumlah'];?></td>
                                    <td><a href="berobat.jasatindakan.hapus?id=<?=$g['id'];?>&idp=<?=$idp;?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i></a></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#layanan').change(function(){
            var layanan=$(this).val();

            $.ajax({
                type    :'GET',
                url     :'gettj.php',
                data    :'jenislayanan='+layanan,
                success: function(response){
                    $('#layanan2').html(response);
                }
            });

            if($(this).val()=="tindakan"){
                $('#jumlah').show();
                $('#jumlah').attr('required','');
                $('#jumlah').attr('placeholder','Jumlah Tindakan');
            }
            else
            {
                $('#jumlah').hide();   
            }
        })
    });
</script>