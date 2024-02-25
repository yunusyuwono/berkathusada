<?php 
if(isset($_POST['update']))
{
	$id=$_POST['id'];
	$jt=addslashes($_POST['jt']);
	$jk=addslashes($_POST['jk']);
	$ja=addslashes($_POST['ja']);

	$jta=$jt-$jk-$ja;

	
	if($jk > $jt)
	{
		?>
		<div class="alert alert-warning text-dark">Distribusi tidak sesuai</div>
		<?php
	}
	elseif($ja > $jt)
	{
		?>
		<div class="alert alert-warning text-dark">Distribusi tidak sesuai</div>
		<?php	
	}
	else
	{
		$updis=mysqli_query($kon,"update barang set jml='$jta',jml_klinik='$jk',jml_apotek='$ja' where id='$id'");
		if($updis)
		{
			?>
			<div class="alert alert-success text-dark">Distribusi Berhasil</div>
			<?php			
		}
		else
		{
			?>
			<div class="alert alert-danger text-dark">Distribusi gagal</div>
			<?php		
		}
	}
}
?>