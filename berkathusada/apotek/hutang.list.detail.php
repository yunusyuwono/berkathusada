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
<?php 
$nofaktur=$_GET['nofaktur'];
?>
	<div class="row">
			<div class="col-md-8">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Hutang</a></li>
						<li class="breadcrumb-item" aria-current="page"><b>Detail Transaksi Apotek</b></li>
						<li class="breadcrumb-item active text-white" aria-current="page"><b>#<?=$nofaktur;?></b></li>
					</ol>
				</nav>
				<h4 class="text-white">#<?=$nofaktur;?></h4></div>
			<div class="col-md-4" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" href="hutang"><i class="fas fa-caret-left"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-responsive table-striped table-hover table-bordered" width="100%">
			<thead class="bg-primary text-white">
				<th width="5%">#</th>
				<th width="40%">Barang</th>
				<th>Harga</th>
				<th>Diskon</th>
				<th>Jumlah</th>
				<th>Biaya</th>
			</thead>
			<tbody>
			<?php 
			$gn=mysqli_fetch_array(mysqli_query($kon,"select * from apotek_trk where nofaktur='$nofaktur'"));


			$tbtrk=mysqli_query($kon,"select *,apotek_trkdetail.id as idbrgtrk,apotek_trkdetail.diskon as trkdiskon, apotek_trkdetail.jml as jmltrk from apotek_trkdetail join barang on apotek_trkdetail.kode=barang.kode where apotek_trkdetail.faktur='$nofaktur' order by apotek_trkdetail.id asc");
			$total=0;
			while($b=mysqli_fetch_array($tbtrk))
			{
				?>
				<tr>
					<td>
						
					</td>
					<td><b style="font-size: 8pt;" class="btn btn-dark p-1"><?=$b['kode'];?></b>
						<br><?=$b['nama'];?></td>
					<td align="right"><?=number_format($b['harga'],0,',','.');?></td>
					<td align="right"><?=number_format($b['trkdiskon'],0,',','.');?></td>
					<td align="right"><?=$b['jmltrk'];?></td>
					<td align="right"><?=number_format(($b['harga']-$b['trkdiskon'])*$b['jmltrk'],0,',','.');?></td>
				</tr>


			
				<?php
				$total=(($b['harga']-$b['trkdiskon'])*$b['jmltrk'])+$total;

			}
			?>
			</tbody>
			<tfoot>
				<?php
					if($gn['ppn']=='on')
					{
						$ppn=11/100;
						$total=($ppn*$total)+$total;
						?>
						<tr>
							<td colspan="5" class="bg-primary text-white">PPN 11%</td>
							<td align="right">
								<?php echo number_format(($ppn*$total),0,',','.');?>
							</td>	
						</tr>	
						<?php
					} 

					?>
				<tr>
					<td colspan="5" class="bg-primary text-white">Total Biaya</td>
					<td align="right">
						<?php
					echo "<b>".number_format($total,0,',','.')."</b>";
					?>
					</td>
				</tr>
				<tr>
					<td colspan="5" class="bg-primary text-white">Total Bayar</td>
					<td align="right">
						<?php
					echo "<b>".number_format($gn['bayar'],0,',','.')."</b>";
					?>
					</td>
				</tr>
				<tr>
					<td colspan="5" class="bg-primary text-white">Total Hutang</td>
					<td align="right">
						<?php
					echo "<b>".number_format(($total-$gn['bayar']),0,',','.')."</b>";

					if(($total-$gn['bayar'])>0)
					{
						$hutang=$total-$gn['bayar'];
						?><br>
						<a class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#bayarhutang"><i class="fas fa-donate"></i> Bayar</a>

						<div class="modal fade" id="bayarhutang" align="left">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">Hutang Transaksi #<?=$nofaktur;?></div>
									<div class="modal-body">
										<form method="post" action="hutang.bayar">
											<div class="form-group">
												<input type="hidden" name="nofaktur" value="<?=$nofaktur;?>">
												<input type="hidden" name="hutang" value="<?=$hutang;?>">
												<label>Total Hutang</label>
												<input type="number" name="hutang" class="form-control" value="<?=$hutang;?>" readonly>
											</div>
											<div class="form-group">
												<label>Bayar</label>
												<input type="number" name="bayar" class="form-control" value="0">
											</div>
											<div class="form-group">
												<label>Tanggal</label>
												<input type="date" name="tglbayar" class="form-control" value="<?=date('Y-m-d');?>">
											</div>
											<br>
											<button class="btn btn-sm btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
										</form>
									</div>
								</div>
							</div>
						</div>


						<?php
					}
					else
					{
						?>
						<br>
						<div class="alert alert-success">Lunas</div>
						<?php						
					}
					?>
					</td>
				</tr>
			</tfoot>
		</table>

			<div class="container p-1 pb-2">
				<div class="btn-group">
				<a class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#ptrk<?=$b['id'];?>" title="Pilih Pelanggan"><i class="fas fa-plus-circle"></i> Pilih Pelanggan
					<?php
					$gp=mysqli_fetch_array(mysqli_query($kon,"select *,pelanggan.kode as kodeplg,pelanggan.nama as plgnama from pelanggan join apotek_trk on pelanggan.kode=apotek_trk.kodepasien where apotek_trk.nofaktur='$nofaktur'")); 
					if(!empty($gp['kodeplg']))
					{
						
						echo ' : '.$gp['plgnama'];
					}
					else
					{
						echo " : Umum";
					}
					?>
				</a>
					
				</div>

				<div class="btn-group">
					<?php 
					

					if($gn['ppn']=='on')
					{
						$bon="btn-success";
						$bof="btn-outline-danger";
					}
					elseif ($gn['ppn']=='off') 
					{
						$bon="btn-outline-success";
						$bof="btn-danger";
					}
					else
					{
						$bon="btn-outline-success";
						$bof="btn-outline-danger";
					}
					?>
					<a class="btn btn-sm btn-disabled <?=$bon;?>"title="PPN ON"> PPN ON</a>

					<?php 
					if(!$gn['ppn']=='')
						{
					?>
					<a class="btn btn-sm btn-disabled <?=$bof;?>"title="PPN OFF"> PPN OFF</a>
					<?php 
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</div>
</div>
<?php include "foot.php";?>