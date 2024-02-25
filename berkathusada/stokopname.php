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
                                <li class="breadcrumb-item active"><a href="#" class="text-white">Stok Opname</a></li>
                            </ol>
                        </nav>
                        <h4 class="text-white">Stok Opname</h4>
                    </div>
                    <div class="col-md-6" align="right">
                        <div class="btn-group">
                            <a class="btn btn-lg text-white" id="tso" onclick="callfso()"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <?php 
                include "stokopname.input.php";
                ?>

                <div id="fso" style="display:none;">
                    <form method="post">
                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" name="tgl1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="date" name="tgl2" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="lokasi" class="form-control" required value="Gudang/Centre">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <th>No.</th>
                            <th>Kode Stok Opname</th>
                            <th>Masa SO</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </thead>
                        <?php 
                        $no=1;
                        $so=mysqli_query($kon,"select * from so_master where lokasi='Gudang/Centre' order by id desc");
                        while ($s=mysqli_fetch_array($so)) {
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$s['kode'];?></td>
                                <td><?=$s['tgl1'].' s.d '.$s['tgl2'];?></td>
                                <td><?=$s['lokasi'];?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-primary" href="stokopname.cek?so=<?=$s['kode'];?>"><i class="fas fa-plus-circle"></i></a>
                                        <a class="btn btn-sm btn-danger" href="stokopname.hapus?so=<?=$s['kode'];?>"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
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
</div>
<?php 
include "foot.php";?>
<script src="assets/js/jquery1-12.min.js"></script>
<script>
function callfso() {
  var x = document.getElementById("fso");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>