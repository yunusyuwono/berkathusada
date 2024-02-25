<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="wadahbarang">
<table id="barang" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>No. Faktur</th>
	<th>Distributor</th>
	<th>Tanggal Faktur</th>	
	<th>Tanggal Kedatangan</th>
	<th>Jumlah Varian</th>
	<th>Jumlah Biaya</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tbarang=mysqli_query($kon,"select * from barangmasuk join distributor on barangmasuk.iddist=distributor.id order by barangmasuk.tgl_faktur desc");
	if(mysqli_num_rows($tbarang)==0)
	{
		echo "<td colspan='8'>Data barang belum tersedia</td>";
	}
}
else
{
	$tbarang=mysqli_query($kon,"select * from barangmasuk join distributor on barangmasuk.iddist=distributor.id where barangmasuk.nofaktur like '%$cari%' or barangmasuk.tgl_dtg like '%$cari%' or barangmasuk.nofaktur like '%$cari%' or distributor.nama like '%$cari%' order by barangmasuk.tgl_faktur desc");
	if(mysqli_num_rows($tbarang)==0)
	{
		echo "<td colspan='12'>Data barang yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($tbarang))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['nofaktur'];?></td>
			<td><?php echo $t['nama'];?></td>
			<td><?php echo $t['tgl_faktur'];?></td>
			<td><?php echo $t['tgl_dtg'];?></td>
			<?php 
			$ctb=mysqli_fetch_array(mysqli_query($kon,"select sum(hargabeli) as totalhbeli, count(kode) as totalvarian from barangtrkmasuk where nofaktur='$t[nofaktur]'"));

			$tbi=mysqli_fetch_array(mysqli_query($kon,"select sum(hargabeli*jml) as tbiaya from barangtrkmasuk where nofaktur='$t[nofaktur]'"));
			?>
			<td><?=$ctb['totalvarian'];?></td>
			<td align="right"><?="Rp. ".number_format($tbi['tbiaya'],0,',','.');?></td>
			
			<td>
				<div class="btn-group">
				<a class="btn btn-sm btn-success" href="transaksi?type=barangmasuk&nofaktur=<?php echo $t['nofaktur'];?>"><i class="fas fa-box"></i></a>
				<?php 
				/*<a class="btn btn-sm btn-warning" href="?hal=baranginput&nofaktur=<?php echo $t['nofaktur'];?>"><i class="fas fa-edit"></i></a>
				<a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data ini?')" href="barang.aksi?a=del&id=<?php echo $t['id'];?>"><i class="fas fa-trash"></i></a>
				*/?>
				</div>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>