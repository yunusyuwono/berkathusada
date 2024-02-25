<?php 
include "koneksi.php";
$id=$_GET['id'];
mysqli_query($kon,"delete from apotek_trkdetail where id='$id'");
header("location:transaksi.input");

?>