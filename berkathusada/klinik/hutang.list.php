<?php 
include 'koneksi.php';
if(isset($_GET['cari']))
{
	$cari=addslashes($_GET['cari']);
}
?>
<div id="Transaksidata">
<table id="Transaksidata" class="table table-responsive table-striped table-bordered" style="width: 100%;">
<thead class="bg-light">
	<th>No.</th>
	<th>No. Faktur</th>
	<th>Pelanggan</th>
	<th>Tanggal</th>	
	<th>Jumlah Varian</th>
	<th>PPN 11%</th>
	<th>Total Biaya (Rp.)</th>
	<th>Total Bayar (Rp.)</th>
	<th>Kekurangan (Rp.)</th>
	<th>Aksi</th>
</thead>
<?php 
$no=1;


if(!isset($_GET['cari']))
{
	$trkklinik=mysqli_query($kon,"select * from klinik_trk where status='selesai' and status_bayar='hutang' order by entri desc");
	if(mysqli_num_rows($trkklinik)==0)
	{
		echo "<td colspan='7'>Data transaksi belum tersedia</td>";
	}
}
else
{
	$trkklinik=mysqli_query($kon,"select * from klinik_trk where status='selesai' and status_bayar='hutang' and nofaktur like '%$cari%' or status='selesai' and tglfaktur like '%$cari%' and status_bayar='hutang'  order by entri desc");
	if(mysqli_num_rows($trkklinik)==0)
	{
		echo "<td colspan='7'>Data transaksi yang anda cari tidak ditemukan</td>";
	}
}


	while($t=mysqli_fetch_array($trkklinik))
	{
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $t['nofaktur'];?></td>
			<?php 
			$pas=mysqli_fetch_array(mysqli_query($kon,"select * from pelanggan where kode='$t[kodepasien]'"));
			?>
			<td><?php echo $pas['nama'];?></td>
			<td><?php echo $t['tglfaktur'];?></td>
			<?php 
			$ctb=mysqli_query($kon,"select * from klinik_trkdetail where faktur='$t[nofaktur]'");
			$total=0;
			while($c=mysqli_fetch_array($ctb))
			{	
				$total=(($c['harga']-$c['diskon'])*$c['jml'])+$total;
			}

			if($t['ppn']=='on')
			{
				$total=(11/100*$total)+$total;
				$ppnicon="<i class='fas fa-check text-success'></i>";
			}
			else
			{
				$total=$total;
				$ppnicon="<i class='fas fa-times text-danger'></i>";
			}

			$j=mysqli_fetch_array(mysqli_query($kon,"select *,count(kode) as jmlvar from klinik_trkdetail where faktur='$t[nofaktur]'"));
			?>
			<td><?=$j['jmlvar'];?></td>
			<td><?=$ppnicon;?></td>
			<td align="right"><?=number_format($total,0,',','.');?></td>
			<td align="right"><?=number_format($t['bayar'],0,',','.');?></td>
			<td align="right"><?=number_format(($total-$t['bayar']),0,',','.');?></td>
			
			<td>
				<div class="btn-group">
				<a class="btn btn-sm btn-primary" href="hutang.list.detail?nofaktur=<?php echo $t['nofaktur'];?>" title="Detail faktur"><i class="fas fa-list-alt"></i></a>
				<a class="btn btn-sm btn-success" href="transaksi.selesai?nofaktur=<?php echo $t['nofaktur'];?>&cetak" title="Cetak faktur"><i class="fas fa-print"></i></a>
				</div>
			</td>
		</tr>
		<?php
		$no++;
	}
?>

</table>
</div>