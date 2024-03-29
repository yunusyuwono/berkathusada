<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(empty($_SESSION['iduser']))
{
    header('Location:login');
}
include 'koneksi.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="">Klinik Berkat Husada</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="assets/css/fontgoogle.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="icon" href="#">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
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
                                <span>Center : <b class="text-success">Admcenter</b></span>
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
                            <a href="barang?hal=barangmasuk" class='sidebar-link'>
                                <i class="fas fa-box"></i>
                                <span>Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="stokopname" class='sidebar-link'>
                                <i class="fas fa-list"></i>
                                <span>Stok Opname</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="transaksi" class='sidebar-link'>
                                <i class="fas fa-exchange-alt"></i>
                                <span>Transaksi</span>
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
        
            