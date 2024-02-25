<?php 
include "koneksi.php";
$nofaktur=addslashes($_POST['nofaktur']);
$plg=addslashes($_POST['plg']);

mysqli_query($kon,"update apotek_trk set kodepasien='$plg' where nofaktur='$nofaktur'");
header("location:apt.transaksi.input");

?>