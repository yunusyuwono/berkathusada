<?php include "koneksi.php";
session_start();
$nofaktur=$_GET['nofaktur'];
mysqli_query($kon,"update klinik_trk set status='selesai' where nofaktur='$nofaktur'");
$gdf=mysqli_fetch_array(mysqli_query($kon,"SELECT * from klinik_trk where nofaktur='$nofaktur'"));
$gn=mysqli_fetch_array(mysqli_query($kon,"select * from klinik_trk where nofaktur='$nofaktur'"));
$tbtr=mysqli_query($kon,"select * from klinik_trkdetail where faktur='$nofaktur'");

if($gdf['status']!='selesai')
{
	while($r=mysqli_fetch_array($tbtr))
	{
		$bar=mysqli_fetch_array(mysqli_query($kon,"select * from barang where kode='$r[kode]'"));
		if($bar['kode']==$r['kode'])
		{
			$stok=$bar['jml_klinik']-$r['jml'];
			mysqli_query($kon,"update barang set jml_klinik='$stok' where kode='$bar[kode]'");
		}
		else
		{
			$stok=0;
		}
		/*
		echo $bar['kode']."<br>";
		echo $bar['nama']."<br>";
		echo "Stok awal : ".$bar['jml_klinik']."<br>";
		echo "Jml Trk : ".$r['jml']."<br>";
		echo "Sisa : ".$stok."<hr>";
		*/
	}
}


if(isset($_GET['tahap']))
{
	mysqli_query($kon,"UPDATE antrian set status='Selesai' where id='$_SESSION[aid]'");
}




