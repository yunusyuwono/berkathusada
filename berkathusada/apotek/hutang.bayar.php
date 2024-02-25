<?php
include 'koneksi.php';
$nofaktur=$_POST['nofaktur'];
$hutang=$_POST['hutang'];
$bayar=$_POST['bayar'];
$tgl=$_POST['tglbayar'];

mysqli_query($kon,"insert into apotek_chutang (nofaktur,bayar,entri) values ('$nofaktur','$bayar','$tgl')");

$glb=mysqli_fetch_array(mysqli_query($kon,"select *,sum(bayar) as jbayar from apotek_chutang where nofaktur='$nofaktur'"));
if($glb['jbayar']<$hutang)
{
	mysqli_query($kon,"update apotek_trk set bayar='$glb[jbayar]' where nofaktur='$nofaktur'");
	?>
	<script type="text/javascript">alert('Pembayaran hutang berhasil');window.location='hutang.list.detail?nofaktur=<?=$nofaktur;?>'</script>
	<?php
}
else
{
	mysqli_query($kon,"update apotek_trk set bayar='$glb[jbayar]',status_bayar='lunas' where nofaktur='$nofaktur'");
	?>
	<script type="text/javascript">alert('Pembayaran hutang berhasil dilunasi');window.location='hutang.list.detail?nofaktur=<?=$nofaktur;?>'</script>
	<?php
}
?>