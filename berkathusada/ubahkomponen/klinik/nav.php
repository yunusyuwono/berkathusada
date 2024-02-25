<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(empty($_SESSION['iduser']))
{
    header('Location:../login');
}
include 'koneksi.php';
$glog=mysqli_query($kon,"select * from user where id='$_SESSION[iduser]'");
$g=mysqli_fetch_array($glog);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="">Klinik Berkat Husada</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="icon" href="#">
    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="../assets/vendors/toastify/toastify.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><b class="text-danger">Berkat Husada</b></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item  ">
                            <a class='sidebar-link'>
                                <span>Klinik : <b class="text-success"><?=$g['nama'];?></b></span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="./" class='sidebar-link'>
                                <i class="bi bi-speedometer"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="master?hal=satuan" class='sidebar-link'>
                                <i class="fas fa-database"></i>
                                <span>Master</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="barang?hal=barangall" class='sidebar-link'>
                                <i class="fas fa-box"></i>
                                <span>Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="jasa" class='sidebar-link'>
                                <i class="fas fa-cog"></i>
                                <span>Jasa</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="tindakan" class='sidebar-link'>
                                <i class="fas fa-cog"></i>
                                <span>Tindakan</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="transaksi" class='sidebar-link'>
                                <i class="fas fa-exchange-alt"></i>
                                <span>Transaksi</span>
                            </a>
                        </li> 
                        <li class="sidebar-item  ">
                            <a href="hutang" class='sidebar-link'>
                                <i class="fa fa-balance-scale-left"></i>
                                <span>Hutang</span>
                            </a>
                        </li> 

                        <li class="sidebar-item  ">
                            <a href="antrian" class='sidebar-link'>
                                <i class="fa fa-exchange-alt"></i>
                                <span>Antrian</span>
                            </a>
                        </li> 
                        <li class="sidebar-item  ">
                            <a href="riwayat" class='sidebar-link'>
                                <i class="fa fa-scroll"></i>
                                <span>Riwayat Berobat</span>
                            </a>
                        </li> 
                        <li class="sidebar-item  ">
                            <a href="stokopname" class='sidebar-link'>
                                <i class="fas fa-list"></i>
                                <span>Stok Opname</span>
                            </a>
                        </li> 
                        <li class="sidebar-item  ">
                            <a href="laporan" class='sidebar-link'>
                                <i class="fas fa-paste"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="logout" class='sidebar-link'>
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>                     
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                
            </div>
        </div>
        
            