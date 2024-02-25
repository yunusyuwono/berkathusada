<?php
include 'koneksi.php';
$jasa = $_GET['jasa'];
$query = mysqli_query($kon, "select * from jasa where kode='$jasa'");

$b = mysqli_fetch_array($query);

$data = array(
            'biayajasa'     =>  $b['harga'],
        );
 echo json_encode($data);
?>