<?php 
include "koneksi.php";
$nofaktur=$_GET['nofaktur'];



$gbtrk=mysqli_query($kon,"select * from barang where nofaktur='$nofaktur' and status='TRK'");
while ($gb=mysqli_fetch_array($gbtrk)) {
	$cbstok=mysqli_query($kon,"select * from barang where kode='$gb[kode]'");
	if(mysqli_num_rows($cbstok)>1)
	{
		mysqli_query($kon,"insert into barangtrkmasuk (nofaktur,kode,nama,satuan,jml,ed,hargabeli,hargajual,diskon,status) values 
			('$gb[nofaktur]','$gb[kode]','$gb[nama]','$gb[satuan]','$gb[jml]','$gb[ed]','$gb[hargabeli]','$gb[hargajual]','$gb[diskon]','$gb[status]')");
		$qbstok=mysqli_query($kon,"select *,min(id) as idtkcl from barang where kode='$gb[kode]'");
		$gbstok=mysqli_fetch_array($qbstok);
		$gjidtk=$gbstok['idtkcl'];

		$jmltotal=$gbstok['jml']+$gb['jml'];
		//echo $jmltotal;
		mysqli_query($kon,"update barang set jml='$jmltotal',status='STOK' where kode='$gb[kode]' and nofaktur='$nofaktur'");
		mysqli_query($kon,"delete from barang where kode='$gb[kode]' and id='$gjidtk'");
	}
	else
	{
		mysqli_query($kon,"insert into barangtrkmasuk (nofaktur,kode,nama,satuan,jml,ed,hargabeli,hargajual,diskon,status) values 
			('$gb[nofaktur]','$gb[kode]','$gb[nama]','$gb[satuan]','$gb[jml]','$gb[ed]','$gb[hargabeli]','$gb[hargajual]','$gb[diskon]','$gb[status]')");
		mysqli_query($kon,"update barang set status='STOK' where kode='$gb[kode]' and nofaktur='$nofaktur'");	
	}
}

if(isset($_GET['cetak']))
{
	?>
	<table class="table table-striped table-hover table-bordered">
	<thead>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		<th>Kadaluarsa</th>
		<th>Harga Beli</th>
		<th>Harga Jual</th>
		<th>Diskon</th>
		<th>Biaya</th>		
	</thead>
	<?php 
	$gtr=mysqli_query($kon,"select * from barangtrkmasuk where nofaktur='$nofaktur'");
	$total=0;
	while($g=mysqli_fetch_array($gtr))
	{
		?>
		<tr>
			<td><?php echo $g['kode'];?></td>
			<td><?php echo $g['nama'];?></td>
			<td><?php echo $g['satuan'];?></td>
			<td align="center"><?php echo $g['jml'];?></td>
			<td><?php echo $g['ed'];?></td>
			<td align="right"><?php echo number_format($g['hargabeli'],0,',','.');?></td>
			<td align="right"><?php echo number_format($g['hargajual'],0,',','.');?></td>
			<td align="right"><?php echo number_format($g['diskon'],0,',','.');?></td>
			<td align="right"><?php $tbiaya=$g['hargabeli']*$g['jml']; 
				echo number_format($tbiaya,0,',','.');?></td>
			<?php 
			$total=$tbiaya+$total;

			?>
		</tr>
		<tfoot>
			<tr>
				<td colspan="9">Total Tagihan</td>
				<td align="right"><b><?php echo number_format($total,0,',','.');?></b></td>
			</tr>
		</tfoot>
	<?php
	}
}

$selesai=mysqli_query($kon,"update barangmasuk set status='D' where nofaktur='$nofaktur'");
header("location:barang?hal=barangmasuk");
?>