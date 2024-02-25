<div class="card">
	<div class="card-header bg-primary text-white">
		<div class="row">
			<div class="col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
						<li class="breadcrumb-item active  text-white" aria-current="page"><b>Data Barang Kadaluarsa</b></li>
					</ol>
				</nav>
				<h4 class="text-white">Data Barang Kadaluarsa</h4></div>
		</div>
	</div>
	<div class="card-body mt-2">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-responsive">
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
				$tglskrg=date_create();
				//$tgl5bln=date('Y-m-d',strtotime('5 months',strtotime($tglskrg)));
				
				$barang=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
				$no=1;
				while ($b=mysqli_fetch_array($barang)) {
					$tgls=date_diff($tglskrg,date_create($b['ed']));
					$sm=$tgls->m;
					$st=$tgls->y;
					if($st==0 && $sm<=5)
						{
						?>
						<tr>
							<td><?=$no;?></td>
							<td><?=$b['kode'];?></td>
							<td><?=$b['nama'];?></td>
							<td><?=$b['jml'];?></td>
							<td><?=$b['ed'];?>
								<div class="btn btn-sm btn-dark"><?php echo $tgls->m.' bulan lagi';?></div>
							</td>
							<td align="right"><?="Rp. ".number_format($b['hargabeli'],0,',','.');?></td>
							<td align="right"><?="Rp. ".number_format($b['hargajual'],0,',','.');?></td>
							<td align="right"><?="Rp. ".number_format($b['diskon'],0,',','.');?></td>
							<td>
								<div class="btn-group">
									<a class="btn btn-sm btn-warning" data-bs-target="#<?=$b['id'];?>" data-bs-toggle="modal"><i class="fas fa-edit"></i></a>
									<a class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
								</div>
							</td>
						</tr>
						<?php
						$no++;
						}
					
					}
				?>
			</table>
		</div>
	</div>
</div>