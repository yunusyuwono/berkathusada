<?php
include 'koneksi.php';
$kode = $_GET['kode'];
$query = mysqli_query($kon, "select * from barang where kode='$kode'");

$b = mysqli_fetch_array($query);
if($kode != NULL)
{
$data = array(
            'nama'      =>  $b['nama'],
            'harga'     =>  $b['hargajual'],
            'diskon'    =>  $b['diskon'],
            'jml_apotek'=>  $b['jml_apotek'],
        );    
}
else
{
    $data = array(
        'message' => 'Masukkan kode barang'
            );
}

 echo json_encode($data);
?>