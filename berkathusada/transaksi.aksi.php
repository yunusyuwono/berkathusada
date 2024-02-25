<?php 
include 'koneksi.php';

$a=$_GET['a'];
switch ($a) {
	case 'simpan':
		$nofaktur=addslashes($_POST['nofaktur']);
		$kode	 =addslashes($_POST['kode']);
		$nama	=addslashes($_POST['nama']);
		$satuan=addslashes($_POST['satuan']);
		$jml=addslashes($_POST['jml']);
		$ed	 =addslashes($_POST['ed']);
		$hb	=addslashes($_POST['hargabeli']);
		$hj=addslashes($_POST['hargajual']);
		$diskon=addslashes($_POST['diskon']);
		$status='TRK';
		$jmld=mysqli_num_rows(mysqli_query($kon,"select * from barang where kode='$kode' and status='$status'"));
		
		$sinsql="insert into barang (nofaktur,kode,nama,satuan,jml,ed,hargabeli,hargajual,diskon,status) values ('$nofaktur','$kode','$nama','$satuan','$jml','$ed','$hb','$hj','$diskon','$status')";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
		{
			header("location:transaksi?type=barangmasuk&nofaktur=$nofaktur");
		}
		else
		{
			echo "Gagal";
		}
		/*
		}
		else
		{
			?>
			<script>alert("Gagal. Kode Barang sudah ada pada faktur ini");window.location='transaksi?type=barangmasuk&nofaktur=<?php echo $nofaktur;?>'</script>
			<?php
		
		*/
		break;

	case 'edit':
		$nofaktur=addslashes($_POST['nofaktur']);
		$idtrk=addslashes($_POST['idtrk']);
		$kode	 =addslashes($_POST['kode']);
		$nama	=addslashes($_POST['nama']);
		$satuan=addslashes($_POST['satuan']);
		$jml=addslashes($_POST['jml']);
		$ed	 =addslashes($_POST['ed']);
		$hb	=addslashes($_POST['hargabeli']);
		$hj=addslashes($_POST['hargajual']);
		$diskon=addslashes($_POST['diskon']);
		$sinsql="update barang set kode='$kode',nama='$nama',satuan='$satuan',jml='$jml',ed='$ed',hargabeli='$hb',hargajual='$hj',diskon='$diskon' where id='$idtrk' and nofaktur='$nofaktur'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
			{
				?>
				<script>alert("Berhasil");</script>
				<?php
				//header("location:transaksi?type=barangmasuk&nofaktur=$nofaktur");
			}
			else
			{
				?>
				<script>alert("Gagal");</script>
				<?php
			}
		break;

	case 'del':
		$id=$_GET['id'];
		$nofaktur=$_GET['nofaktur'];
		$sinsql="delete from barang where id='$id'";
		$exesql=mysqli_query($kon,$sinsql);
		if($exesql)
			{
				header("location:transaksi?type=barangmasuk&nofaktur=$nofaktur");
			}
			else
			{
				?>
				<script>alert("Gagal");window.location='transaksi?type=barangmasuk&nofaktur=<?php echo $nofaktur;?>'</script>
				<?php
			}
		break;		
	
	default:
		// code...
		break;
}
?>