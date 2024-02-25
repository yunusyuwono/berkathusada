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
                        <h4 class="text-white">Antrian</h4>
                    </div>
                    <div class="col-lg-6" align="right">
                        <a href="antrian.tambah" class="btn btn-lg btn-primary"><i class="fas fa-plus-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                        $antri=mysqli_query($kon,"select *,antrian.id as aid,pelanggan.nama as namaplg, pelanggan.kode as kodeplg from antrian join pelanggan on antrian.kodepasien=pelanggan.kode order by antrian.tgl desc");
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
                                        ?>
                                        <div class="bg-success p-1 text-white"><b><?=$a['status'];?></b></div>
                                        <?php
                                    }
                                    elseif($a['status']=='Dokter')
                                    {
                                        ?>
                                        <div class="bg-info p-1 text-white"><b><?=$a['status'];?></b></div>
                                        <?php
                                    }
                                    elseif($a['status']=='Apotek')
                                    {
                                        ?>
                                        <div class="bg-warning p-1 text-black"><b><?=$a['status'];?></b></div>
                                        <?php
                                    }
                                    elseif($a['status']=='Batal')
                                    {
                                        ?>
                                        <div class="bg-danger p-1 text-white"><b><?=$a['status'];?></b></div>
                                        <?php
                                    }
                                    elseif($a['status']=='Selesai')
                                    {
                                        ?>
                                        <div class="bg-info p-1 text-white"><b><?=$a['status'];?></b></div>
                                        <?php
                                    }
                                    ?>
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
                            if($a['status']=='Dokter')
                            {
                                ?>
                                <tr class="alert-success text-white">
                                    <td><i class="fas fa-chevron-circle-right"></i></td>
                                    <td colspan="6"><b>Ditangani oleh : </b>. Poli : </td>
                                </tr>
                                <?php
                            }

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