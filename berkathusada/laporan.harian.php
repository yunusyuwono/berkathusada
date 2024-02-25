<?php 
include "koneksi.php";
$sp=isset($_POST['sp'])?$_POST['sp']:date('Y-m-d');

?>

<div class="alert alert-light">
    <b>Laporan Pemasukan untuk tanggal <?=$sp;?></b>
</div>
<small>*Sudah termasuk PPN + Admin</small>
<div class="list-group">
<div class="list-group-item">
    <div class="row">
    
    <div class="col-md-6">Klinik</div>
    <?php
    $kt=0;
    $kti=mysqli_query($kon,"SELECT * from klinik_trk where status='selesai' and tglfaktur='$sp'");
    while($k=mysqli_fetch_array($kti))
    {
        $kd=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(biaya) as tb from klinik_trkdetail where faktur='$k[nofaktur]'"));
        $ppn=($k['ppn']=='on')?($kd['tb']*11/100):0;
        $adm=($k['admin']!=NULL)?($k['admin']):0;
        $bt=$kd['tb']+$ppn+$adm;
        //echo $k['faktur'].' '.$kd['tb'].'+'.$ppn.'+'.$adm.'<br>';
        $kt=$kt+$bt;
    }
    
    ?>
    <div class="col-md-6" align="right">Rp. <?=number_format($kt,0,',','.');?></div>
    </div>
</div>

<div class="list-group-item">
    <div class="row">
    <div class="col-md-6">Apotek</div>
    <?php
    $at=0;
    $ati=mysqli_query($kon,"SELECT * from apotek_trk where status='selesai' and tglfaktur='$sp'");
    while($k=mysqli_fetch_array($ati))
    {
        $kd=mysqli_fetch_array(mysqli_query($kon,"SELECT *,sum(biaya) as tb from apotek_trkdetail where faktur='$k[nofaktur]'"));
        $ppn=($k['ppn']=='on')?($kd['tb']*11/100):0;
        $adm=($k['admin']!=NULL)?($k['admin']):0;
        $bt=$kd['tb']+$ppn+$adm;
        //echo $k['faktur'].' '.$kd['tb'].'+'.$ppn.'+'.$adm.'<br>';
        $at=$at+$bt;
    }
    
    ?>
    <div class="col-md-6" align="right">Rp. <?=number_format($at,0,',','.');?></div>
    </div>
</div>

<div class="list-group-item">
    <div class="row">
    <div class="col-md-12"><b>Poli</b></div>
    </div>
</div>

<?php 
$poli=mysqli_query($kon,"SELECT *,user.id as idus from poli join user on poli.iddokter=user.id");
while($p=mysqli_fetch_array($poli))
{
    ?>
    <div class="list-group-item">
        <div class="row">
        <div class="col-md-6">
            <?=$p['poli'];?><br>

            <?=($p['gelar1']!=NULL)?$p['gelar1'].'. ':'';?>
            <?=$p['nama'];?>
            <?=($p['gelar2']!=NULL)?','.$p['gelar2'].'.':'';?>
            
        </div>
        <?php 
        $fr=mysqli_num_rows(mysqli_query($kon,"SELECT * from riwayat where iddokter='$p[idus]' and tgl='$sp' group by idpasien"));
        ?>

        <div class="col-md-6" align="right"><?=$fr;?></div>
        </div>
    </div>
    <?php 
}
?>
</div>