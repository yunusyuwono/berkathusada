<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="wadahpelanggan">
<table id="pelanggan" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>Kode</th>
	<th>NIK</th>
	<th>Nama</th>
	<th>Jenis Kelamin</th>
	<th>TTL</th>
	<th>Usia</th>
	<th>No.HP</th>
	<th>Alamat</th>
	<th>Entri</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tpelanggan=mysqli_query($kon,"select * from pelanggan order by nama asc");
	if(mysqli_num_rows($tpelanggan)==0)
	{
		echo "<td colspan='10'>Data pelanggan belum tersedia</td>";
	}
}
else
{
	$tpelanggan=mysqli_query($kon,"select * from pelanggan where kode like '%$cari%' or nik like '%$cari%' or nama like '%$cari%' or jk like '%$cari%' or tmpl like '%$cari%' or tgll like '%$cari%' or alamat like '%$cari%' or entri like '%$cari%' or hp like '%$cari%' order by id desc");
	if(mysqli_num_rows($tpelanggan)==0)
	{
		echo "<td colspan='10'>Data pelanggan yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($tpelanggan))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['kode'];?></td>
			<td><?php echo $t['nik'];?></td>
			<td><?php echo $t['nama'];?></td>
			<td><?php echo $t['jk'];?></td>
			<td><?php echo $t['tmpl'].', '.$t['tgll'];?></td>
			<td><?php 
				$tglpel=date_create($t['tgll']);
				$tglskr=date_create(date('Y-m-d'));
				$sel=date_diff($tglskr,$tglpel);
				$ut=$sel->y;
				$ub=$sel->m;
				echo "$ut tahun $ub bulan";
				?></td>
			<td><?php echo $t['hp'];?></td>
			<td><?php echo $t['alamat'];?></td>
			<td><?php echo $t['entri'];?></td>
			<td>
				<a class="btn btn-sm btn-success" href="berobat?id=<?php echo $t['id'];?>"><i class="fas fa-list-alt"></i> Riwayat Berobat</a>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>