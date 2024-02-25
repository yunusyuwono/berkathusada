<?php 
include "koneksi.php";
$nofaktur=$_GET['nofaktur'];
$ppn=$_GET['ppn'];
mysqli_query($kon,"update apotek_trk set ppn='$ppn' where nofaktur='$nofaktur'");
header("location:apt.transaksi.input");

?>