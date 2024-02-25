<?php 
include "koneksi.php";
$nofaktur=$_POST['nofaktur'];
$bayar=$_POST['bayar'];
$total=$_POST['total'];

if($bayar<$total)
{
	$statusbayar='hutang';	
}
else
{
	$statusbayar='lunas';
}
$updtrk=mysqli_query($kon,"update apotek_trk set bayar='$bayar',status_bayar='$statusbayar' where nofaktur='$nofaktur'");
if($updtrk)
{
	header("location:transaksi.input");
}
else
{
	?>
	<script type="text/javascript">
		alert('Pembayaran gagal');
		window.location='transaksi.input';
	</script>
	<?php
}