<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Data Barang Terjual</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Data Barang Terjual</h4></div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-responsive">
				<thead>
					<th>No.</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Frekuensi Penjualan</th>
					<th>Jumlah Penjualan</th>
					<th>Satuan</th>
					<th>Total Biaya Penjualan (Rp.)</th>
				</thead>
				<?php 
				$barang=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
				$no=1;
				while ($b=mysqli_fetch_array($barang)) {
					?>
					<tr>
						<td><?=$no;?></td>
						<td><?=$b['kode'];?></td>
						<td><?=$b['nama'];?></td>
						<?php 
						$gtrk=mysqli_query($kon,"select *,count(kode) as fp,sum(jml) as jp, sum(biaya) as tb from apotek_trkdetail where kode='$b[kode]'");
						$gd=mysqli_fetch_array($gtrk);
						?>
						<td><?php if($gd['fp']==0){echo 0;}else{echo $gd['fp'];}?></td>

						<td><?php if($gd['jp']==0){echo 0;}else{echo $gd['jp'];}?></td>
						<td><?=$b['satuan'];?></td>
						<td align="right"><?php if($gd['tb']==0){echo 0;}else{
							echo number_format($gd['tb'],0,',','.');}?></td>
					</tr>
					<?php
					$no++;
				}
				?>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
		    $('.table').DataTable();
		} );
</script>