
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
            url: 'getbarang.php',
            data:"kode="+kode
        }).success(function (data) {
            console.log(data);
            var json = data,
            obj = JSON.parse(json);
            $('#nama').val(obj.nama);
            $('#harga').val(obj.harga);
            $('#diskon').val(obj.diskon);

        });
    }

function cekstok(){
        var kode = $("#kode").val();
        $.ajax({
            url: 'getbarang.php',
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


