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
if(isset($_GET['kodeplg']))
	{
		$action="transaksi.input?tahap=".$_GET['tahap']."&kodeplg=".$_GET['kodeplg'];
	}
	else
	{
		$action="transaksi.input";	
	}
$updtrk=mysqli_query($kon,"update klinik_trk set bayar='$bayar',status_bayar='$statusbayar' where nofaktur='$nofaktur'");
if($updtrk)
{
	header("location:".$action);
}
else
{
	
	?>
	<script type="text/javascript">
		alert('Pembayaran gagal');
		window.location='<?=$action?>';
	</script>
	<?php
}