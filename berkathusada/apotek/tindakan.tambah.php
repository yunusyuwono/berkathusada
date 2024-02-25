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
                    <div class="col-lg-6">
                        <h4 class="text-white">Tambah Tindakan</h4>
                    </div>
                    <div class="col-lg-6" align="right">
                        <a href="tindakan" class="btn btn-lg btn-primary"><i class="fas fa-caret-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php 
                if(isset($_POST['simpan']))
                {
                    $nama=addslashes($_POST['nama']);
                    $harga=addslashes($_POST['harga']);
                    mysqli_query($kon,"insert into tindakan (nama,harga) values ('$nama','$harga')");
                    $gj=mysqli_fetch_array(mysqli_query($kon,"select max(id) as idt from tindakan"));
                    $kode='T'.sprintf('%03s',$gj['idt']);
                    mysqli_query($kon,"update tindakan set kode='$kode' where id='$gj[idt]'");
                    ?>
                    <div class="alert alert-success">
                        Tindakan berhasil disimpan
                    </div>
                    <?php
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label>Nama Tindakan</label>
                        <input type="text" name="nama" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Tindakan</label>
                        <input type="number" name="harga" required class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
include 'foot.php';
?>