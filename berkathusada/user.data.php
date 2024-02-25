<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="wadahuser">
<table id="user" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>Kode</th>
	<th>Nama</th>
	<th>Jabatan</th>
	<th>Tanggal Lahir</th>
	<th>Usia</th>
	<th>No.HP</th>
	<th>Email</th>
	<th>Akses</th>
	<th>Gaji</th>
	<th>Insentif</th>
	<th>Entri</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$tuser=mysqli_query($kon,"select * from user order by nama asc");
	if(mysqli_num_rows($tuser)==0)
	{
		echo "<td colspan='9'>Data user belum tersedia</td>";
	}
}
else
{
	$tuser=mysqli_query($kon,"select * from user where kode like '%$cari%' or nama like '%$cari%' or tgll like '%$cari%' or nohp like '%$cari%' or email like '%$cari%' or tgll like '%$cari%' order by nama asc");
	if(mysqli_num_rows($tuser)==0)
	{
		echo "<td colspan='9'>Data user yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($tuser))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['kode'];?></td>
			<td><?php 
			if(!empty($t['gelar1'])&&!empty($t['gelar2']))
			{
				$nl=$t['gelar1'].'.'.$t['nama'].', '.$t['gelar2'];
			}
			elseif (empty($t['gelar1'])) 
			{
				$nl=$t['nama'].', '.$t['gelar2'];
			}
			elseif (empty($t['gelar2'])) 
			{
				$nl=$t['gelar1'].'.'.$t['nama'];
			}
			elseif (empty($t['gelar1'])&&empty($t['gelar2'])) 
			{
				$nl=$t['nama'];
			}
			
			echo $nl;?></td>
			<td><?=$t['jabatan'];?></td>
			<td><?php echo $t['tgll'];?></td>
			<td><?php 
				$tglpel=date_create($t['tgll']);
				$tglskr=date_create(date('Y-m-d'));
				$sel=date_diff($tglskr,$tglpel);
				$ut=$sel->y;
				$ub=$sel->m;
				echo "$ut tahun $ub bulan";
				?></td>
			<td><?php echo $t['nohp'];?></td>
			<td><?php echo $t['email'];?></td>
			<td><?php echo $t['status'];?></td>
			<td><?php echo 'Rp. '.number_format($t['gaji'],0,',','.');?></td>
			<td><?php echo 'Rp. '.number_format($t['insentif'],0,',','.');?></td>
			<td><?php echo $t['entri'];?></td>
			<td>
				<div class="btn-group">
				<a class="btn btn-sm btn-warning" href="?hal=user&edit&id=<?php echo $t['id'];?>"><i class="fas fa-edit"></i></a>
				<a class="btn btn-sm btn-primary" href="?hal=user&gaji&id=<?php echo $t['id'];?>"><i class="fas fa-donate"></i></a>
				<a class="btn btn-sm btn-success" href="user.akses?id=<?=$t['id'];?>"><i class="fas fa-user-circle"></i></a>
				<a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data ini?')" href="user.aksi?a=del&id=<?php echo $t['id'];?>"><i class="fas fa-trash"></i></a>
			</div>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>