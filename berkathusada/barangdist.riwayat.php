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
										<li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
										<li class="breadcrumb-item"><a href="#" class="text-white">Distribusi Barang</a></li>
										<li class="breadcrumb-item active  text-white" aria-current="page"><b>Riwayat Distribusi</b></li>
									</ol>
								</nav>
								<h4 class="text-white">Data Riwayat Distribusi</h4></div>
							<div class="col-md-6" align="right">
								<a class="btn btn-primary text-white" title="Riwayat Distribusi" href="barang?hal=barangdist"><i class="fas fa-caret-left"></i> Kembali</a>
								
							</div>
						</div>
					</div>
					<!-- Modal -->

					<?php 
					include "barangdist.proses.php";
					?>
					<div class="card-body mt-2">
					<form class="row" method="get" action="barangdist.riwayat.detail">
						<div class="form-group col-md-5">
							<label for="">Tanggal Awal</label>
							<input type="date" class="form-control" required name="awal">
						</div>
						<div class="form-group  col-md-5">
							<label for="">Tanggal Akhir</label>
							<input type="date" class="form-control" required name="akhir">
						</div>
						<div class="form-group col-md-2">
						<button class="btn btn-primary btn-block mt-4 text-white"><i class="fas fa-calendar-alt"></i> Set Periode</button>
						</div>
					</form>
						<div id="cbarangdist">
								<form method="post"  class="form-inline" id="formcbarangdist">
									<div class="input-group">
									<input type="text" name="cari" id="cari" class="form-control" placeholder="No Faktur">
										<div class="input-group-append">
											<button class="btn btn-success" id="cari" name="cari"><i class="fas fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
						<div id="barangdist" class="table-responsive" onload="loadData()"></div>
					</div>
				</div>
				</div>
        </section>
    </div>
</div>




<?php include 'foot.php';?>
				<script src="assets/js/jquery1-12.min.js"></script>
				<script type="text/javascript">
				function loadData(barangdist,cari) {
					$.ajax({
						url: 'barangdist.riwayat.data.php',
						type: 'get',
						data:{barangdist:barangdist},
						success: function(data) {
							$('#barangdist').html(data);
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
						$("#barangdist").show();
						var x = $(this).val();
						$.ajax(
							{
								type:'GET',
								url:'barangdist.riwayat.data.php',
								data: 'cari='+x,
								success:function(data)
								{
									$("#barangdist").html(data);
								}
								,
							});
					});
				});
				</script>