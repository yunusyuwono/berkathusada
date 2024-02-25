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
                <div class="btn-group btn-block">
                    <?php 
                    if(isset($_GET['hal']))
                    {
                        $hal=$_GET['hal'];
                        if($hal=='barangall')
                        {
                            $scls="btn-light border-primary";
                        }
                        else
                        {
                            $scls="btn-primary border-light";
                        }
                        if($hal=='barangmasuk')
                        {
                            $mcls="btn-light border-primary";
                        }
                        else
                        {
                            $mcls="btn-primary border-light";
                        }
                        if($hal=='baranged')
                        {
                            $dcls="btn-light border-primary";
                        }
                        else
                        {
                            $dcls="btn-primary border-light";
                        }
                        if($hal=='barangdist')
                        {
                            $pcls="btn-light border-primary";
                        }
                        else
                        {
                            $pcls="btn-primary border-light";
                        }
                    }
                    ?>
                    <a class="btn <?php echo $mcls;?> btn-sm" href="?hal=barangmasuk" id="callBrgmasuk"><b>Barang Masuk</b></a>
                    <a class="btn <?php echo $scls;?> btn-sm" href="?hal=barangall" id="callDatabarang"><b>Data Barang</b></a>
                    <a class="btn <?php echo $dcls;?> btn-sm" href="?hal=baranged" id="callBarangED"><b>Barang Kadaluarsa</b></a>
                    <a class="btn <?php echo $pcls;?> btn-sm" href="?hal=barangdist" id="callDistribusi"><b>Distribusi</b></a>
                </div>
            </div>
            <div id="konten" class="col-12">
                <?php
                switch ($_GET['hal']) {
                    case 'barangmasuk':
                        include 'barangmasuk.php';
                        break;
                    case 'barangall':
                        include 'barangall.php';
                        break;
                    case 'baranged':
                        include 'baranged.php';
                        break;
                    case 'barangdist':
                        include 'barangdist.php';
                        break;
                    default:
                        echo "Pilih menu di atas";
                        break;
                }
                ?>
            </div>
        </section>
    </div>
</div>

<?php include 'foot.php';?>