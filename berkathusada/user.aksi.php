<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'save':
		$nama=addslashes($_POST['nama']);
		$glr1=addslashes($_POST['gelar1']);
		$glr2=addslashes($_POST['gelar2']);
		$tgll=addslashes($_POST['tgll']);
		$hp=addslashes($_POST['hp']);
		$email=addslashes($_POST['email']);
		$pw=md5(addslashes($hp));//generate dari no hp
		$jabatan=addslashes($_POST['jabatan']);
		$sinsql="insert into user (nama,gelar1,gelar2,tgll,nohp,email,pas,jabatan) values 
				('$nama','$glr1','$glr2','$tgll','$hp','$email','$pw','$jabatan')";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			$cu=mysqli_fetch_array(mysqli_query($kon,"select * from user where nohp='$hp'"));
			$akht=date('y',strtotime($tgll));
			$kode="K".date('y').$akht.sprintf('%03s',$cu['id']);
			mysqli_query($kon,"update user set kode='$kode' where id='$cu[id]'");
			echo "Berhasil";
		}
		else
		{
			echo "Gagal ".mysqli_error($kon);
		}
		break;

	case 'edit':
		$nama=addslashes($_POST['nama']);
		$glr1=addslashes($_POST['gelar1']);
		$glr2=addslashes($_POST['gelar2']);
		$tgll=addslashes($_POST['tgll']);
		$hp=addslashes($_POST['hp']);
		$email=addslashes($_POST['email']);
		$pw=md5(addslashes($hp));//generate dari no hp
		$jabatan=addslashes($_POST['jabatan']);
		$id=$_POST['id'];
		$sinsql="update user set nama='$nama',gelar1='$glr1',gelar2='$glr2',tgll='$tgll',nohp='$hp',email='$email', jabatan='$jabatan' where id='$id'";
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
	
	case 'gaji':
			$gaji=addslashes($_POST['gaji']);
			$insentif=addslashes($_POST['insentif']);
			$id=$_POST['id'];
			$sinsql="update user set gaji='$gaji', insentif='$insentif' where id='$id'";
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
		$sinsql="delete from user where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			?>
			<script>alert("Berhasil");window.location='master?hal=user'</script>
			<?php
		}
		else
		{
			?>
			<script>alert("Gagal");window.location='master?hal=user'</script>
			<?php
		}
		break;		
	
	default:
		// code...
		break;
}
?>