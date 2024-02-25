<?php 
include "koneksi.php";
$nofaktur=$_GET['nofaktur'];
mysqli_query($kon,"update apotek_trk set kodepasien='' where nofaktur='$nofaktur'");
header("location:apt.transaksi.input");

?>