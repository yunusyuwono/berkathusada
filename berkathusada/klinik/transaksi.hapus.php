<?php 
include "koneksi.php";
$id=$_GET['id'];
mysqli_query($kon,"delete from klinik_trkdetail where id='$id'");
header("location:transaksi.input");

?>