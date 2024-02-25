<?php
include 'koneksi.php';
$kode = $_GET['kode'];
$dari   =$_GET['dari'];
$query = mysqli_query($kon, "select * from barang where kode='$kode'");

$b = mysqli_fetch_array($query);
if($dari=='center')
{
    $jdari=$b['jml'];
}
elseif($dari=='apotek')
{
    $jdari=$b['jml_apotek'];
}
elseif($dari=='klinik')
{
    $jdari=$b['jml_klinik'];
}

$data = array(
            'jdari'=>  $jdari,
        );
 echo json_encode($data);
?>