<?php 
include "koneksi.php";
mysqli_query($kon,"delete from tindakan where id='$_GET[id]'");
?>
<script type="text/javascript">
	alert('Jasa berhasil dihapus');
	window.location='tindakan';
</script>