<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'save':
		$satuan=addslashes($_POST['satuan']);
		$sinsql="insert into satuan (satuan) values ('$satuan')";
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
		$satuan=addslashes($_POST['satuan']);
		$id=$_POST['id'];
		$sinsql="update satuan set satuan='$satuan' where id='$id'";
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
		$sinsql="delete from satuan where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			?>
			<script>alert("Berhasil");window.location='master?hal=satuan'</script>
			<?php
		}
		else
		{
			?>
			<script>alert("Gagal");window.location='master?hal=satuan'</script>
			<?php
		}
		break;		
	
	default:
		// code...
		break;
}
?>