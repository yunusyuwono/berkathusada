<?php 
include 'nav.php';
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div id="main">
    <header class="">
        <a href="#" class="burger-btn d-block p-2">
            <i class="fas fa-bars"></i> Menu 
        </a>
    </header> 
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white p-3">
                        <b>Penggajian</b>
                    </div>
                    <div class="card-body text-dark">
                        <form id="fgaji">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Pilih Pegawai</label>
                                <select name="idpegawai" name="idpegawai" class="form-control" style="width:100%">
                                    <?php 
                                    $peg=mysqli_query($kon,"SELECT * from user order by nama asc");
                                    while($p=mysqli_fetch_array($peg))
                                    {
                                        ?>
                                        <option value="<?=$p['id'];?>"><?=$p['nama'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pilih Bulan</label>
                                <select name="bulan" name="bulan" class="form-control" style="width:100%">
                                    <?php 
                                    $bln=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    for($b=0;$b<12;$b++)
                                    {
                                        ?>
                                        <option value="<?=$b+1;?>" <?=(($b+1)==date('m'))?'selected':'';?>><?=$bln[$b];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pilih Tahun</label>
                                <select name="tahun" name="tahun" class="form-control" style="width:100%">
                                    <?php 
                                    for($t=2023;$t<=date('Y');$t++)
                                    {
                                        ?>
                                        <option value="<?=$t;?>" <?=($t==date('Y'))?'selected':'';?>><?=$t;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Potongan</label>
                                <input type="number" name="potongan" name="potongan" class="form-control form-control-sm" min="0" value="0">
                            </div>
                            <div class="form-group col-md-3">
                                <a class="btn btn-primary btn-sm mt-3 w-100" onclick="lihatgaji()" id="lgj">Lihat Gaji</a>
                            </div>
                        </div>
                        </form>

                        <div id="wgaji"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php 
include 'foot.php';
?>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('select').select2();
});
</script>

<script type="text/javascript">
    function lihatgaji(){
        fgaji=$('#fgaji').serialize();
        wgaji=$('#wgaji');
        $.ajax({
            url     : 'gaji.hitung.php',
            method  : 'POST',
            data    : fgaji,
            success : function (data){
                wgaji.html(data);
                cetakgaji('wgaji');
            }
        })
    }

    function cetakgaji(divName){
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script>