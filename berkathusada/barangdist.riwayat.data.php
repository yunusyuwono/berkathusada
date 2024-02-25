<?php 
include 'koneksi.php';
?>
<table id="barangdistdata" class="table table-striped table-hover table-bordered table-responsive">
	<thead>
		<th>No.</th>
		<th>No Faktur</th>
		<th>Barang Keluar</th>
		<th>Barang Masuk</th>
		<th>Detail</th>
		<th>Entri</th>
		<!--<th>Aksi</th>-->
	</thead>
	<?php 
	$tglskrg=date_create();
	//$tgl5bln=date('Y-m-d',strtotime('5 months',strtotime($tglskrg)));
	
	if(isset($_GET['cari']))
	{
		$cari=$_GET['cari'];
		$dist=mysqli_query($kon,"select * from distbrg where status='selesai' and nofaktur like '%$cari%'  group by nofaktur order by id desc");
	}
	else
	{
		$dist=mysqli_query($kon,"select * from distbrg where status='selesai' group by nofaktur order by id desc");
	}
	$no=1;
	while ($d=mysqli_fetch_array($dist)) {
	?>
	<tr>
		<td><?=$no;?></td>
		<td><?=$d['nofaktur'];?></td>
		<?php 
		$dg=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and dari='Gudang' "));
		$dk=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and dari='Klinik' "));
		$da=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and dari='Apotek' "));
		$dp=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and dari='Praktek' "));

		$kg=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and ke='Gudang' "));
		$kk=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and ke='Klinik' "));
		$ka=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and ke='Apotek' "));
		$kp=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(jml) as jml FROM distbrg_detail where faktur='$d[nofaktur]' and ke='Praktek' "));


		?>
		
		<td>
			<div class="btn-group-vertical btn-block" align="left">
				<div class="btn btn-sm btn-success">Gudang <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($dg['jml']!=NULL){echo $dg['jml'];}else{echo 0;}?></span></div>
				<div class="btn btn-sm btn-info">Klinik <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($dk['jml']!=NULL){echo $dk['jml'];}else{echo 0;}?></span></div>
				<div class="btn btn-sm btn-danger">Apotek <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($da['jml']!=NULL){echo $da['jml'];}else{echo 0;}?></span></div>
				<div class="btn btn-sm btn-dark">Praktek <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($dp['jml']!=NULL){echo $dp['jml'];}else{echo 0;}?></span></div>
			</div>
		</td>
		<td>
			<div class="btn-group-vertical btn-block" align="left">
				<div class="btn btn-sm btn-success">Gudang <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($kg['jml']!=NULL){echo $kg['jml'];}else{echo 0;}?></span></div>
				<div class="btn btn-sm btn-info">Klinik <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($kk['jml']!=NULL){echo $kk['jml'];}else{echo 0;}?></span></div>
				<div class="btn btn-sm btn-danger">Apotek <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($ka['jml']!=NULL){echo $ka['jml'];}else{echo 0;}?></span></div>
				<div class="btn btn-sm btn-dark">Praktek <span class="text-dark" style="background:white;padding:2pt;border-radius:5px;font-size:8pt;"><?php if($kp['jml']!=NULL){echo $kp['jml'];}else{echo 0;}?></span></div>
			</div>
		</td>
		<td>
			<a class="btn btn-primary btn-sm" href="barangdist.riwayat.detail?faktur=<?=$d['nofaktur']?>">Detail</a>
		</td>
		<td><?=$d['entri'];?></td>
	</tr>
	<?php
	$no++;
	}
		
	?>
</table>
