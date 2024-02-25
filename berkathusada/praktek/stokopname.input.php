<?php 
if(isset($_POST['simpan']))
{
	$tgl1=addslashes($_POST['tgl1']);
	$tgl2=addslashes($_POST['tgl2']);
	$lok=addslashes($_POST['lokasi']);

	$simpan=mysqli_query($kon,"insert into so_master (tgl1,tgl2,lokasi) values ('$tgl1','$tgl2','$lok')");
	if($simpan)
	{
		$gsm=mysqli_fetch_array(mysqli_query($kon,"select max(id) as idakhir from so_master where tgl1='$tgl1' and tgl2='$tgl2' and lokasi='$lok'"));
		if($lok=='Gudang/Centre')
		{
			$midkode='01';
		}
		elseif($lok=='Apotek')
		{
			$midkode='02';
		}
		elseif($lok=='Klinik')
		{
			$midkode='03';
		}
		elseif($lok=='Praktek')
		{
			$midkode='04';
		}
		$kode=date('ym').$midkode.sprintf("%02s",$gsm['idakhir']);
		mysqli_query($kon,"update so_master set kode='$kode' where id='$gsm[idakhir]'");

		?>
		<div class="alert alert-success">
			Stok Opname berhasil dibuat
		</div>
		<?php
	}
	else
	{
		?>
		<div class="alert alert-danger">
			Stok Opname gagal dibuat
		</div>
		<?php
	}
}
?>