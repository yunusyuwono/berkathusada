<?php
include 'koneksi.php';
$layanan = $_GET['jenislayanan'];
if($layanan!="")
{
    if($layanan=='jasa')
    {
        $query = mysqli_query($kon, "select * from jasa");
    }
    elseif($layanan=='tindakan')
    {
        $query = mysqli_query($kon, "select * from tindakan");
    }


    while($q=mysqli_fetch_array($query))
    {
        echo "<option value='".$q['id']."'>".$q['kode']." - ".$q['nama']."</option>";
    }    
}
else
{
    echo "<option>Pilih Jenis Layanan dulu</option>";
}

?>