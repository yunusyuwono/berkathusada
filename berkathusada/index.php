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
            <div class="col-12">
                <div class="card card-body text-dark">
                Selamat Datang Admin Center Klinik Pratama Mustika
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Transaksi Hari Ini</h6>
                                <h4 class="font-extrabold mb-0"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Transaksi Bulan Ini</h6>
                                <h4 class="font-extrabold mb-0"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-primary">
                                    <i style="font-size:36pt" class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Transaksi Piutang</h6>
                                <h4 class="font-extrabold mb-0"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                

                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <h6 class="text-dark font-semibold">Laporan Pemasukan</h6><hr>
                        <label>Atur Tanggal</label>
                        <div class="input-group">
                            <div class="form-group">

                                <input type="date" class="form-control form-control-sm" id="sp" name="sp" value="<?=date('Y-m-d');?>">
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-sm btn-primary" id="spcari" name="spcari" onclick="lpcari()"><i class="fas fa-calendar"></i> Cari</a>
                            </div>
                        </div>
                        
                        <div id="lp"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <h6 class="text-muted font-semibold">Barang terlaris</h6>
                        <ol class="list-group">
                            <li class="list-group-item"></li>
                        </ol>
                    </div>
                </div>
            </div>                
            </div>        
        </section>
    </div>
</div>

<?php include 'foot.php';?>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
function lpcari(){
    sp  = $('#sp').val();
    $('#lp').html('<i class="fas fa-spinner fa-pulse"></i>');
    $.ajax({
        url : 'laporan.harian.php',
        method : 'POST',
        data : {sp:sp},
        success: function(data){
            $('#lp').html(data);
        }
    })
}

$(document).ready(function(){
    lpcari();
})

</script>