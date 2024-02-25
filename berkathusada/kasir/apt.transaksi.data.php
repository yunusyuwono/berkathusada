<table class="table table-responsive table-striped table-hover table-bordered" width="100%">
	<thead class="bg-primary text-white">
		<th width="5%">#</th>
		<th width="40%">Barang</th>
		<th>Harga</th>
		<th>Diskon</th>
		<th>Jumlah</th>
		<th>Biaya</th>
	</thead>
	<tbody>
	<?php 
	$gn=mysqli_fetch_array(mysqli_query($kon,"select * from apotek_trk where nofaktur='$nofaktur'"));


	$tbtrk=mysqli_query($kon,"select *,apotek_trkdetail.id as idbrgtrk,apotek_trkdetail.diskon as trkdiskon, apotek_trkdetail.jml as jmltrk from apotek_trkdetail join barang on apotek_trkdetail.kode=barang.kode where apotek_trkdetail.faktur='$nofaktur' order by apotek_trkdetail.id asc");
	$total=0;
	while($b=mysqli_fetch_array($tbtrk))
	{
		?>
		<tr>
			<td>
				<div class="btn-group">
					<a class="btn btn-sm btn-danger" href="apt.transaksi.hapus?id=<?=$b['idbrgtrk'];?>" title="Hapus"><i class="fas fa-trash"></i></a>
				</div>
			</td>
			<td><b style="font-size: 8pt;" class="btn btn-dark p-1"><?=$b['kode'];?></b>
				<b style="font-size: 8pt;" class="btn btn-secondary p-1"><?=$b['satuan'];?></b>
				<br><?=$b['nama'];?></td>
			<td align="right"><?=number_format($b['harga'],0,',','.');?></td>
			<td align="right"><?=number_format(($b['harga']-$b['trkdiskon']),0,',','.');?></td>
			<td align="right"><?=$b['jmltrk'];?></td>
			<td align="right"><?=number_format($b['trkdiskon']*$b['jmltrk'],0,',','.');?></td>
		</tr>


	
		<?php
		$total=($b['trkdiskon']*$b['jmltrk'])+$total;

	}
	?>
		<tr>
			<td colspan="6" class="bg-warning text-dark"><b>Jasa</b></td>
		</tr>
		<?php
		//Data jasa
		$cekjasa=mysqli_query($kon,"select *,apotek_trkdetail.id as idjasa,apotek_trkdetail.biaya as biayajasa, jasa.nama as namajasa from apotek_trkdetail join jasa on apotek_trkdetail.kode=jasa.kode where apotek_trkdetail.faktur='$nofaktur'");
		if(mysqli_num_rows($cekjasa)>0)
		{
			$jbjasa=0;
			while($cj=mysqli_fetch_array($cekjasa))
			{
				?>
				<tr>
					<td>
						<div class="btn-group">
						<a class="btn btn-sm btn-danger" href="apt.transaksi.hapus?id=<?=$cj['idjasa'];?>" title="Hapus"><i class="fas fa-trash"></i></a>
					</div>
					</td>
					<td colspan="4"><?=$cj['namajasa'];?></td>
					<td align="right "><?=number_format($cj['biayajasa'],0,',','.');?></td>
				</tr>
				<?php	

				$jbjasa=$jbjasa+$cj['biayajasa'];

			}
			$total=$jbjasa+$total;			 
		}



		?>
		<tr>
			<td colspan="6" class="bg-warning text-dark"><b>Tindakan</b></td>
		</tr>
		<?php
		//Data Tindakan
		$cektindakan=mysqli_query($kon,"select *,apotek_trkdetail.id as idtindakan,apotek_trkdetail.biaya as biayatindakan, tindakan.nama as namatindakan, apotek_trkdetail.jml as jmltindakan from apotek_trkdetail join tindakan on apotek_trkdetail.kode=tindakan.kode where apotek_trkdetail.faktur='$nofaktur'");
		if(mysqli_num_rows($cektindakan)>0)
		{
			$jbtindakan=0;
			while($cj=mysqli_fetch_array($cektindakan))
			{
				?>
				<tr>
					<td>
						<div class="btn-group">
						<a class="btn btn-sm btn-danger" href="apt.transaksi.hapus?id=<?=$cj['idtindakan'];?>" title="Hapus"><i class="fas fa-trash"></i></a>
					</div>
					</td>
					<td><?=$cj['namatindakan'];?></td>
					<td><?=number_format($cj['harga'],0,',','.');?></td>
					<td></td>
					<td><?=$cj['jmltindakan'];?></td>
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
		<?php
			if($gn['ppn']=='on')
			{
				$ppn=11/100;
				$total=($ppn*$total)+$total;
				?>
				<tr>
					<td colspan="5" class="bg-primary text-white">PPN 11%</td>
					<td align="right">
						<?php echo number_format(($ppn*$total),0,',','.');?>
					</td>		
				<?php
			} 

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
			<td colspan="5" class="bg-primary text-white">
				Biaya Admin
			</td>
			<td align="right" width="200">
					<form method="post" action="apt.transaksi.admin.php?nofaktur=<?=$nofaktur;?>">
						<div class="input-group">
							<input type="number" name="admin" style="text-align: right;" class="form-control" <?php if(!empty($gn['admin'])){echo "value='$gn[admin]'";}?> >
							<div class="input-group-append">
								<button class="btn btn-primary" name="sadmin"><i class="fas fa-save"></i></button>
							</div>
						</div>
					</form>
					<?php 
					$total=$total+$gn['admin'];
					?>
				</td>	
		</tr>
		<tr>
			<td colspan="5" class="bg-primary text-white">Total Biaya + Admin</td>
			<td align="right">
				<?php
			echo "<b>".number_format($total,0,',','.')."</b>";
			?>
			</td>
		</tr>
	</tfoot>
</table>

	<div class="container p-1 pb-2">
		<div class="btn-group">
		<a class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#ptrk<?=$nofaktur;?>" title="Pilih Pelanggan"><i class="fas fa-plus-circle"></i> Pilih Pelanggan
			<?php
			$gp=mysqli_fetch_array(mysqli_query($kon,"select *,pelanggan.kode as kodeplg,pelanggan.nama as plgnama from pelanggan join apotek_trk on pelanggan.kode=apotek_trk.kodepasien where apotek_trk.nofaktur='$nofaktur'")); 
			if(!empty($gp['kodeplg']))
			{
				
				echo ' : '.$gp['plgnama'];
			}
			?>
		</a>
			<?php 
			if(!empty($gp['kodeplg']))
			{
				?>
				<a href="apt.transaksi.plg.reset?nofaktur=<?=$nofaktur;?>" class="btn btn-danger btn-sm" title="Reset Pelanggan"><i class="fas fa-trash"></i></a> 
				<?php
			}
			?>
		</div>

		<div class="btn-group">
			<?php 
			

			if($gn['ppn']=='on')
			{
				$bon="btn-success";
				$bof="btn-outline-danger";
			}
			elseif ($gn['ppn']=='off') 
			{
				$bon="btn-outline-success";
				$bof="btn-danger";
			}
			else
			{
				$bon="btn-outline-success";
				$bof="btn-outline-danger";
			}
			?>
			<a class="btn btn-sm <?=$bon;?>" href="apt.transaksi.ppn?nofaktur=<?=$nofaktur;?>&ppn=on" title="PPN ON"> PPN ON</a>

			<?php 
			if(!$gn['ppn']=='')
				{
			?>
			<a class="btn btn-sm <?=$bof;?>" href="apt.transaksi.ppn?nofaktur=<?=$nofaktur;?>&ppn=off" title="PPN OFF"> PPN OFF</a>
			<?php 
				}
			?>
		</div>
	</div>
<form method="post" action="apt.transaksi.bayar.php">
<table class="table table-responsive table-striped table-hover table-bordered" width="100%">
	
	<tr>
		<td>Pembayaran</td>
		<td>
			<input type="hidden" name="nofaktur" value="<?=$nofaktur;?>">
			<input type="hidden" name="total" id="totalbayar" value="<?=$total;?>">
			<input type="number" name="bayar" id="bayar" class="form-control" style="text-align: right;" onclick="reset()" onkeyup="bayartrk()" onload="bayartrk()" value="<?=$gn['bayar'];?>">
			</form>
		</td>
		<td>Kembalian</td>
		<td>
			<input type="number" readonly name="kembali" id="kembali" class="form-control" style="text-align: right;" value="<?php echo $gn['bayar']-$total;?>">
		</td>
		
		<td  align="right">
			<button  class="btn btn-sm btn-primary" name="tblbayar">Bayar</button>
			<?php 
			if($gn['bayar']>=$total)
			{
				echo '<a class="btn btn-sm btn-success" title="Lunas"><i class="fas fa-check"></i></a>';
			}
			elseif($gn['bayar']<$total)
			{
				echo '<a class="btn btn-sm btn-warning" title="Hutang"><i class="fas fa-list"></i></a>';
			}
			?>
		</td>
	</tr>
</table>
	</form>

<div class="modal fade" id="ptrk<?=$nofaktur;?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">Pilih Pelanggan</div>
			<div class="modal-body">
				<form method="post" action="apt.transaksi.pelanggan">
					<div class="form-group">
						<input type="hidden" name="nofaktur" value="<?=$nofaktur;?>">
						<label>Pilih Pelanggan</label>
						<select class="form-control" name="plg">
							<?php 
							$plg=mysqli_query($kon,"select * from pelanggan");
							while($p=mysqli_fetch_array($plg))
							{
								?>
								<option value="<?=$p['kode'];?>" <?=isset($gp['kodeplg'])?($p['kode']==$gp['kodeplg'])?"selected":'':''; ?> ><?=$p['nama'];?></option>
								<?php
							}
							?>	
						</select>
					</div>
					<div class="form-group" align="center">
						<button name="simpanplg" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function reset(){
      valbayar = '';
      $('#bayar').val(valbayar);
    }
        function bayartrk(){
              var total	= $("#totalbayar").val();
              var bayar	= $("#bayar").val();
              subt = bayar-total;
              $('#kembali').val(subt);
              if(bayar<total){
              	document.getElementById('hutang').className="alert-warning p-1";
              	$('#hutang').text('Masuk ke Hutang');
              	var statusbayar='hutang';
              }
              else{
              	document.getElementById('hutang').className="alert-success p-1";
              	$('#hutang').text('Lunas');	
              	var statusbayar='lunas';
              }

              document.getElementById('tblbayar').style.display='block';
            }
    </script>