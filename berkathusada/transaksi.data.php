<?php include "koneksi.php";
$nofaktur=$_GET["nofaktur"];
$gno=mysqli_fetch_array(mysqli_query($kon,"select * from barangmasuk where nofaktur='$nofaktur'"));
?>
<div class="row">
	<div class="btn btn-sm btn-primary col-md-6" onclick="printDiv('fakturmasuk')">Cetak</div>
	<a class="btn btn-sm btn-outline-primary  col-md-6" href="barang?hal=barangmasuk"><i class="fas fa-caret-left"></i> Kembali</a>
</div>
<br/>
<div class="table-responsive" id="fakturmasuk">

<table class="table table-striped table-hover table-bordered" id="example">
	<thead>
		<th>No.</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		<th>Kadaluarsa</th>
		<th>Harga Beli</th>
		<th>Harga Jual</th>
		<th>Diskon</th>
		<th>Biaya</th>		
	</thead>
	<?php 
	$nofaktur=$_GET["nofaktur"];
	$no=1;
	if($gno['status']!='D')
	{
		$gtr=mysqli_query($kon,"select * from barang where nofaktur='$nofaktur'");
	}
	else
	{
		$gtr=mysqli_query($kon,"select * from barangtrkmasuk where nofaktur='$nofaktur'");
	}
	$total=0;
	while($g=mysqli_fetch_array($gtr))
	{
		?>
		<tr style="font-size:10pt">

			<td>
				<?=$no;?>
				<?php 
				 $gno=mysqli_fetch_array(mysqli_query($kon,"select * from barangmasuk where nofaktur='$nofaktur'"));
				if($gno['status']!='D')
				{
					?>
					<div class="btn-group">
						<a class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $g['id'];?>" title="Edit"><i class="fas fa-edit"></i></a>
						<a class="btn btn-danger btn-sm" href="transaksi.aksi?a=del&id=<?php echo $g['id'];?>&nofaktur=<?php echo $nofaktur;?>" title="Hapus"><i class="fas fa-trash"></i></a>
					</div>

					</td>
					<?php 
				}
				?>
			
			<td><?php echo $g['kode'];?></td>
			<td><?php echo $g['nama'];?></td>
			<td><?php echo $g['satuan'];?></td>
			<td align="center"><?php echo $g['jml'];?></td>
			<td><?php echo $g['ed'];?></td>
			<td align="right"><?php echo number_format($g['hargabeli'],0,',','.');?></td>
			<td align="right"><?php echo number_format($g['hargajual'],0,',','.');?></td>
			<td align="right"><?php echo number_format($g['diskon'],0,',','.');?></td>
			<td align="right"><?php $tbiaya=$g['hargabeli']*$g['jml']; 
				echo number_format($tbiaya,0,',','.');?></td>
			<?php 
			$total=$tbiaya+$total;

			?>
		</tr>
		

		<div class="modal fade" id="edit<?php echo $g['id'];?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">Edit Transaksi
						<span class="float-right">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</span>
					</div>
					<div class="modal-body">
						<form method="post" action="transaksi.aksi?a=edit">
							<div class="row ">
								<?php 
								$edit=mysqli_fetch_array(mysqli_query($kon,"select * from barang where nofaktur='$nofaktur' and id='$g[id]'"));
								?>
                                <div class="form-group col-md-3">
                                    <input type="hidden" name="nofaktur" value="<?php echo $nofaktur;?>">
                                    <input type="hidden" name="idtrk" value="<?php echo $g['id'];?>">
                                    <label>Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" id="kode" placeholder="Kode Barang" autofocus value="<?php echo $edit['kode'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Barang</label>
                                    <input type="nama" name="nama" class="form-control" id="nama"  value="<?php echo $edit['nama'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan" class="form-control" id="satuan"  value="<?php echo $edit['satuan'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jumlah Barang</label>
                                    <input type="number" name="jml" onkeyup="hitung()" class="form-control" id="jml" placeholder="Jumlah Barang"  value="<?php echo $edit['jml'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Expired Date</label>
                                    <input type="date" name="ed" class="form-control" id="ed"  value="<?php echo $edit['ed'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Harga Beli</label>
                                    <input type="number" name="hargabeli" class="form-control" id="hargabeli" placeholder="Harga Beli" onkeyup="hitung()"   value="<?php echo $edit['hargabeli'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Harga Jual</label>
                                    <input type="number" name="hargajual" class="form-control" id="hargajual" placeholder="Harga Jual"   value="<?php echo $edit['hargajual'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Diskon</label>
                                    <input type="number" name="diskon" class="form-control" onkeyup="hitung()" id="diskon" placeholder="Diskon"   value="<?php echo $edit['diskon'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <br>
                                    <button class="btn btn-sm btn-primary" id="simpan" name="simpan"><i class="fas fa-save"></i> Simpan</button>

                                </div>
                            </div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
		$no++;	
	}
	?>
	<tfoot>
			<tr>
				<td colspan="9">Total Tagihan</td>
				<td align="right"><b><?php echo number_format($total,0,',','.');?></b></td>
			</tr>
		</tfoot>
</table>


</div>
<div class="btn-group">
	<?php 
	if($gno['status']!='D')
	{
		?>
	<a class="btn btn-sm btn-outline-primary btn-block" href="transaksi.selesai?nofaktur=<?=$nofaktur;?>"><i class="fas fa-check"></i> Selesai Transaksi</a>

	<?php 
	}
	?>
	
</div>

<script type="text/javascript">
        function hitung(){
              var jml =  $("#jml").val();
              var hb = $("#hargabeli").val();
              subt = hb*jml;
              $('#hargatotal').val(subt);
            }
    </script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


