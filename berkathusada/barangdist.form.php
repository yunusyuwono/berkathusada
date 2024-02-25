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
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="#" class="text-white">Distribusi Item</a></li>
                            </ol>
                        </nav>
                        <?php 
                        $idb=$_GET['idb'];
                        $gb=mysqli_fetch_array(mysqli_query($kon,"select * from barang where id='$idb'"));

                        ?>
                        <h4 class="text-white"><?=$gb['nama'];?></h4>
                    </div>
                    <div class="col-md-6" align="right">
                        <div class="btn-group">
                            <a class="btn btn-lg text-white" href="barang?hal=barangdist"><i class="fas fa-caret-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
            	<?php 
            	if(isset($_POST['update']))
            	{
            		$idb=$_POST['id'];
            		$dari=$_POST['dari'];
            		$jt=addslashes($_POST['jt']);
            		$ke=$_POST['ke'];
            		$ja=addslashes($_POST['ja']);
            		$tgl=addslashes($_POST['tgl']);

            		if($dari=='center')
					{
					    $jdari=$gb['jml'];
					}
					elseif($dari=='apotek')
					{
					    $jdari=$gb['jml_apotek'];
					}
					elseif($dari=='klinik')
					{
					    $jdari=$gb['jml_klinik'];
					}

					if($ke=='center')
					{
					    $jke=$gb['jml'];
					}
					elseif($ke=='apotek')
					{
					    $jke=$gb['jml_apotek'];
					}
					elseif($ke=='klinik')
					{
					    $jke=$gb['jml_klinik'];
					}

					$jsisa=$jdari-$ja;
					$jtotal=$jke+$ja;

					if($ja > $jt)
					{
						?>
						<script type="text/javascript">
							alert('Jumlah tidak sesuai');
						</script>
						<?php
					}
					else
					{
						$upd=mysqli_query($kon,"insert into barangdist (idbrg,dari,ke,jml,entri) values ('$idb','$dari','$ke','$ja','$tgl')");
						if($upd)
						{
							if($dari=='center')
							{
							    mysqli_query($kon,"update barang set jml='$jsisa' where id='$idb'");
							}
							elseif($dari=='apotek')
							{
							    mysqli_query($kon,"update barang set jml_apotek='$jsisa' where id='$idb'");
							}
							elseif($dari=='klinik')
							{
							    mysqli_query($kon,"update barang set jml_klinik='$jsisa' where id='$idb'");
							}

							if($ke=='center')
							{
							    mysqli_query($kon,"update barang set jml='$jtotal' where id='$idb'");
							}
							elseif($ke=='apotek')
							{
							    mysqli_query($kon,"update barang set jml_apotek='$jtotal' where id='$idb'");
							}
							elseif($ke=='klinik')
							{
							    mysqli_query($kon,"update barang set jml_klinik='$jtotal' where id='$idb'");
							}
							?>
							<div class="alert alert-success">
								Distribusi barang berhasil
							</div>
							<?php
						}
						else
						{
							?>
							<div class="alert alert-danger">
								Distribusi barang gagal
							</div>
							<?php	
						}
					}
            	}

            	?>
            	<form method="post">
            	<div class="row">
            	
					<input type="hidden" name="id" value="<?=$gb['id'];?>">
					<div class="form-group col-md-6">
						<label>Dari</label>
						<select name="dari" id="dari" class="form-control" onload="dist()" onclick="dist()" onkeyup="dist()">
							<option> --- Pilih Sumber Pengiriman ---</option>
							<option value="center">Gudang/Center</option>
							<option value="apotek">Apotek</option>
							<option value="klinik">Klinik</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label id="labeldari">Jumlah </label>
						<input type="number" class="form-control" id="jt" name="jt" value="0" readonly>
					</div>
					<div class="form-group  col-md-6">
						<label>Ke</label>
						<select name="ke" id="ke" class="form-control" onkeyup="dist()">
							<option> --- Pilih Tujuan Pengiriman ---</option>
							<option value="center">Gudang/Center</option>
							<option value="apotek">Apotek</option>
							<option value="klinik">Klinik</option>
						</select>
					</div>
					<div class="form-group  col-md-6">
						<label id="labelke">Jumlah </label>
						<input type="number" class="form-control" id="ja" name="ja" value="0" min="0" onkeyup="selisih()" onclick="selisih()">
						<label>Sisa</label>
						<input type="number" class="form-control" id="sisa" name="sisa" readonly>

						<label>Tanggal</label>
						<input type="date" class="form-control"  name="tgl" value="<?=date('Y-m-d');?>">
						<br>
						<button class="btn btn-primary btn-sm" id="update" name="update"><i class="fas fa-save"></i> Update</button>
					</div>

					
					
				
				</div>
				</form>
            </div>
        </div>
    </div>
</div>
<?php 
include 'foot.php';
?>
<script src="assets/js/jquery1-12.min.js"></script>
<script type="text/javascript">
	function dist() {
		var dari 	= $('#dari').val();
		$.ajax({
            url: 'getbarang.dist.php',
            data:"kode="+'<?=$gb['kode'];?>'+"&dari="+dari,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#jt').val(obj.jdari);

        });
	}

	function selisih(){
		var jt 	= $('#jt').val();
		var ja 	= $('#ja').val();
		var sisa= jt-ja;
		$('#sisa').val(sisa);
	}
</script>