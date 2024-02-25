<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'save':
		$nama=addslashes($_POST['nama']);
		$hp	 =addslashes($_POST['hp']);
		$almt=addslashes($_POST['alamat']);
		$jmld=mysqli_num_rows(mysqli_query($kon,"select * from distributor"));
		$kode="D".sprintf('%03s',($jmld+1));
		$sinsql="insert into distributor (kode,nama,hp,alamat) values ('$kode','$nama','$hp','$almt')";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
		break;

	case 'edit':
		$nama=addslashes($_POST['nama']);
		$hp	 =addslashes($_POST['hp']);
		$almt=addslashes($_POST['alamat']);
		$id=$_POST['id'];
		$sinsql="update distributor set nama='$nama',hp='$hp',alamat='$almt' where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
		break;

	case 'del':
		$id=$_GET['id'];
		$sinsql="delete from distributor where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			?>
			<script>alert("Berhasil");window.location='master?hal=distributor'</script>
			<?php
		}
		else
		{
			?>
			<script>alert("Gagal");window.location='master?hal=distributor'</script>
			<?php
		}
		break;		
	
	default:
		// code...
		break;
}
?>