<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Data Distribusi Barang</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Data Distribusi Barang</h4></div>
			<div class="col-md-6" align="right">
				<a class="btn btn-primary text-white" title="Riwayat Distribusi" href="barangdist.add"><i class="fas fa-plus-circle"></i></a>
				<a class="btn btn-primary text-white" title="Riwayat Distribusi" href="barangdist.riwayat"><i class="fas fa-scroll"></i></a>
			</div>
		</div>
	</div>
	<?php 
	include "barangdist.proses.php";
	?>
	<div class="card-body mt-2">
		<div id="cbarangdist">
				<form method="post"  class="form-inline" id="formcbarangdist">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Barang">
						<div class="input-group-append">
							<button class="btn btn-success" id="caribarangdist"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
		<div id="barangdist" class="table-responsive" onload="loadData()"></div>
	</div>
</div>
<script src="assets/js/jquery1-12.min.js"></script>
<script type="text/javascript">
function loadData(barangdist,cari) {
    $.ajax({
        url: 'barangdist.data.php',
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
                url:'barangdist.data.php',
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