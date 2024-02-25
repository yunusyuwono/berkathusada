<?php 
include 'koneksi.php';
?>
<table id="barangdistdata" class="table table-striped table-hover table-bordered table-responsive">
	<thead>
		<th>No.</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Jumlah Gudang</th>
		<th>Jumlah Klinik</th>
		<th>Jumlah Apotek</th>
		<th>Jumlah Tempat Praktek</th>
		<th>Jumlah Total</th>
		<th>Kadaluarsa</th>
	</thead>
	<?php 
	$tglskrg=date_create();
	//$tgl5bln=date('Y-m-d',strtotime('5 months',strtotime($tglskrg)));
	
	if(isset($_GET['cari']))
	{
		$cari=$_GET['cari'];
		$barang=mysqli_query($kon,"select * from barang where status='STOK' and kode like '%$cari%' or nama like '%$cari%' order by nama asc");
	}
	else
	{
		$barang=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
	}
	$no=1;
	while ($b=mysqli_fetch_array($barang)) {
	?>
	<tr>
		<td><?=$no;?></td>
		<td><?=$b['kode'];?></td>
		<td><?=$b['nama'];?></td>
		<td><?=$b['jml'];?> <?=($b['jml']<=10)?' <i class="fas fa-circle text-danger"></i>':'';?></td>
		<td><?=$b['jml_klinik'];?> <?=($b['jml_klinik']<=5)?' <i class="fas fa-circle text-danger"></i>':'';?></td>
		<td><?=$b['jml_apotek'];?> <?=($b['jml_apotek']<=5)?' <i class="fas fa-circle text-danger"></i>':'';?></td>
		<td><?=$b['jml_praktek'];?> <?=($b['jml_praktek']<=5)?' <i class="fas fa-circle text-danger"></i>':'';?></td>
		<td><?=$b['jml_apotek']+$b['jml_klinik']+$b['jml'];?></td>
		<td><?=$b['ed'];?></td>
		
	</tr>
	<?php
	$no++;
	}
		
	?>
</table>
