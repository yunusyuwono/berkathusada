<?php 
include "koneksi.php";
$idp=$_GET['idp'];
$entri=date('Y-m-d');
$nofaktur=$_GET['nofaktur'];
$date=date('Y-m-d');
$plg=mysqli_fetch_array(mysqli_query($kon,"select * from pelanggan where id='$idp'"));
$gtj=mysqli_query($kon,"select * from rtj where idpelanggan='$idp' and entri='$date'");
if(mysqli_num_rows($gtj)>0)
{
	while($g=mysqli_fetch_array($gtj))
	{
		if($g['layanan']=='jasa')
		{
			$ql=mysqli_fetch_array(mysqli_query($kon,"select * from jasa where id='$g[idlayanan]'"));
			$biaya=$ql['harga'];
		}
		elseif($g['layanan']=='tindakan')
		{
			$ql=mysqli_fetch_array(mysqli_query($kon,"select * from tindakan where id='$g[idlayanan]'"));
			$biaya=$ql['harga']*$g['jumlah'];
		}


		mysqli_query($kon,"INSERT INTO klinik_trkdetail (faktur,kode,jml,harga,biaya) values ('$nofaktur','$ql[kode]','$g[jumlah]','$ql[harga]','$biaya')");
		//echo "Kode : $ql[kode] <br>Nama : $ql[nama]<br>Harga : $ql[harga]<br>";
	}
	?>
	<script type="text/javascript">
		alert('Generate berhasil');
		window.location='transaksi.input?tahap=Apotek&kodeplg=<?=$plg['kode'];?>'; 
	</script>
<?php 
}
else
{
	?>
	<script type="text/javascript">
		alert('Tidak ada jasa dan tindakan yang diinput dokter hari ini untuk pelanggan <?=$plg['nama'];?>');
		window.location='transaksi.input?tahap=Apotek&kodeplg=<?=$plg['kode'];?>'; 
	</script>
<?php 
}