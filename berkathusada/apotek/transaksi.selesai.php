<?php include "koneksi.php";
$nofaktur=$_GET['nofaktur'];

$gn=mysqli_fetch_array(mysqli_query($kon,"select * from apotek_trk where nofaktur='$nofaktur'"));
$tbtr=mysqli_query($kon,"select * from apotek_trkdetail where faktur='$nofaktur'");
while($r=mysqli_fetch_array($tbtr))
{
	$bar=mysqli_fetch_array(mysqli_query($kon,"select * from barang where kode='$r[kode]'"));
	if($gn['status']!='selesai')
	{
		$stok=$bar['jml_apotek']-$r['jml'];
	}
	else
	{
		$stok=$bar['jml_apotek'];
	}
	mysqli_query($kon,"update barang set jml_apotek='$stok' where kode='$bar[kode]'");

	//echo $bar['nama']."<br>";
	//echo "Stok awal : ".$bar['jml_apotek']."<br>";
	//echo "Jml Trk : ".$r['jml']."<br>";
	//echo "Sisa : ".$stok."<hr>";
}
mysqli_query($kon,"update apotek_trk set status='selesai' where nofaktur='$nofaktur'");





if(!isset($_GET['cetak']))
{
	header("location:transaksi");
}
else
{

$gp=mysqli_fetch_array(mysqli_query($kon,"select *,pelanggan.kode as kodeplg,pelanggan.nama as plgnama from pelanggan join apotek_trk on pelanggan.kode=apotek_trk.kodepasien where apotek_trk.nofaktur='$nofaktur'"));
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
				<?php if($gn['kodepasien']!=NULL){echo $gp['plgnama'];}?>
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
	


	$tbtrk=mysqli_query($kon,"select *,apotek_trkdetail.id as idbrgtrk,apotek_trkdetail.diskon as trkdiskon, apotek_trkdetail.jml as jmltrk from apotek_trkdetail join barang on apotek_trkdetail.kode=barang.kode where apotek_trkdetail.faktur='$nofaktur' order by apotek_trkdetail.id asc");
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
<?php }
?>