<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'simpanfaktur':
		$nofaktur=addslashes($_POST['nofaktur']);
		$dist	 =addslashes($_POST['dist']);
		$tglf=addslashes($_POST['tgl_faktur']);
		$tgld=addslashes($_POST['tgl_dtg']);
		$status='E';
		$jmld=mysqli_num_rows(mysqli_query($kon,"select * from barangmasuk where nofaktur='$nofaktur'"));
		if($jmld==0)
		{
			$sinsql="insert into barangmasuk (tgl_faktur,tgl_dtg,iddist,nofaktur,status) values ('$tglf','$tgld','$dist','$nofaktur','$status')";
			$exesql=mysqli_query($kon,$sinsql);
			if($exesql)
			{
				echo "<script>alert('Berhasil');window.location='transaksi?type=barangmasuk&nofaktur=$nofaktur'</script>";
			}
			else
			{
				echo "<script>alert('Gagal');history.back()</script>";
			}
		}
		else
		{
			echo "<script>alert('Gagal. Faktur sudah pernah dientri');history.back()</script>";
		}
		break;

	case 'edit':
		$nama=addslashes($_POST['nama']);
		$hp	 =addslashes($_POST['hp']);
		$almt=addslashes($_POST['alamat']);
		$id=$_POST['id'];
		$sinsql="update barangmasuk set nama='$nama',hp='$hp',alamat='$almt' where id='$id'";
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
		$sinsql="delete from barangmasuk where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			?>
			<script>alert("Berhasil");window.location='master?hal=barangmasuk'</script>
			<?php
		}
		else
		{
			?>
			<script>alert("Gagal");window.location='master?hal=barangmasuk'</script>
			<?php
		}
		break;		
	
	default:
		// code...
		break;
}
?>