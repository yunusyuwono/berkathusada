<?php 
$id=$_GET['id'];
$idp=$_GET['idp'];
include 'koneksi.php';
mysqli_query($kon,"DELETE FROM rtj where id = '$id'");

?>
<script type="text/javascript">
	alert('Layanan berhasil dihapus');
	window.location='berobat.jasatindakan?id=<?=$idp;?>';
</script>