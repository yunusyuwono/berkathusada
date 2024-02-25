
<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Master</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Distributor</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Distributor</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" id="tdistributor" onclick="callfdistributor()"><i class="fas fa-plus-circle"></i></a>
			</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class='alert alert-success' id="info" style="display:none;">Berhasil</div>
			<div id="fdistributor"  style="display: none;">
				<form method="post" id="formdistributor">
				<div class="row justify-content-center">
					<div class="form-group col-md-3">
						<label>Nama Distributor</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama distributor" required>
					</div>
					<div class="form-group col-md-3">
						<label>No.HP</label>
						<input type="text" name="hp" id="hp" class="form-control" placeholder="No.HP">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
					</div>
					<div class="form-group col-md-2">
						<br>
						<button class="btn btn-success btn-block" id="simpandistributor"><i class="fas fa-save"></i> Simpan</button>
					</div>
				</div>
				</form>
			</div>

			<div id="cdistributor">
				<form method="post"  class="form-inline" id="formcdistributor">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Distributor">
						<div class="input-group-append">
							<button class="btn btn-success" id="caridistributor"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if(isset($_GET['edit']))
			{
				$id=$_GET['id'];
				$gd=mysqli_query($kon,"select * from distributor where id='$id'");
				$d=mysqli_fetch_array($gd);
				?>	
				<div id="feditdistributor">
					<form method="post"  class="row" id="formeditdistributor">
							<input type="hidden" name="id" value="<?php echo $id;?>">
							<div class="form-group col-md-3">
								<label>Nama Distributor</label>
								<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama distributor" required value="<?php echo $d['nama'];?>" autofocus>
							</div>
							<div class="form-group col-md-3">
								<label>No.HP</label>
								<input type="text" name="hp" id="hp" class="form-control" placeholder="No.HP"  value="<?php echo $d['hp'];?>">
							</div>
							<div class="form-group col-md-4">
								<label>Alamat</label>
								<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat"  value="<?php echo $d['alamat'];?>">
							</div>
							<div class="form-group col-md-2">
								<br>
								<button class="btn btn-success btn-block" id="upddistributor"><i class="fas fa-save"></i> Update</button>
							</div>
					</form>
				</div>
				<?php 
			}
			?>

			<div id="distributordata" class="table-responsive" onload="loadData()"></div>
		</div>
	</div>
</div>
<script src="assets/js/jquery1-12.min.js"></script>
<script>
function callfdistributor() {
  var x = document.getElementById("fdistributor");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script type="text/javascript">
function loadData(distributor,cari) {
            $.ajax({
                url: 'distributor.data.php',
                type: 'get',
                data:{distributor:distributor},
                success: function(data) {
                    $('#distributordata').html(data);
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
                        $("#distributordata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'distributor.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#distributordata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#simpandistributor").click(function(){
			var data= $("#formdistributor").serialize();
			$.ajax({
				url:'distributor.aksi?a=save',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=distributor';
				},error:function(response){
					console.log(data);
				}
			})
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#upddistributor").click(function(){
			var data= $("#formeditdistributor").serialize();
			$.ajax({
				url:'distributor.aksi?a=edit',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=distributor';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>