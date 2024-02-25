<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Master</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Poli</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Poli</h4></div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" id="tpoli" onclick="callfpoli()"><i class="fas fa-plus-circle"></i></a>
			</div>
			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class='alert alert-success' id="info" style="display:none;">Berhasil</div>
			<div id="fpoli" style="display: none;">
				<form method="post"  class="form-inline" id="formpoli">
					<div class="input-group">
					<input type="text" name="poli" class="form-control"  style="width:50%" placeholder="Nama Poli">
                        <div class="input-group-append">
							<select class="form-control" name="dokter">
                                <option>Pilih Dokter</option>
                                <?php 
                                $cd=mysqli_query($kon,"select * from user where status like '%Dokter%'");
                                while($d=mysqli_fetch_array($cd))
                                {
                                    ?>
                                    <option value="<?=$d['id'];?>"><?=$d['gelar1'].'. '.$d['nama'].', '.$d['gelar2'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
						</div>
                        <div class="input-group-append">
							<button class="btn btn-success" id="simpanpoli"><i class="fas fa-save"></i></button>
						</div>
					</div>
				</form>
			</div>

			<div id="cpoli">
				<form method="post"  class="form-inline" id="formcpoli">
					<div class="input-group">
					<input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Nama Poli">
						<div class="input-group-append">
							<button class="btn btn-success" id="caripoli"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if(isset($_GET['edit']))
			{
				$id=$_GET['id'];
				$sa=$_GET['sa'];
                $gp=mysqli_fetch_array(mysqli_query($kon,"select * from poli where id='$id'"));
				?>	
				<div id="feditpoli">
					<form method="post"  class="form-inline" id="formeditpoli">
						<div class="input-group">
							<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="text" name="poli" class="form-control" value="<?php echo $sa;?>" autofocus>
						<div class="input-group-append">
							<select class="form-control" name="dokter">
                                <option>Pilih Dokter</option>
                                <?php 
                                $cd=mysqli_query($kon,"select * from user where status like '%Dokter%'");
                                while($d=mysqli_fetch_array($cd))
                                {
                                    ?>
                                    <option value="<?=$d['id'];?>" <?php if($gp['iddokter']==$d['id']){echo "selected";} ?> ><?=$d['gelar1'].'. '.$d['nama'].', '.$d['gelar2'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
						</div>	
                        <div class="input-group-append">
								<button class="btn btn-success" id="updpoli"><i class="fas fa-save"></i></button>
							</div>
						</div>
					</form>
				</div>
				<?php 
			}
			?>

			<div id="polidata" onload="loadData()"></div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script>
function callfpoli() {
  var x = document.getElementById("fpoli");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script type="text/javascript">
function loadData(poli,cari) {
            $.ajax({
                url: 'poli.data.php',
                type: 'get',
                data:{poli:poli},
                success: function(data) {
                    $('#polidata').html(data);
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
                        $("#polidata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'poli.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#polidata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#simpanpoli").click(function(){
			var data= $("#formpoli").serialize();
			$.ajax({
				url:'poli.aksi?a=save',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=poli';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#updpoli").click(function(){
			var data= $("#formeditpoli").serialize();
			$.ajax({
				url:'poli.aksi?a=edit',
				type:'post',
				data:data,
				success:function(data){
					alert(data);
					window.location='master?hal=poli';
				},error:function(response){
					console.log(response.responseText);
				}
			})
		})
	})
</script>