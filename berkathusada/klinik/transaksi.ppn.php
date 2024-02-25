<?php 
include "koneksi.php";
$nofaktur=$_GET['nofaktur'];
$ppn=$_GET['ppn'];
mysqli_query($kon,"update klinik_trk set ppn='$ppn' where nofaktur='$nofaktur'");
if(isset($_GET['kodeplg']))
	{
		$action="transaksi.input?tahap=".$_GET['tahap']."&kodeplg=".$_GET['kodeplg'];
	}
	else
	{
		$action="transaksi.input";	
	}
header("location:".$action);

?>