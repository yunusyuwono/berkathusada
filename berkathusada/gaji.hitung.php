<?php include "koneksi.php";
$a=$_POST;

$u=mysqli_fetch_array(mysqli_query($kon,"SELECT * from user where id='$a[idpegawai]'"));
$tg=$u['gaji']+$u['insentif'];
$terima=$tg-$a['potongan'];
?>
<h3>Klinik Pratama MUSTIKA</h3>
<hr>
<div align="center">
	<h4>SLIP GAJI</h4>
<br>
</div>

<table border="0">
	<tr><td>Tanggal</td><td>:</td><td><?=date('d-m-Y');?></td></tr>
	<tr><td>Nama</td><td>:</td><td><?=$u['gelar1'].$u['nama'].$u['gelar2'];?></td></tr>
	<tr><td>Jabatan</td><td>:</td><td><?=$u['jabatan'];?></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Gaji Pokok</td><td>:</td><td align="right"><?='Rp. '.number_format($u['gaji'],0,',','.');?></td></tr>
	<tr><td>Insentif</td><td>:</td><td align="right"><?='Rp. '.number_format($u['insentif'],0,',','.');?></td></tr>
	<tr><td>Potongan</td><td>:</td><td align="right"><?='Rp. '.number_format($a['potongan'],0,',','.');?></td></tr>
	<tr><td>Jumlah yang diterima</td><td>:</td><td  align="right"><?='Rp. '.number_format($terima,0,',','.');?></td></tr>
</table>
</div>