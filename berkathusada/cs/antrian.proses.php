<?php 
include "koneksi.php";

if(isset($_GET['tahap']))
{
	switch ($_GET['tahap']) {
		case 'Menunggu':
			$sb='Dokter';
			break;
		case 'Dokter':
			$sb='Apotek';
			break;
		case 'Apotek':
			$sb='Selesai';
			break;
		case 'Batal':
			$sb='Batal';
			break;
		default:
			break;
	}

	mysqli_query($kon,"update antrian set status='$sb' where id='$_GET[id]'");
	$ca=mysqli_fetch_array(mysqli_query($kon,"select * from antrian where id='$_GET[id]'"));
	?>
	<script type="text/javascript">
		alert('Antrian telah diperbarui menjadi <?=$ca['status'];?>');window.location='antrian';
	</script>
	<?php
}
?>