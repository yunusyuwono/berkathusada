<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<div id="wadahbarang">
<table id="barang" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>Kode Barang</th>
	<th>No. Faktur</th>
	<th>Nama Barang</th>
	<th>Jumlah</th>	
	<th>Satuan</th>
	<th>Kadaluarsa</th>
	<th>Harga Beli (Rp.)</th>
	<th>Harga Jual (Rp.)</th>
	<th>Diskon (Rp.)</th>
	<th>Harga Jual Total (Rp.)</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tbarang=mysqli_query($kon,"select * from barang join barangmasuk on barang.nofaktur=barangmasuk.nofaktur order by barang.nama asc");
	if(mysqli_num_rows($tbarang)==0)
	{
		echo "<td colspan='12'>Data barang belum tersedia</td>";
	}
}
else
{
	$tbarang=mysqli_query($kon,"select * from barang join barangmasuk on barang.nofaktur=barangmasuk.nofaktur where barang.kode like '%$cari%' or barang.nofaktur like '%$cari%' or barang.nama like '%$cari%' or barang.jumlah like '%$cari%' or barang.satuan like '%$cari%' or barang.ed like '%$cari%' or barang.hargabeli like '%$cari%' or barang.hargajual like '%$cari%'or barang.diskon like '%$cari%'d order by barang.nama asc");
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
			<td><?php echo $t['barang.kode'];?></td>
			<td><a href="barang?hal=faktur&fakturid=<?php echo $t['barangmasuk.id'];?>&fakturno=<?php echo $t['barangmasuk.nofaktur'];?>"><?php echo $t['barang.nofaktur'];?></td>
			<td><?php echo $t['barang.nama'];?></td>
			<td><?php echo $t['barang.jumlah'];?></td>
			<td><?php echo $t['barang.satuan'];?></td>
			<td><?php echo $t['barang.ed'];?></td>
			<td><?php echo $t['barang.hargabeli'];?></td>
			<td><?php echo $t['barang.hargajual'];?></td>
			<td><?php echo $t['barang.nama'];?></td>
			<td><?php echo $t['barang.diskon'];?></td>
			<td><?php 
				$hargatotal=$t['barang.hargajual']-$t['barang.diskon'];
				echo $hargatotal;
				?></td>
			<td>
				<a class="btn btn-sm btn-warning" href="?hal=barang&edit&id=<?php echo $t['id'];?>"><i class="fas fa-edit"></i></a>
				<a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data ini?')" href="barang.aksi?a=del&id=<?php echo $t['id'];?>"><i class="fas fa-trash"></i></a>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>
<script>
	$(document).ready(function () {
    $('#barang').DataTable();
});
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>