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
						<li class="breadcrumb-item"><a href="#" class="text-white">Transaksi</a></li>
						<li class="breadcrumb-item" aria-current="page"><b>Detail Transaksi Apotek</b></li>
						<li class="breadcrumb-item active text-white" aria-current="page"><b>#<?=$nofaktur;?></b></li>
					</ol>
				</nav>
				<h4 class="text-white">#<?=$nofaktur;?></h4></div>
			<div class="col-md-4" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" href="transaksi"><i class="fas fa-caret-left"></i> Kembali</a>
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

					if($gn['admin']!=0)
					{
						$total=$gn['admin']+$total;
						?>
						<tr>
							<td colspan="5" class="bg-primary text-white">Biaya Admin</td>
							<td align="right">
								<?php echo number_format($gn['admin'],0,',','.');?>
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
						$bon="fas fa-check";
						$bof="btn-success";
					}
					elseif ($gn['ppn']=='off') 
					{
						$bon="fas fa-times";
						$bof="btn-danger";
					}
					else
					{
						$bon="fas fa-times";
						$bof="btn-danger";	
					}
					?>
					<a class="btn btn-sm btn-disabled <?=$bof;?>"title="PPN"> PPN <i class="<?=$bon;?>"></i></a>

				</div>
			</div>
		</div>
	</div>
</div>
</section>
</div>
</div>
<?php include "foot.php";?>