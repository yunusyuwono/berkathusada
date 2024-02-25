
function hitung(){
      var jml 	= $("#jumlah").val();
      var harga	= $("#harga").val();
      var dis 	= $("#diskon").val();
      subt = (harga-dis)*jml;
      $('#total').val(subt);
    }


function reset(){
      valkode = '';
      $('#total').val(valkode);
    }


function isi_otomatis(){
        var kode = $("#kode").val();
        $.ajax({
            url: 'barangdist.getbarang.php',
            data:"kode="+kode
        }).success(function (data) {
            console.log(data);
            var json = data,
            obj = JSON.parse(json);
            $('#nama').val(obj.nama);
            $('#jml').val(obj.jml);
            $('#jml_apotek').val(obj.jml_apotek);
            $('#jml_klinik').val(obj.jml_klinik);
            $('#jml_praktek').val(obj.jml_praktek);
            $('#total').val(obj.total);
            $("#jmlsberi").val(obj.jml);
            $("#jml_kliniksberi").val(obj.jml_klinik);
            $("#jml_apoteksberi").val(obj.jml_apotek);

        });
    }

    function newdist(){
        var jml=$('#jml').val();
        var jml_apotek = $('#jml_apotek').val();
        var jml_klinik = $('#jml_klinik').val();
        var dari = $("#dari").val();
        var ke = $("#ke").val();
        var beri = $("#beri").val();
        var jmlsberi = $("#jmlsberi").val();
        var jml_kliniksberi = $("#jml_kliniksberi").val();
        var jml_apoteksberi = $("#jml_apoteksberi").val();
        var totalsberi = $("#totalsberi").val();


        if(dari=='Gudang'){
            jmlsberi = jml-beri;
        }
        else if(dari=='Apotek'){
            jml_apoteksberi = jml_apotek-beri;
        }
        else if(dari=='Klinik'){
            jml_kliniksberi = jml_klinik-beri;
        }

    }

function cekstok(){
        var kode = $("#kode").val();
        $.ajax({
            url: 'barangdist.getbarang.php',
            data:"kode="+kode,
        }).success(function (data) {
            console.log(data);
            var json = data;
            var jml = $("#jumlah").val();
            obj = JSON.parse(json);
            if(jml > obj.jml_apotek)
            {
            	alert('Stok tidak mencukupi');
                $("#jumlah").val(0);
                $("#total").val(0);
            }
        });
    }


