<?php 
if(isset($_POST['upd']))
{
	include "koneksi.php";

	$idbarang = $_POST['idbarang'];
	$kodebrg  = $_POST['kode'];
	$namabrg  = $_POST['nama'];
	$ed  	  = $_POST['ed'];
	$hrgbeli  = $_POST['hargabeli'];
	$hrgjual  = $_POST['hargajual'];
	$diskon   = $_POST['diskon'];

	$upd = mysqli_query($kon,"update barang set 
		kode='$kodebrg',
		nama='$namabrg',
		ed='$ed',
		hargabeli='$hrgbeli',
		hargajual='$hrgjual',
		diskon='$diskon'
		where id='$idbarang'");
	if($upd)
	{

		?>
		Berhasil <?=mysqli_error($kon);?>
		<script>alert('Data barang berhasil diperbarui');window.location='barang?hal=barangall';</script>
		<?php
	}
	else
	{

		?>
		Galat <?=mysqli_error($kon);?>
		<script>alert('Data barang gagal diperbarui. ');window.location='barang?hal=barangall';</script>
		<?php
	}
}
?>