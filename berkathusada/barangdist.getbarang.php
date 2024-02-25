<?php
include 'koneksi.php';
$kode = $_GET['kode'];
$query = mysqli_query($kon, "select * from barang where kode='$kode'");

$b = mysqli_fetch_array($query);
if($kode != NULL)
{
$data = array(
            'nama'      =>  $b['nama'],
            'jml'     =>  $b['jml'],
            'jml_klinik' =>  $b['jml_klinik'],
            'jml_apotek'=>  $b['jml_apotek'],
            'jml_praktek'=> $b['jml_praktek'],
            'total'=>$b['jml']+$b['jml_klinik']+$b['jml_apotek']+$b['jml_praktek'],
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