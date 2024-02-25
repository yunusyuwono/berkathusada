<link rel="stylesheet" href="assets/css/bootstrap.css">
<body onload="window.print()">
<div class="row p-3 bg-white">
<?php include "koneksi.php";
$pro=$_POST['pilpro'];
for ($i=0; $i <count($pro) ; $i++) { 
	if($pro[$i]==0)
	{
		$prod=mysqli_query($kon,"SELECT * from barang where status='STOK' order by nama asc");
	}
	else
	{
		$prod=mysqli_query($kon,"SELECT * from barang where status='STOK' and id='$pro[$i]'");
	}

	while($p=mysqli_fetch_array($prod))
	{
		$tempdir="assets/barcode/";
		$kode=$p['kode'];
		if (!file_exists($tempdir))	mkdir($tempdir, 0755);
		$target_path=$tempdir . $kode . ".png";
		$fileImage="http://localhost".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode . "&codetype=code128&print=true&size=40";

		/*get content from url*/
		$content=file_get_contents($fileImage);

		/*save file */
		file_put_contents($target_path, $content);

		echo "
			<div class='col-sm-2 p-1' style='text-align:center;font-size:8pt'>
			".$p['nama']."<br>
			<img src='barcode.php?text=" . $kode. "&codetype=code128&print=true&size=28' />
			</div>
		";

	}
}
?>
</div>
</body>
<script src="assets/datatables/media/js/jquery.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>