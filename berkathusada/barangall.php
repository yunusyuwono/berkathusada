<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Data Barang</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Data Barang</h4>
			</div>
			<div class="col-md-6" align="right">
				<div class="btn-group">
				<a class="btn btn-lg text-white" href="barang.import"><i class="fas fa-upload"></i></a>
				<a class="btn btn-lg text-white" data-bs-toggle="modal" data-bs-target="#mdlbarcode"><i class="fas fa-barcode "></i></a>
			</div>

			<div class="modal fade" id="mdlbarcode">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header p-1">
							<div class="col-11 text-dark" align="left">Barcode</div>
							<div class="col-1" align="right">
								<a class="btn btn-sm btn-dark" data-bs-dismiss="modal"><i class="fas fa-times"></i></a>
							</div>
						</div>
						<div class="modal-body p-1" align="left">
							<div class="form-group">
								<form action="barang.barcode" method="post" target="_blank">
								<label>Pilih Barang</label><br>
								<select name="pilpro[]" id="pilpro" class="js-example-basic-multiple form-control" style="width:100%" multiple="multiple">
									<option value="0">Semua</option>
									<?php 
									$brcode=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
									while($c=mysqli_fetch_array($brcode))
									{
										?>
										<option value="<?=$c['id'];?>"><?=$c['kode'].' '.$c['nama'];?></option>
										<?php
									}
									?>
								</select>
								<br>
								<button class="btn btn-sm btn-primary" name="ctkbarcode"><i class="fas fa-print"></i> Cetak Barcode</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>


			</div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class="table-responsive">
			<table id="example" class="table table-striped table-hover table-bordered table-responsive">
				<thead>
					<th>No.</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Jumlah Total</th>
					<th>Kadaluarsa</th>
					<th>Harga Beli</th>
					<th>Harga Jual</th>
					<th>Diskon</th>
					<th>Aksi</th>
				</thead>
				<?php 
				$barang=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
				$no=1;
				while ($b=mysqli_fetch_array($barang)) {
					?>
					<tr>
						<td><?=$no;?></td>
						<td><?=$b['kode'];?></td>
						<td><?=$b['nama'];?></td>
						<td><?=$b['jml'];?></td>
						<td><?=$b['ed'];?></td>
						<td align="right"><?="Rp. ".number_format($b['hargabeli'],0,',','.');?></td>
						<td align="right"><?="Rp. ".number_format($b['hargajual'],0,',','.');?></td>
						<td align="right"><?="Rp. ".number_format($b['diskon'],0,',','.');?></td>
						<td>
							<div class="btn-group">
								<a class="btn btn-sm btn-warning" data-bs-target="#edit<?=$b['id'];?>" data-bs-toggle="modal"><i class="fas fa-edit"></i></a>
								<a class="btn btn-sm btn-danger" href="barang.hapus?idbarang=<?=$b['id'];?>" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
							</div>
						</td>
					</tr>
					<div class="modal fade" id="edit<?=$b['id'];?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-dark">
									<span class="badge bg-light text-dark">Edit</span>
									<a class="text-white"><?=$b['kode'];?> <b><?=$b['nama'];?></b></a>
								</div>
								<div class="modal-body">
									<form method="post" action="barang.edit">
										<input type="hidden" name="idbarang" value="<?=$b['id'];?>">
										<div class="form-group">
											<label>Kode Barang</label>
											<input type="text" class="form-control" name="kode" value="<?=$b['kode'];?>" required>
										</div>
										<div class="form-group">
											<label>Nama Barang</label>
											<input type="text" class="form-control" name="nama" value="<?=$b['nama'];?>" required>
										</div>
										<div class="form-group">
											<label>Kadaluarsa</label>
											<input type="date" class="form-control" name="ed" value="<?=$b['ed'];?>" required>
										</div>
										<div class="form-group">
											<label>Harga Beli</label>
											<input type="number" class="form-control" name="hargabeli" value="<?=$b['hargabeli'];?>" required>
										</div>
										<div class="form-group">
											<label>Harga Jual</label>
											<input type="number" class="form-control" name="hargajual" value="<?=$b['hargajual'];?>" required>
										</div>
										<div class="form-group">
											<label>Diskon</label>
											<input type="number" class="form-control" name="diskon" value="<?=$b['diskon'];?>" min="0">
										</div>
										<div class="form-group" align="right">
											<button class="btn btn-sm btn-primary float-right" name="upd">Simpan</button>
											<a class="btn btn-sm btn-dark" data-bs-dismiss="modal">Batal</a>
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
			</table>
		</div>
	</div>
</div>

