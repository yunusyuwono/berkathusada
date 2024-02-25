<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include 'koneksi.php';
$glog=mysqli_query($kon,"select * from user where id='$_SESSION[iduser]'");
$g=mysqli_fetch_array($glog);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="">Klinik Berkat Husada</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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
                                <span>Dokter : <b class="text-success"><?=$g['nama'];?></b></span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="./" class='sidebar-link'>
                                <i class="bi bi-speedometer"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="pasien" class='sidebar-link'>
                                <i class="fas fa-users"></i>
                                <span>Pasien</span>
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
        
            