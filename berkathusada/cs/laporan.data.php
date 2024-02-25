<?php 
include 'koneksi.php';
?>
<table class="table table-striped table-hover table-bordered table-responsive">
    <thead>
        <th>No.</th>
        <th>Kode</th>
        <th>Dokter</th>
        <th>Tanggal Berobat</th>
        <th>Anamnesa</th>
        <th>Diagnosis</th>
        <th>Terapi</th>
        <th>Aksi</th>
    </thead>
    <?php 

    $riwayat=mysqli_query($kon,"select *,user.id,user.nama as dokter, user.status from riwayat join user on riwayat.iddokter=user.id where riwayat.idpasien='$idp' and user.status like '%Dokter%' order by riwayat.id desc");
    $no=1;
    while($r=mysqli_fetch_array($riwayat))
    {
        ?>
        <tr>
            <td><?=$no;?></td>
            <td><?=$r['kode'];?></td>
            <td><?=$r['dokter'];?></td>
            <td><?=$r['tgl'];?></td>
            <td><?=$r['anamnesa'];?></td>
            <td><?=$r['diagnosis'];?></td>
            <td><?=$r['terapi'];?></td>
            <td><a class="btn btn-sm btn-danger" href="berobat.hapus?idriwayat=<?=$r['id'];?>"><i class="fas fa-trash"></i></a></td>
        </tr>
        <?php
        $no++;
    }
    ?>
</table>