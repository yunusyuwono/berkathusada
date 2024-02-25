<?php
include 'koneksi.php';
$tindakan = $_GET['tindakan'];
$query = mysqli_query($kon, "select * from tindakan where kode='$tindakan'");

$b = mysqli_fetch_array($query);

$data = array(
            'biayatindakan'     =>  $b['harga'],
        );
 echo json_encode($data);
?>