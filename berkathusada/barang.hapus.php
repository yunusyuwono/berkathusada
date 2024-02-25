<?php 
include "koneksi.php";
if(isset($_GET['idbarang']))
{
	$idbarang = $_GET['idbarang'];
	mysqli_query($kon,"update barang set status='BIN' where id='$idbarang'");
	?>
	<script type="text/javascript">
		alert('Data barang berhasil diletakkan pada BIN');
		window.location='barang?hal=barangall';
	</script>
	<?php
}
?>