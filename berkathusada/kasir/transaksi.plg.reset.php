<?php 
include "koneksi.php";
$nofaktur=$_GET['nofaktur'];
mysqli_query($kon,"update klinik_trk set kodepasien='' where nofaktur='$nofaktur'");
header("location:transaksi.input");

?>