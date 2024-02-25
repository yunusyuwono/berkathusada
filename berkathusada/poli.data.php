<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="wadahpoli">
<table id="poli" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>Nama Poli</th>
    <th>Dokter</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tpoli=mysqli_query($kon,"select * from poli join user on poli.iddokter=user.id");
	if(mysqli_num_rows($tpoli)==0)
	{
		echo "<td colspan='4'>Data Poli belum tersedia</td>";
	}
}
else
{
	$tpoli=mysqli_query($kon,"select * from poli where poli like '%$cari%' order by id desc");
	if(mysqli_num_rows($tpoli)==0)
	{
		echo "<td colspan='4'>Data Poli yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($tpoli))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['poli'];?></td>
            <td><?php echo $t['gelar1'].'. '.$t['nama'].', '.$t['gelar2'];?></td>
			<td>
				<a class="btn btn-sm btn-warning" href="?hal=poli&edit&id=<?php echo $t['id'];?>&sa=<?php echo $t['poli'];?>"><i class="fas fa-edit"></i></a>
				<a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data ini?')" href="poli.aksi?a=del&id=<?php echo $t['id'];?>"><i class="fas fa-trash"></i></a>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>