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
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Transaksi</a></li>
						<li class="breadcrumb-item active text-white" aria-current="page"><b>Transaksi Klinik</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Transaksi Klinik</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" href="transaksi.input"><i class="fas fa-plus-circle"></i></a>
				<a class="btn btn-lg text-white" href="transaksi.rekap"><i class="fas fa-print"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
			<div id="cTransaksi" class="jus">
				<form method="post"  class="form-inline" id="formcTransaksi">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Transaksi">
						<div class="input-group-append">
							<button class="btn btn-success" id="cariTransaksi"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			

			<div id="Transaksidata" class="table-responsive" onload="loadData()"></div>
		</div>
	</div>
</div>


        </section>
    </div>
</div>
<?php include "foot.php";?>
<script src="../assets/js/jquery1-12.min.js"></script>

<script type="text/javascript">
function loadData(Transaksi,cari) {
            $.ajax({
                url: 'transaksi.list.php',
                type: 'get',
                data:{Transaksi:Transaksi},
                success: function(data) {
                    $('#Transaksidata').html(data);
                }
            });
        }
        
  $(document).ready(function() {
		loadData();
	})
  </script>

   <script>
                $(document).ready(function(e)
                {
                    $("#cari").keyup(function()
                    {
                        $("#Transaksidata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'transaksi.list.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#Transaksidata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>