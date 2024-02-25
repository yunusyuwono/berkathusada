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
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="text-white">Import Data Barang</h4>
                    </div>
                    <div class="col-lg-6" align="right">

                        <a href="barang?hal=barangall" class="btn btn-primary"><i class="fas fa-caret-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php 
                $output = '';
if(isset($_POST["import"]))
{
    $fileex=$_FILES['excel']['name'];
 $exten = explode(".",$fileex); // For getting Extension of selected file
 $extension=end($exten);
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file

  include("import/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<div id='copy'><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
    $no=1;
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $nofaktur   = mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $kode       = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(1, $row)->getValue())," ");
    $nama       = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(2, $row)->getValue())," ");
    $jml        = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(3, $row)->getValue())," ");
    $jml_klinik = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(4, $row)->getValue())," ");
    $jml_apotek = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(5, $row)->getValue())," ");
    $ed         = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(6, $row)->getValue())," ");
    $hargabeli  = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(7, $row)->getValue())," ");
    $hargajual  = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(8, $row)->getValue())," ");
    $satuan     = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(9, $row)->getValue())," ");
    $diskon     = trim(mysqli_real_escape_string($kon, $worksheet->getCellByColumnAndRow(10, $row)->getValue())," ");
    if(!empty($kode)) // if none of the data are empty
    {

        $ck=mysqli_fetch_array(mysqli_query($kon,"SELECT * from barang where kode='$kode'"));
      
            if(isset($ck['kode']))
            {
                $tjg=$ck['jml']+$jml;
                $tjk=$ck['jml_klinik']+$jml_klinik;
                $tja=$ck['jml_apotek']+$jml_apotek;
                $output .= '<tr style="background-color:white;color:black"><td colspan="3">Barang sudah tersedia. Jumlah stok akan diakumulasikan</td></tr>';
                $query=mysqli_query($kon,"UPDATE barang SET jml='$tjg',jml_klinik='$tjk',jml_apotek='$tja' where kode='$ck[kode]'");
            }
            else
            {
                $query=mysqli_query($kon,"INSERT into barang (nofaktur,kode,nama,jml,jml_klinik,jml_apotek,ed,hargabeli,hargajual,       satuan,diskon,status) values ('$nofaktur','$kode','$nama','$jml','$jml_klinik','$jml_apotek','$ed','$hargabeli','$hargajual','$satuan','$diskon','STOK')");
            }
            
            if($query)
            {
                $output .= '<tr style="background-color:green;color:white"><td>'.$kode."</td><td>".$nama."</td><td>Berhasil".'</td></tr>';
            }
            else
            {
              $output .= '<tr style="background-color:red;color:white"><td>'.$kode."</td><td>".$nama."</td><td>Berhasil".'</td></tr>';
              echo mysqli_error($kon);
            }
        

    }
    $no++;

   }

  }
//      $output.= "<tr><td>Total Soal : ".($no-1)."</td></tr>"; 
  $output .= '</table></div>';
  $target_dir = "import/upload/"; //file upload folder
  $target_file = $target_dir .time().basename($_FILES["excel"]["name"]); // target file to be uploaded

  //upload the file
  if (move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file)) {
       $fileUploadMsg= "<label class='text-success'>The file has been uploaded Successfully!</label><br>";
    } else {
       $fileUploadMsg= '<label class="text-danger">Sorry, there was an error uploading your file!</label><br>';
    }



 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>


  <div class="container box">
    <br>
   <form method="post" enctype="multipart/form-data">
    <div class="container-fluid">
      <div class="row" style="margin-bottom:20px">
        <div class="col-md-4 col-xs-4 col-sm-4">
            <a href="import/format import barang berkathusada.xlsx" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Download Format Import</a>
        </div>  <!-- Blank Div -->
        
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <label>Pilih File Excel*</label>
        </div>
        <div class="col-xs-6 col-md-5 col-sm-6 col-lg-5">
            <input type="file" name="excel" />
        </div>
        <div class="col-xs-7 col-md-7 col-sm-6 col-lg-7">
            <input type="submit" name="import" class="btn btn-primary" value="Import" style="padding:2px 20px;"/>

        </div>
        
      </div>
  </div>
   </form>
   <br />
   <br />
   <?php
      echo $output;
      
   ?>
  </div>
 
            </div>
        </div>
    </div>
</div>
<?php 
include 'foot.php';
?>