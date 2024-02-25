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
                                <li class="breadcrumb-item"><a href="#" class="text-white">Distribusi Item</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">
                                    <a href="#" class="text-white">
                                        <?php 
                                        if(isset($_GET['faktur']))
                                        {
                                            $fktr = $_GET['faktur'];
                                            echo "#".$fktr;
                                        }
                                        elseif(isset($_GET['awal']))
                                        {
                                            $awal=$_GET['awal'];
                                            $akhir=$_GET['akhir'];
                                            echo "Periode: " . $awal.' s.d '.$akhir;
                                        }
                                        ?>
                                    </a></li>
                            </ol>
                        </nav>
                    <h4 class="text-white">
                    <?php 
                                        if(isset($_GET['faktur']))
                                        {
                                            $fktr = $_GET['faktur'];
                                            echo "#".$fktr;
                                        }
                                        elseif(isset($_GET['awal']))
                                        {
                                            $awal=$_GET['awal'];
                                            $akhir=$_GET['akhir'];
                                            echo "Periode: " . $awal.' s.d '.$akhir;
                                        }
                                        ?>
                    </h4>
                    </div>
                    <div class="col-md-6" align="right">
                        <a class="btn btn-primary" href="barangdist.riwayat"><i class="fas fa-caret-left"></i> Kembali</a>
                        <a class="btn btn-primary" onclick="printDiv('cetak')"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                </div>
            </div>
            <div class="card-body" id="cetak">
            <?php 
            if(isset($fktr))
            {
                ?>
                Faktur : <?=$_GET['faktur']?><br>
                <?php 
                $gf=mysqli_fetch_array(mysqli_query($kon,"SELECT * from distbrg where nofaktur='$_GET[faktur]'"));
                echo "Entri : ".$gf['entri'];
            }
            elseif(isset($awal))
            {
                echo "Periode: " . $awal.' s.d '.$akhir;
            }
            
            ?>  
            <table class="table table-responsive table-striped table-bordered table-sm" style="font-size: 10pt;">
                <thead class="bg-primary text-white">
                    <th>Faktur</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Asal Distribusi</th>
                    <th>Tujuan Distribusi</th>
                    <th>Jumlah Distribusi</th>
                </thead>
                <?php 
                    if(isset($fktr))
                    {
                        $carifaktur=mysqli_query($kon,"SELECT * FROM distbrg_detail where faktur='$fktr'");
                    }
                    elseif(isset($awal))
                    {
                        $carifaktur=mysqli_query($kon,"SELECT * FROM distbrg_detail where faktur in (SELECT nofaktur FROM distbrg WHERE tglfaktur between '$awal' and '$akhir')");
                    }
                    while($c=mysqli_fetch_array($carifaktur))
                    {
                        $b=mysqli_fetch_array(mysqli_query($kon,"SELECT * from barang where kode='$c[kode]'"));
                        ?>
                        <tr>
                            <td style="padding:5px"><?=$c['faktur'];?></td>
                            <td style="padding:5px"><b><?=$c['kode'];?></b></td>
                            <td style="padding:5px">
                                <?=$b['nama'];?></td>
                            <td style="padding:5px"><?=$c['dari'];?></td>
                            <td style="padding:5px"><?=$c['ke'];?></td>
                            <td style="padding:5px"><?=$c['jml'];?></td>
                        </tr>
                        <?php 
                    }
                    ?>
            </table>

            <table class="table table-borderless table-responsive">
                <tr>
                    <td>Pemeriksa
                        <br/><br/><br>
                        ..........................................
                    </td>
                    <td>Penerima
                        <br/><br/><br>
                        ..........................................
                    </td>
                    <td>Admin
                        <br/><br/><br>
                        ..........................................
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>
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
include 'foot.php';
?>