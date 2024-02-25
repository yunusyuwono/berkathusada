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
                        if($hal=='satuan')
                        {
                            $scls="btn-light border-primary";
                        }
                        else
                        {
                            $scls="btn-primary border-light";
                        }
                        if($hal=='distributor')
                        {
                            $dcls="btn-light border-primary";
                        }
                        else
                        {
                            $dcls="btn-primary border-light";
                        }
                        if($hal=='pelanggan')
                        {
                            $pcls="btn-light border-primary";
                        }
                        else
                        {
                            $pcls="btn-primary border-light";
                        }
                        if($hal=='user')
                        {
                            $ucls="btn-light border-primary";
                        }
                        else
                        {
                            $ucls="btn-primary border-light";
                        }
                    }
                    ?>
                    <a class="btn <?php echo $scls;?> btn-sm " href="?hal=labarugi" id="callSatuan"><b>Laba Rugi</b></a>
                    <a class="btn <?php echo $dcls;?> btn-sm" href="?hal=distributor" id="callDistributor"><b>Stok</b></a>
                </div>
            </div>
            <div id="konten" class="col-12">
                <?php
                switch ($_GET['hal']) {
                    case 'satuan':
                        include 'satuan.php';
                        break;
                    case 'distributor':
                        include 'distributor.php';
                        break;
                    case 'pelanggan':
                        include 'pelanggan.php';
                        break;
                    case 'user':
                        include 'user.php';
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