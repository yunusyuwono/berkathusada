<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="wadahdistributor">
<table id="distributor" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>Nama</th>
	<th>No.HP</th>
	<th>Alamat</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tdistributor=mysqli_query($kon,"select * from distributor order by id desc");
	if(mysqli_num_rows($tdistributor)==0)
	{
		echo "<td colspan='5'>Data distributor belum tersedia</td>";
	}
}
else
{
	$tdistributor=mysqli_query($kon,"select * from distributor where nama like '%$cari%' or hp like '%$cari%' or alamat like '%$cari%' order by id desc");
	if(mysqli_num_rows($tdistributor)==0)
	{
		echo "<td colspan='5'>Data distributor yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($tdistributor))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['nama'];?></td>
			<td><?php echo $t['hp'];?></td>
			<td><?php echo $t['alamat'];?></td>
			<td>
				<a class="btn btn-sm btn-warning" href="?hal=distributor&edit&id=<?php echo $t['id'];?>"><i class="fas fa-edit"></i></a>
				<a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data ini?')" href="distributor.aksi?a=del&id=<?php echo $t['id'];?>"><i class="fas fa-trash"></i></a>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>