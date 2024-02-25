<?php 
include "koneksi.php";
$id=$_GET["id"];
mysqli_query($kon,"delete from distbrg_detail where id='$id'");
header("location: barangdist.add");
?>