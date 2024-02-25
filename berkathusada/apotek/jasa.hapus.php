<?php 
include "koneksi.php";
mysqli_query($kon,"delete from jasa where id='$_GET[id]'");
?>
<script type="text/javascript">
	alert('Jasa berhasil dihapus');
	window.location='jasa';
</script>