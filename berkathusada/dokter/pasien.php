<?php 
include 'nav.php';
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
                                        <li class="breadcrumb-item active  text-white" aria-current="page"><b>Pasien</b></li>
                                    </ol>
                                </nav>
                                <h4 class="text-white">Pasien</h4></div>
                            <div class="col-md-6" align="right">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-2">
                            <div id="cpasien">
                                <form method="post"  class="form-inline" id="formcpasien">
                                    <div class="input-group">
                                    <input type="search" name="cari" id="cari" class="form-control" placeholder="Cari Pasien">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="caripasien"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="pasiendata" class="table-responsive" onload="loadData()"></div>
                        </div>
                    </div>
                </div>
                <script src="../assets/js/jquery1-12.min.js"></script>
                <script>
                function callfpasien() {
                  var x = document.getElementById("fpasien");
                  if (x.style.display === "none") {
                    x.style.display = "block";
                  } else {
                    x.style.display = "none";
                  }
                }
                </script>
                <script type="text/javascript">
                function loadData(pasien,cari) {
                            $.ajax({
                                url: 'pasien.data.php',
                                type: 'get',
                                data:{pasien:pasien},
                                success: function(data) {
                                    $('#pasiendata').html(data);
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
                                        $("#pasiendata").show();
                                        var x = $(this).val();
                                        $.ajax(
                                            {
                                                type:'GET',
                                                url:'pasien.data.php',
                                                data: 'cari='+x,
                                                success:function(data)
                                                {
                                                    $("#pasiendata").html(data);
                                                }
                                                ,
                                            });
                                    });
                                });


                            </script>


                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#simpanpasien").click(function(){
                            var data= $("#formpasien").serialize();
                            $.ajax({
                                url:'pasien.aksi?a=save',
                                type:'post',
                                data:data,
                                success:function(data){
                                    alert(data);
                                    window.location='master?hal=pasien';
                                },error:function(response){
                                    console.log(data);
                                }
                            })
                        })
                    })
                </script>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#updpasien").click(function(){
                            var data= $("#formeditpasien").serialize();
                            $.ajax({
                                url:'pasien.aksi?a=edit',
                                type:'post',
                                data:data,
                                success:function(data){
                                    alert(data);
                                    window.location='master?hal=pasien';
                                },error:function(response){
                                    console.log(response.responseText);
                                }
                            })
                        })
                    })
                </script>
            </div>
        </section>
    </div>
</div>
<?php 
include 'foot.php';
?>