<?php 
include 'nav.php';
if(isset($_GET['nofaktur']))
{
    $nofaktur=$_GET['nofaktur'];
}
else
{
    ?>
    <script type="text/javascript">
        alert('Nomor Faktur tidak terdeteksi');
        window.location='barang?hal=barangmasuk';
    </script>
    <?php
}
?>
<div id="main">
    <header class="">
        <a href="#" class="burger-btn d-block p-2">
            <i class="fas fa-bars"></i> Menu 
        </a>
    </header> 
    <div class="page-content">
        <section class="row">
            <div class="col-12 mt-1 mb-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="text-white">Barang</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="text-white">Transaksi</a></li>                                        
                                        <li class="breadcrumb-item active  text-white" aria-current="page"><b>Transaksi Barang Masuk</b></li>
                                    </ol>
                                </nav>
                                <h4 class="text-white">Transaksi Barang Masuk <?php echo '#'.$nofaktur;?></h4></div>
                        </div>
                    </div>
                    <div class="card-body mt-2">
                            <div id="ftransaksi">
                                <?php 
                                $gno=mysqli_fetch_array(mysqli_query($kon,"select * from barangmasuk where nofaktur='$nofaktur'"));
                                if($gno['status']!='D')
                                {
                                ?>
                                <form method="post" id="formtransaksi" action="transaksi.aksi?a=simpan">
                                    <div class="row ">
                                        <div class="form-group col-md-3">
                                            <input type="hidden" name="nofaktur" value="<?php echo $nofaktur;?>">
                                            <label>Kode Barang</label>
                                            <input list="barang" class="form-control" placeholder="Cari dengan Kode atau Nama Barang" onclick="reset()" name="kode" autofocus id="kode" onkeyup="isi_otomatis()" onchange="isi_otomatis()">
                                            <datalist id="barang">
                                                <?php 
                                                $tbarang=mysqli_query($kon,"select * from barang where status='STOK' order by nama asc");
                                                while($t=mysqli_fetch_array($tbarang))
                                                {
                                                    ?>
                                                    <option value="<?=$t['kode'];?>"><?=$t['kode'];?>  <?=$t['nama'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Nama Barang</label>
                                            <input type="nama" name="nama" class="form-control" id="nama" placeholder="Nama Barang">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Satuan</label>
                                            <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Satuan">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Jumlah Barang</label>
                                            <input type="number" name="jml" onkeyup="hitung()" class="form-control" id="jml" placeholder="Jumlah Barang" value="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Expired Date</label>
                                            <input type="date" name="ed" class="form-control" id="ed" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Harga Beli</label>
                                            <input type="number" name="hargabeli" class="form-control" id="hargabeli" placeholder="Harga Beli"  value="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Harga Jual</label>
                                            <input type="number" name="hargajual" onkeyup="hitung()" class="form-control" id="hargajual" placeholder="Harga Jual"  value="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Diskon</label>
                                            <input type="number" name="diskon" class="form-control" id="diskon" placeholder="Diskon"  value="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Harga Total</label>
                                            <input type="number" name="hargatotal" class="form-control" id="hargatotal" placeholder="Harga Total" readonly  value="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <br>
                                            <a class="btn btn-sm btn-primary" id="simpan" name="simpan"><i class="fas fa-save"></i> Tambah</a>
                                        </div>
                                    </div>  
                                </form>
                                <?php 

                            }
                            else
                            {
                                echo "Faktur telah terselesaikan.";
                            }
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="card card-body shadow" id="tabtransaksi">
                        
                    </div>  
            </div>
        </section>
    </div>
</div>
<?php include 'foot.php';?>
<script src="assets/js/jquery1-12.min.js"></script>
    <script type="text/javascript">
        function isi_otomatis(){
                var kode = $("#kode").val();
                $.ajax({
                    url: 'getbarang.php',
                    data:"kode="+kode,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#nama').val(obj.nama);
                    $('#satuan').val(obj.satuan);
                    $('#ed').val(obj.ed);
                    $('#hargabeli').val(obj.hargabeli);
                    $('#hargajual').val(obj.hargajual);
                    $('#diskon').val(obj.diskon);
                });
            }
</script>
<script type="text/javascript">
 $(document).ready(function(){
    $("#simpan").click(function(){
      var data = $('#formtransaksi').serialize();
      $.ajax({
        type: 'POST',
        url: "transaksi.aksi?a=simpan",
        data: data,
         success: function(data) {
                        loadData();
                        alert('Berhasil');
                    }
                });
              });
            });
            
</script>
<script type="text/javascript">
        function hitung(){
              var jml =  $("#jml").val();
              var hb = $("#hargabeli").val();
              subt = hb*jml;
              $('#hargatotal').val(subt);
            }
    </script>
<script type="text/javascript">
function loadData() {
            $.ajax({
                url: 'transaksi.data.php',
                type: 'get',
                data:{nofaktur:'<?=$nofaktur;?>'},
                success: function(data) {
                    $('#tabtransaksi').html(data);
                }
            });
        }
        
  $(document).ready(function() {
        loadData();
    })
  </script>

   <script>
                $(document).ready(function(e)
                {
                    $("#cari").keyup(function()
                    {
                        $("#transaksidata").show();
                        var x = $(this).val();
                        $.ajax(
                            {
                                type:'GET',
                                url:'transaksi.data.php',
                                data: 'cari='+x,
                                success:function(data)
                                {
                                    $("#transaksidata").html(data);
                                }
                                ,
                            });
                    });
                });


            </script>