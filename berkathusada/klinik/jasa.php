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
                        <h4 class="text-white">Jasa</h4>
                    </div>
                    <div class="col-lg-6" align="right">
                        <a href="jasa.tambah" class="btn btn-lg btn-primary"><i class="fas fa-plus-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2">
                    <table class="table table-responsive table-striped table-bordered table-hover">
                        <thead>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </thead>
                        <?php 
                        if(isset($_GET['cari']))
                        {
                            $cari=$_GET['cari'];
                            $gjasa=mysqli_query($kon,"select * from jasa where kode like '%$cari%' or nama like '%$cari%'");
                        }
                        else
                        {
                            $gjasa=mysqli_query($kon,"select * from jasa order by nama asc");   
                        }
                        $no=1;
                        while($j=mysqli_fetch_array($gjasa))
                        {
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$j['kode'];?></td>
                                <td><?=$j['nama'];?></td>
                                <td><?=$j['harga'];?></td>
                                <td><a href="jasa.hapus?id=<?=$j['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
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
include 'foot.php';
?>