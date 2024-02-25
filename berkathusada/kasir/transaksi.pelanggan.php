<?php 
include "koneksi.php";
$nofaktur=addslashes($_POST['nofaktur']);
$plg=addslashes($_POST['plg']);

mysqli_query($kon,"update klinik_trk set kodepasien='$plg' where nofaktur='$nofaktur'");
header("location:transaksi.input");

?>