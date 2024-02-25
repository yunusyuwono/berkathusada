<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'save':
		$nik=addslashes($_POST['nik']);
		$nama=addslashes($_POST['nama']);
		$jk=addslashes($_POST['jk']);
		$tmpl=addslashes($_POST['tmpl']);
		$tgll=addslashes($_POST['tgll']);
		$hp	 =addslashes($_POST['hp']);
		$almt=addslashes($_POST['alamat']);
		$jns=addslashes($_POST['jns']);
		$nobpjs=addslashes($_POST['nobpjs']);
		$cek=mysqli_query($kon,"select * from pelanggan where nik='$nik' or hp='$hp'");
		if(mysqli_num_rows($cek)==0)
		{
			$jmld=mysqli_num_rows(mysqli_query($kon,"select * from pelanggan"));
			$kode="P".strtoupper(substr($nama, 0,1)).date('y').sprintf('%05s',($jmld+1));
			$sinsql="insert into pelanggan (kode,nik,nama,jk,hp,tmpl,tgll,alamat,jenis,nobpjs) values ('$kode','$nik','$nama','$jk','$hp','$tmpl','$tgll','$almt','$jns','$nobpjs')";
			$exesql=mysqli_query($kon,$sinsql);
			if($exesql)
			{
				echo "Berhasil";
			}
			else
			{
				echo "Gagal. ".mysqli_error($kon);
			}
		}
		else
		{
			echo "Data pelanggan sudah pernah terdaftar";
		}
		break;

	case 'edit':
		$nik=addslashes($_POST['nik']);
		$nama=addslashes($_POST['nama']);
		$jk=addslashes($_POST['jk']);
		$tmpl=addslashes($_POST['tmpl']);
		$tgll=addslashes($_POST['tgll']);
		$hp	 =addslashes($_POST['hp']);
		$almt=addslashes($_POST['alamat']);
		$id=$_POST['id'];
		$sinsql="update pelanggan set nik='$nik',nama='$nama',jk='$jk',tmpl='$tmpl',tgll='$tgll',hp='$hp',alamat='$almt' where id='$id'";
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
		$sinsql="delete from pelanggan where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			?>
			<script>alert("Berhasil");window.location='master?hal=pasien'</script>
			<?php
		}
		else
		{
			?>
			<script>alert("Gagal");window.location='master?hal=pasien'</script>
			<?php
		}
		break;		
	
	default:
		// code...
		break;
}
?>