
<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Master</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Satuan</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Satuan</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" id="tsatuan" onclick="callfsatuan()"><i class="fas fa-plus-circle"></i></a>
			</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class='alert alert-success' id="info" style="display:none;">Berhasil</div>
			<div id="fsatuan" style="display: none;">
				<form method="post"  class="form-inline" id="formsatuan">
					<div class="input-group">
					<input type="text" name="satuan" class="form-control" placeholder="Nama Satuan">
						<div class="input-group-append">
							<button class="btn btn-success" id="simpansatuan"><i class="fas fa-save"></i></button>
						</div>
					</div>
				</form>
			</div>

			<div id="csatuan">
				<form method="post"  class="form-inline" id="formcsatuan">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Nama Satuan">
						<div class="input-group-append">
							<button class="btn btn-success" id="carisatuan"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if(isset($_GET['edit']))
			{
				$id=$_GET['id'];
				$sa=$_GET['sa'];
				?>	
				<div id="feditsatuan">
					<form method="post"  class="form-inline" id="formeditsatuan">
						<div class="input-group">
							<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="text" name="satuan" class="form-control" value="<?php echo $sa;?>" autofocus>
							<div class="input-group-append">
								<button class="btn btn-success" id="updsatuan"><i class="fas fa-save"></i></button>
							</div>
						</div>
					</form>
				</div>
				<?php 
			}
			?>

			<div id="satuandata" onload="loadData()"></div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script>
function callfsatuan() {
  var x = document.getElementById("fsatuan");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script type="text/javascript">
function loadData(satuan,cari) {
            $.ajax({
                url: 'satuan.data.php',
                type: 'get',
                data:{satuan:satuan},
                success: function(data) {
                    $('#satuandata').html(data);
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
                        $("#satuandata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'satuan.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#satuandata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#simpansatuan").click(function(){
			var data= $("#formsatuan").serialize();
			$.ajax({
				url:'satuan.aksi?a=save',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=satuan';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#updsatuan").click(function(){
			var data= $("#formeditsatuan").serialize();
			$.ajax({
				url:'satuan.aksi?a=edit',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=satuan';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>