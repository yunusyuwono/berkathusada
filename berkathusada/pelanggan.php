
<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Master</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Pelanggan</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Pelanggan</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" id="tpelanggan" onclick="callfpelanggan()"><i class="fas fa-plus-circle"></i></a>
			</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class='alert alert-success' id="info" style="display:none;">Berhasil</div>
			<div id="fpelanggan"  style="display: none;">
				<form method="post" id="formpelanggan">
				<div class="row justify-content-center">
					<div class="form-group col-md-6">
						<label>NIK</label>
						<input type="number" name="nik" id="nik" class="form-control" placeholder="NIK" autofocus required>
					</div>
					<div class="form-group col-md-6">
						<label>Nama pelanggan</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama pelanggan" required>
					</div>
					<div class="form-group col-md-6">
						<label>Jenis Kelamin</label><br>
						<input type="radio" name="jk" id="jk" value="Laki-laki" required> Laki-laki
						<input type="radio" name="jk" id="jk" value="Perempuan" required> Perempuan
					</div>
					<div class="form-group col-md-6">
						<label>Tempat Tanggal Lahir</label>
						<div class="row">
							<div class="col-md-6">
								<input type="text" required name="tmpl" id="tmpl" class="form-control" placeholder="Tempat Lahir">
							</div>
							<div class="col-md-6">
								<input type="date" required name="tgll" id="tgll" class="form-control" >
							</div>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label>No.HP</label>
						<input type="number" required name="hp" id="hp" class="form-control" placeholder="No.HP">
					</div>
					<div class="form-group col-md-6">
						<label>Alamat</label>
						<textarea name="alamat" required id="alamat" class="form-control" placeholder="Alamat"></textarea>
					</div>

					<div class="form-group col-md-2">
						<br>
						<button class="btn btn-success btn-block" id="simpanpelanggan"><i class="fas fa-save"></i> Simpan</button>
					</div>
				</div>
				</form>
			</div>

			<div id="cpelanggan">
				<form method="post"  class="form-inline" id="formcpelanggan">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Pelanggan">
						<div class="input-group-append">
							<button class="btn btn-success" id="caripelanggan"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if(isset($_GET['edit']))
			{
				$id=$_GET['id'];
				$gd=mysqli_query($kon,"select * from pelanggan where id='$id'");
				$d=mysqli_fetch_array($gd);
				?>	
				<div id="feditpelanggan">
					<form method="post"  class="row" id="formeditpelanggan">
							<input type="hidden" name="id" value="<?php echo $id;?>">
							<div class="form-group col-md-6">
								<label>NIK</label>
								<input type="number" name="nik" id="nik" class="form-control" placeholder="NIK" autofocus required value="<?php echo $d['nik'];?>">
							</div>
							<div class="form-group col-md-6">
								<label>Nama pelanggan</label>
								<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama pelanggan" required  value="<?php echo $d['nama'];?>">
							</div>
							<div class="form-group col-md-6">
								<label>Jenis Kelamin</label><br>
								<input type="radio" name="jk" id="jk" value="Laki-laki"<?php if($d['jk']=='Laki-laki'){echo "checked"; }?> required> Laki-laki
								<input type="radio" name="jk" id="jk" value="Perempuan"<?php if($d['jk']=='Perempuan'){echo "checked"; }?> required> Perempuan
							</div>
							<div class="form-group col-md-6">
								<label>Tempat Tanggal Lahir</label>
								<div class="row">
									<div class="col-md-6">
										<input type="text" required name="tmpl" id="tmpl" class="form-control" placeholder="Tempat Lahir"  value="<?php echo $d['tmpl'];?>">
									</div>
									<div class="col-md-6">
										<input type="date" required name="tgll" id="tgll" class="form-control"  value="<?php echo $d['tgll'];?>">
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label>No.HP</label>
								<input type="number" required name="hp" id="hp" class="form-control" placeholder="No.HP" value="<?php echo $d['hp'];?>">
							</div>
							<div class="form-group col-md-6">
								<label>Alamat</label>
								<textarea name="alamat" required id="alamat" class="form-control" placeholder="Alamat"><?php echo $d['alamat'];?></textarea>
							</div>
							<div class="form-group col-md-2">
								<br>
								<button class="btn btn-success btn-block" id="updpelanggan"><i class="fas fa-save"></i> Update</button>
							</div>
					</form>
				</div>
				<?php 
			}
			?>

			<div id="pelanggandata" class="table-responsive" onload="loadData()"></div>
		</div>
	</div>
</div>
<script src="assets/js/jquery1-12.min.js"></script>
<script>
function callfpelanggan() {
  var x = document.getElementById("fpelanggan");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script type="text/javascript">
function loadData(pelanggan,cari) {
            $.ajax({
                url: 'pelanggan.data.php',
                type: 'get',
                data:{pelanggan:pelanggan},
                success: function(data) {
                    $('#pelanggandata').html(data);
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
                        $("#pelanggandata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'pelanggan.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#pelanggandata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#simpanpelanggan").click(function(){
			var data= $("#formpelanggan").serialize();
			$.ajax({
				url:'pelanggan.aksi?a=save',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=pelanggan';
				},error:function(response){
					console.log(data);
				}
			})
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#updpelanggan").click(function(){
			var data= $("#formeditpelanggan").serialize();
			$.ajax({
				url:'pelanggan.aksi?a=edit',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=pelanggan';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>