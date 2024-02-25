<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'save':
		$poli=addslashes($_POST['poli']);
        $dokter=$_POST['dokter'];
		$sinsql="insert into poli (poli,iddokter) values ('$poli','$dokter')";
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
		$poli=addslashes($_POST['poli']);
		$id=$_POST['id'];
		$sinsql="update poli set poli='$poli' where id='$id'";
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
		$sinsql="delete from poli where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			?>
			<script>alert("Berhasil");window.location='master?hal=poli'</script>
			<?php
		}
		else
		{
			?>
			<script>alert("Gagal");window.location='master?hal=poli'</script>
			<?php
		}
		break;		
	
	default:
		// code...
		break;
}
?>