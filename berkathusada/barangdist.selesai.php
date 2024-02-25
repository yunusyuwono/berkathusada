<?php 
include "koneksi.php";
$nofaktur=$_GET["faktur"];
$dist=mysqli_query($kon,"SELECT * from distbrg_detail where faktur='$nofaktur'");
while ($d=mysqli_fetch_array($dist))
{
    $b=mysqli_fetch_array(mysqli_query($kon,"SELECT * from barang where kode='$d[kode]'"));
    if($d['dari']=='Gudang')
    {
        $sisa=$b['jml']-$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml='$sisa' where kode='$b[kode]'");
    }
    elseif($d['dari']=='Klinik')
    {
        $sisa=$b['jml_klinik']-$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml_klinik='$sisa' where kode='$b[kode]'");
    }
    elseif($d['dari']=='Apotek')
    {
        $sisa=$b['jml_apotek']-$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml_apotek='$sisa' where kode='$b[kode]'");
    }
    elseif($d['dari']=='Praktek')
    {
        $sisa=$b['jml_praktek']-$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml_praktek='$sisa' where kode='$b[kode]'");
    }

    if($d['ke']=='Gudang')
    {
        $total=$b['jml']+$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml='$total' where kode='$b[kode]'");
    }
    elseif($d['ke']=='Klinik')
    {
        $total=$b['jml_klinik']+$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml_klinik='$total' where kode='$b[kode]'");
    }
    elseif($d['ke']=='Apotek')
    {
        $total=$b['jml_apotek']+$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml_apotek='$total' where kode='$b[kode]'");
    }
    elseif($d['ke']=='Praktek')
    {
        $total=$b['jml_praktek']+$d['jml'];
        mysqli_query($kon,"UPDATE barang set jml_praktek='$total' where kode='$b[kode]'");
    }

    
}
mysqli_query($kon,"UPDATE distbrg set status='selesai' where nofaktur='$nofaktur'");
header("location: barangdist.add");
?>