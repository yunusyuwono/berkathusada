<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Master</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>User</b></li>
					</ol>
				</nav>
				<h4 class="text-white">User</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" id="tuser" onclick="callfuser()"><i class="fas fa-plus-circle"></i></a>
				
			</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class='alert alert-success' id="info" style="display:none;">Berhasil</div>
			<div id="fuser"  style="display: none;">
				<form method="post" id="formuser">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Gelar Depan Nama</label>
						<input type="text" name="gelar1" id="gelar1" class="form-control" placeholder="(Kosongkan jika tidak ada)">
					</div>
					<div class="form-group col-md-4">
						<label>Nama </label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama user" required>
					</div>
					<div class="form-group col-md-4">
						<label>Gelar Belakang Nama</label>
						<input type="text" name="gelar2" id="gelar2" class="form-control" placeholder="Gelar Belakang Nama">
					</div>
					<div class="form-group col-md-4">
						<label>Jabatan</label>
						<input type="text" name="jabatan" id="jabatan" class="form-control">
					</div>
					
					<div class="form-group col-md-6">
						<label>Tanggal Lahir</label>
						<input type="date" required name="tgll" id="tgll" class="form-control" >
					</div>
					<div class="form-group col-md-6">
						<label>No.HP</label>
						<input type="number" required name="hp" id="hp" class="form-control" placeholder="No.HP" onkeypress="genpass();">
					</div>
					<div class="form-group col-md-6">
						<label>Email</label>
						<input type="email" required name="email" id="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group col-md-2">
						<br>
						<button class="btn btn-success btn-block" id="simpanuser"><i class="fas fa-save"></i> Simpan</button>
					</div>
				</div>
				</form>
			</div>

			<div id="cuser">
				<form method="post"  class="form-inline" id="formcuser">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari user">
						<div class="input-group-append">
							<button class="btn btn-success" id="cariuser"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if(isset($_GET['edit']))
			{
				$id=$_GET['id'];
				$gd=mysqli_query($kon,"select * from user where id='$id'");
				$d=mysqli_fetch_array($gd);
				?>	
				<div id="fedituser">
					<form method="post"  class="row" id="formedituser">
							<input type="hidden" name="id" value="<?php echo $id;?>">
							<div class="form-group col-md-4">
								<label>Gelar Depan Nama</label>
								<input type="text" name="gelar1" id="gelar1" class="form-control" value="<?php echo $d['gelar1'];?>">
							</div>
							<div class="form-group col-md-4">
								<label>Nama </label>
								<input type="text" name="nama" id="nama" class="form-control"  value="<?php echo $d['nama'];?>" required>
							</div>
							<div class="form-group col-md-4">
								<label>Gelar Belakang Nama</label>
								<input type="text" name="gelar2" id="gelar2" class="form-control" value="<?php echo $d['gelar2'];?>">
							</div>
							<div class="form-group col-md-4">
								<label>Jabatan</label>
								<input type="text" name="jabatan" id="jabatan" class="form-control" value="<?php echo $d['jabatan'];?>">
							</div>
							
							<div class="form-group col-md-6">
								<label>Tanggal Lahir</label>
								<input type="date" required name="tgll" id="tgll" class="form-control"  value="<?php echo $d['tgll'];?>" >
							</div>
							<div class="form-group col-md-6">
								<label>No.HP</label>
								<input type="number" required name="hp" id="hp" class="form-control" value="<?php echo $d['nohp'];?>">
							</div>
							<div class="form-group col-md-6">
								<label>Email</label>
								<input type="email" required name="email" id="email" class="form-control"  value="<?php echo $d['email'];?>">
							</div>
							<div class="form-group col-md-2">
								<br>
								<button class="btn btn-success btn-block" id="upduser"><i class="fas fa-save"></i> Update</button>
							</div>
					</form>
				</div>
				<?php 
			}
			if(isset($_GET['gaji']))
			{
				$id=$_GET['id'];
				$gd=mysqli_query($kon,"select * from user where id='$id'");
				$d=mysqli_fetch_array($gd);
				?>	
				<div id="fedituser">
					<form method="post"  class="row" id="formgajiuser">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<div class="form-group col-md-4">
							<label>Gaji per bulan untuk <?=$d['gelar1'].$d['nama'].$d['gelar2'];?></label>
							<input type="text" name="gaji" id="gaji" class="form-control" value="<?php echo $d['gaji'];?>">
						</div>
						<div class="form-group col-md-4">
							<label>Insentif per bulan untuk <?=$d['gelar1'].$d['nama'].$d['gelar2'];?></label>
							<input type="text" name="insentif" id="insentif" class="form-control" value="<?php echo $d['insentif'];?>">
						</div>
						<div class="form-group col-md-2">
							<br>
							<button class="btn btn-success btn-block" id="updgaji"><i class="fas fa-save"></i> Update</button>
						</div>
					</form>
				</div>
			<?php 
			}
			?>

			<div id="userdata" class="table-responsive" onload="loadData()"></div>
		</div>
	</div>
</div>
<script src="assets/js/jquery1-12.min.js"></script>
<script>
function callfuser() {
  var x = document.getElementById("fuser");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script type="text/javascript">
function loadData(user,cari) {
            $.ajax({
                url: 'user.data.php',
                type: 'get',
                data:{user:user},
                success: function(data) {
                    $('#userdata').html(data);
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
                        $("#userdata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'user.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#userdata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#simpanuser").click(function(){
			var data= $("#formuser").serialize();
			$.ajax({
				url:'user.aksi?a=save',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=user';
				},error:function(response){
					console.log(data);
				}
			})
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#upduser").click(function(){
			var data= $("#formedituser").serialize();
			$.ajax({
				url:'user.aksi?a=edit',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=user';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#updgaji").click(function(){
			var data= $("#formgajiuser").serialize();
			$.ajax({
				url:'user.aksi?a=gaji',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=user';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>