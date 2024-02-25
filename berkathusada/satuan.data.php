<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="wadahsatuan">
<table id="satuan" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>Nama</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tsatuan=mysqli_query($kon,"select * from satuan order by id desc");
	if(mysqli_num_rows($tsatuan)==0)
	{
		echo "<td colspan='3'>Data Satuan belum tersedia</td>";
	}
}
else
{
	$tsatuan=mysqli_query($kon,"select * from satuan where satuan like '%$cari%' order by id desc");
	if(mysqli_num_rows($tsatuan)==0)
	{
		echo "<td colspan='3'>Data Satuan yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($tsatuan))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['satuan'];?></td>
			<td>
				<a class="btn btn-sm btn-warning" href="?hal=satuan&edit&id=<?php echo $t['id'];?>&sa=<?php echo $t['satuan'];?>"><i class="fas fa-edit"></i></a>
				<a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data ini?')" href="satuan.aksi?a=del&id=<?php echo $t['id'];?>"><i class="fas fa-trash"></i></a>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>