<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Barang Masuk</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Barang Masuk</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" id="tBarangMasuk" onclick="callfBarangMasuk()"><i class="fas fa-plus-circle"></i></a>
			</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class='alert alert-success' id="info" style="display:none;">Berhasil</div>
			<div id="fBarangMasuk"  style="display: none;">
				<form method="post" action="barangmasuk.aksi?a=simpanfaktur">
				<div class="row justify-content-center">
					<div class="form-group col-md-3">
						<label>Distributor</label>
						<select class="form-control" name="dist" required autofocus>
							<option>Pilih Distributor</option>
							<?php 
							$dist=mysqli_query($kon,"select * from distributor order by nama asc");
							while ($d=mysqli_fetch_array($dist)) {
								?>
								<option value="<?php echo $d['id'];?>"><?php echo $d['nama'];?>
								<?php
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>No.Faktur</label>
						<input type="text" name="nofaktur" id="nofaktur" class="form-control" placeholder="No. Faktur" required>
					</div>
					<div class="form-group col-md-3">
						<label>Tanggal Faktur</label>
						<input type="date" name="tgl_faktur" id="tgl_faktur" class="form-control" required>
					</div>
					<div class="form-group col-md-3">
						<label>Tanggal Barang Datang</label>
						<input type="date" name="tgl_dtg" id="tgl_dtg" class="form-control" required>
					</div>
					<div class="form-group col-md-2">
						<br>
						<button class="btn btn-success btn-block" id="simpanBarangMasuk"><i class="fas fa-caret-right"></i> Lanjut</button>
					</div>
				</div>
				<hr>
				</form>
			</div>

			<div id="cBarangMasuk">
				<form method="post"  class="form-inline" id="formcBarangMasuk">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Barang Masuk">
						<div class="input-group-append">
							<button class="btn btn-success" id="cariBarangMasuk"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if(isset($_GET['edit']))
			{
				$id=$_GET['id'];
				$gd=mysqli_query($kon,"select * from barangmasuk where id='$id'");
				$d=mysqli_fetch_array($gd);
				?>	
				<div id="feditBarangMasuk">
					<form method="post"  class="row" id="formeditBarangMasuk">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<div class="form-group col-md-3">
					<label>Distributor</label>
					<select class="form-control" name="dist" required autofocus>
						<option>Pilih Distributor</option>
						<?php 
						$dist=mysqli_query($kon,"select * from distributor order by nama asc");
						while ($d=mysqli_fetch_array($dist)) {
							?>
							<option value="<?php echo $d['id'];?>"><?php echo $d['nama'];?>
							<?php
						}
						?>
					</select>
					</div>
					<div class="form-group col-md-3">
						<label>No.Faktur</label>
						<input type="text" name="nofaktur" id="nofaktur" class="form-control" placeholder="No. Faktur" required>
					</div>
					<div class="form-group col-md-3">
						<label>Tanggal Faktur</label>
						<input type="date" name="tgl_faktur" id="tgl_faktur" class="form-control" required>
					</div>
					<div class="form-group col-md-3">
						<label>Tanggal Barang Datang</label>
						<input type="date" name="tgl_dtg" id="tgl_dtg" class="form-control" required>
					</div>
					<div class="form-group col-md-2">
						<br>
						<button class="btn btn-success btn-block" id="simpanBarangMasuk"><i class="fas fa-caret-right"></i> Lanjut</button>
					</div>
					</form>
				</div>
				<?php 
			}
			?>

			<div id="BarangMasukdata" class="table-responsive" onload="loadData()"></div>
		</div>
	</div>
</div>
<script src="assets/js/jquery1-12.min.js"></script>
<script>
function callfBarangMasuk() {
  var x = document.getElementById("fBarangMasuk");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script type="text/javascript">
function loadData(BarangMasuk,cari) {
            $.ajax({
                url: 'barangmasuk.data.php',
                type: 'get',
                data:{BarangMasuk:BarangMasuk},
                success: function(data) {
                    $('#BarangMasukdata').html(data);
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
                        $("#BarangMasukdata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'barangmasuk.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#BarangMasukdata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#updBarang Masuk").click(function(){
			var data= $("#formeditBarang Masuk").serialize();
			$.ajax({
				url:'Barang Masuk.aksi?a=edit',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='barang?hal=barangmasuk';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>