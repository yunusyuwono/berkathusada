<?php 
include "koneksi.php";
$nofaktur=$_GET['nofaktur'];
$admin=addslashes($_POST['admin']);
mysqli_query($kon,"update apotek_trk set admin='$admin' where nofaktur='$nofaktur'");
header("location:transaksi.input");

?>