<?php
include 'koneksi.php';
$kode = $_GET['kode'];
$query = mysqli_query($kon, "select * from barang where kode='$kode' or nama like '%$kode%'");
$b = mysqli_fetch_array($query);
$data = array(
            'nama'      =>  $b['nama'],
            'satuan'=>  $b['satuan'],
            'ed'    =>  $b['ed'],
            'hargabeli'  =>  $b['hargabeli'],
            'hargajual'=>  $b['hargajual'],
            'diskon'    =>  $b['diskon'],);
 echo json_encode($data);
?>