if(!isset($_GET['cetak']))
{
	header("location:transaksi");
}
else
{

$gp=mysqli_fetch_array(mysqli_query($kon,"select *,pelanggan.kode as kodeplg,pelanggan.nama as plgnama from pelanggan join klinik_trk on pelanggan.kode=klinik_trk.kodepasien where klinik_trk.nofaktur='$nofaktur'"));
?>
<body onload="window.print()">
<center>

	KLINIK & APOTEK BERKAT HUSADA<br>
	MERPAS-KAUR-BENGKULU<br>
	Telp.+6282279558809 Fax.38964

<table border="0" width="58mm">
	<thead>
		<tr>
			<td colspan="6" nowrap="">
				-------------------------------------------------------<br>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				Pelanggan<br>
				<?php if($gp['plgnama']!=NULL){echo $gp['plgnama'];}?>
			</td>
			<td colspan="3" align="right">
				<?='#'.$nofaktur;?><br>
				<?=$gn['entri'];?>
			</td>
		</tr>
		<tr>
			<td colspan="6">
				-------------------------------------------------------<br>
			</td>
		</tr>
	</thead>
	<tbody>
	<?php 
	


	$tbtrk=mysqli_query($kon,"select *,klinik_trkdetail.id as idbrgtrk,klinik_trkdetail.diskon as trkdiskon, klinik_trkdetail.jml as jmltrk from klinik_trkdetail join barang on klinik_trkdetail.kode=barang.kode where klinik_trkdetail.faktur='$nofaktur' order by klinik_trkdetail.id asc");
	$total=0;
	while($b=mysqli_fetch_array($tbtrk))
	{
		?>
		<tr>
			<td colspan="6" width="100%"><?=$b['nama'];?></td>
		</tr>
		<tr>
			<td align="right" colspan="1">(<?=number_format($b['harga'],0,',','.');?></td>
			<td align="right">-</td>
			<td align="right"><?=number_format($b['trkdiskon'],0,',','.');?>)</td>
			<td align="right">X</td>
			<td align="right"><?=$b['jmltrk'];?></td>
			<td align="right"><?=number_format(($b['harga']-$b['trkdiskon'])*$b['jmltrk'],0,',','.');?></td>
		</tr>


	
		<?php
		$total=(($b['harga']-$b['trkdiskon'])*$b['jmltrk'])+$total;

	}


	?>
	<tr>
		<td colspan="6" class="bg-warning text-dark"><b>Jasa</b></td>
		</tr>
		<?php
		//Data jasa
		$cekjasa=mysqli_query($kon,"select *,klinik_trkdetail.id as idjasa,klinik_trkdetail.biaya as biayajasa, jasa.nama as namajasa from klinik_trkdetail join jasa on klinik_trkdetail.kode=jasa.kode where klinik_trkdetail.faktur='$nofaktur'");
		if(mysqli_num_rows($cekjasa)>0)
		{
			$jbjasa=0;
			while($cj=mysqli_fetch_array($cekjasa))
			{
				?>
				<tr>
					
					<td colspan="5"><?=$cj['namajasa'];?></td>
					<td align="right "><?=number_format($cj['biayajasa'],0,',','.');?></td>
				</tr>
				<?php	

				$jbjasa=$jbjasa+$cj['biayajasa'];

			}
			$total=$jbjasa+$total;			 
		}
		
		//Data Tindakan
		$cektindakan=mysqli_query($kon,"select *,klinik_trkdetail.id as idtindakan,klinik_trkdetail.biaya as biayatindakan, tindakan.nama as namatindakan from klinik_trkdetail join tindakan on klinik_trkdetail.kode=tindakan.kode where klinik_trkdetail.faktur='$nofaktur'");
		if(mysqli_num_rows($cektindakan)>0)
		{
			?>
			<tr>
				<td colspan="6" class="bg-warning text-dark"><b>Tindakan</b></td>
			</tr>

			<?php
			$jbtindakan=0;
			while($cj=mysqli_fetch_array($cektindakan))
			{
				?>
				<tr>
					<td colspan="5"><?=$cj['namatindakan'];?></td>
					<td align="right "><?=number_format($cj['biayatindakan'],0,',','.');?></td>
				</tr>
				<?php	

				$jbtindakan=$jbtindakan+$cj['biayatindakan'];

			}
			$total=$jbtindakan+$total;			 
		}

	?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="6">
				-------------------------------------------------------<br>
			</td>
		</tr>
		<tr>
			<td colspan="5" class="bg-primary text-white">Total Biaya</td>
			<td align="right">
				<?php
			echo "<b>".number_format($total,0,',','.')."</b>";
			?>
			</td>
		</tr>
		<?php
			if($gn['ppn']=='on')
			{
				$ppn=11/100;
				
				?>
				<tr>
					<td colspan="5" class="bg-primary text-white">PPN 11%</td>
					<td align="right">
						<?php echo number_format(($ppn*$total),0,',','.');?>
					</td>		
				</tr>
				<?php
				$total=($ppn*$total)+$total;
			} 



			?>
				<tr>
					<td colspan="5" class="bg-primary text-white">Admin</td>
					<td align="right">
						<?php echo number_format($gn['admin'],0,',','.');?>
					</td>		
				<tr>
				<?php
				$total=$total+$gn['admin'];
				?>
		<tr>
			<td colspan="5" class="bg-primary text-white">Total Biaya</td>
			<td align="right">
				<?php
			echo "<b>".number_format($total,0,',','.')."</b>";
			?>
			</td>
		</tr>
		<tr>
			<td colspan="6">
				-------------------------------------------------------
			</td>
		</tr>
		<tr>
			<td colspan="5">
				Pembayaran
			</td>
			<td align="right">
				<?php
				echo "<b>".number_format($gn['bayar'],0,',','.')."</b>";
				?>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				Kembalian
			</td>
			<td align="right">
				<?php
				echo "<b>".number_format(($gn['bayar']-$total),0,',','.')."</b>";
				?>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				Status Bayar
			</td>
			<td align="right">
				<b><?php
				echo strtoupper($gn['status_bayar']);
				?></b>
			</td>
		</tr>
		<tr>
			<td colspan="6">
				-------------------------------------------------------
			</td>
		</tr>
		<tr>
			<td colspan="6" align="center">
				SEMOGA LEKAS SEMBUH<br>BARANG YANG SUDAH DIBELI TIDAK DAPAT DITUKAR/DIKEMBALIKAN<br>
			</td>
		</tr>
	</tfoot>
</table>


	</center>
</tr>
</tfoot>
</table>
</center>
</body>
<?php

 }

?>