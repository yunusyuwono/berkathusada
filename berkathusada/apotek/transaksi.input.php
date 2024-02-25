<?php 
include "nav.php";

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
									<?php 
									$gntrk=mysqli_query($kon,"select * from apotek_trk order by id desc limit 1");
									if(mysqli_num_rows($gntrk)==0)
									{
										$nofaktur="TBH".date('Y').sprintf("%05s",1);
										$tglfaktur=date('Y-m-d');
										$sesikasir=$_SESSION['iduser'];
										mysqli_query($kon,"insert into apotek_trk (nofaktur,tglfaktur,idkasir,status) values ('$nofaktur','$tglfaktur','$sesikasir','proses')");
									}
									else
									{
										$g=mysqli_fetch_array($gntrk);
										if($g['status']=='proses')
										{
											$nofaktur=$g['nofaktur'];
										}
										elseif($g['status']=='selesai')
										{
											$nofaktur="TBH".date('Y').sprintf("%05s",($g['id']+1));
											$tglfaktur=date('Y-m-d');
											$sesikasir=$_SESSION['iduser'];
											mysqli_query($kon,"insert into apotek_trk (nofaktur,tglfaktur,idkasir,status) values ('$nofaktur','$tglfaktur','$sesikasir','proses')");
											$gnnow=mysqli_fetch_array(mysqli_query($kon,"select * from apotek_trk where nofaktur='$nofaktur'"));
											if($gnnow['status']=='proses')
											{
												$nofaktur=$gnnow['nofaktur'];
											}
										}	
									}
									?>
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#" class="text-white">Transaksi</a></li>
										<li class="breadcrumb-item text-white" aria-current="page"><b>Transaksi Apotek</b></li>
										<li class="breadcrumb-item active text-white" aria-current="page"><b>#<?=$nofaktur;?></b></li>
									</ol>
								</nav>
								<h4 class="text-white">#<?=$nofaktur;?></h4></div>
							<div class="col-md-6" align="right">
								<div class="btn-group">
								<a class="btn btn-lg text-white" href="transaksi"><i class="fas fa-caret-left"></i> Kembali</a>
								</div>
							</div>
						</div>
					</div>
					<form method="post" id="input">
					<div class="card-body mt-2">
						<div class="row">
								<?php 
								if(isset($_POST['simpan']))
								{
									$kode=addslashes($_POST['kode']);
									$jml=addslashes($_POST['jumlah']);
									$harga=addslashes($_POST['harga']);
									$diskon=addslashes($_POST['diskon']);
									$biaya=$jml*($harga-$diskon);

									$simpan=mysqli_query($kon,"insert into apotek_trkdetail (faktur,kode,jml,harga,diskon,biaya) values ('$nofaktur','$kode','$jml','$harga','$diskon','$biaya')");
									if($simpan)
									{
										?>
										<div class="alert alert-success">
											Berhasil
										</div>
										<?php	
									}
									else
									{
										?>
										<div class="alert alert-danger">
											Gagal <?php echo mysqli_error($kon);?>
										</div>
										<?php											
									}
								}
								?>
								<div class="col-lg-6 col-md-6">
									<label>Kode Barang</label>
									<input list="barang" class="form-control" placeholder="Cari dengan Kode atau Nama Barang" onclick="reset()" name="kode" autofocus id="kode" onkeyup="isi_otomatis()" onchange="isi_otomatis()">
									<datalist id="barang">
										<?php 
										$tbarang=mysqli_query($kon,"select * from barang where status='STOK' and not jml_apotek <= 0 order by nama asc");
										while($t=mysqli_fetch_array($tbarang))
										{
											?>
											<option value="<?=$t['kode'];?>"><?=$t['kode'];?>  <?=$t['nama'];?></option>
											<?php
										}
										?>
									</datalist>
								</div>
								<div class="col-lg-6 col-md-6">
									<label>Nama Barang</label>
									<input type="text" name="nama" id="nama" class="form-control" required>
								</div>
								<div class="col-lg-6 col-md-6">
									<label>Jumlah</label>
									<input type="number" name="jumlah" id="jumlah" class="form-control" required min="0" value="0" onkeyup="cekstok()" onkeyup="hitung()" max="hitung()">
								</div>
								<div class="col-lg-6 col-md-6">
									<label>Harga</label>
									<input type="number" name="harga" id="harga" class="form-control" min="0" value="0" onkeyup="hitung()">
								</div>
								<div class="col-lg-6 col-md-6">
									<label>Diskon</label>
									<input type="number" name="diskon" id="diskon" class="form-control" min="0" value="0" onkeyup="hitung()">
								</div>
								<div class="col-lg-6 col-md-6">
									<label>Total</label>
									<input type="number" name="total" id="total" class="form-control" min="0" >
								</div>
							</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-sm btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
					</div>
					</form>	
				</div>

				<div class="card card-body">
					<div class="table-responsive">
						<?php 
						include "transaksi.data.php";
						?>
					</div>
					<div class="card-footer">
					<div class="btn-group btn-block">
						<a class="btn btn-outline-primary" href="transaksi.selesai?nofaktur=<?=$nofaktur;?>"><i class="fas fa-check"></i> Selesai Transaksi</a>
						<a class="btn btn-outline-primary" href="transaksi.selesai?nofaktur=<?=$nofaktur;?>&cetak" target="_blank"><i class="fas fa-print"></i> Selesai dan Cetak Transaksi</a>
					</div>
				</div>
				</div>

			</div>
		</section>
	</div>
</div>
<?php 
include "foot.php";
?>

<script src="../assets/js/jquery1-12.min.js"></script>
<script src="trk.js"></script>
	