<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPK BEASISWA</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>
<body>
    <!-- cek status login atau belum -->
    <?php 
     if($_SESSION['status']!="y"){
        header("Location:login.php");
     }
    ?>

<nav class="navbar navbar-dark bg-primary border navbar-expand-sm fixed-top">
    <a class="navbar-brand" href="#">BEASISWA</a>
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home </a></li>
        <?php 
            if($_SESSION["level"]=="SuperAdmin"){

        ?>
            <li class="nav-item active"><a class="nav-link" href="?page=users"><i class="fas fa-user"></i> Users </a></li>
            <li class="nav-item active"><a class="nav-link" href="?page=perangkingan&thn="><i class="fas fa-address-book"></i> Perangkingan </a></li>
            <li class="nav-item active"><a class="nav-link" href="?page=report"><i class="fas fa-file"></i> Report </a></li>
        <?php 
            }else{
        ?>
            <li class="nav-item active"><a class="nav-link" href="?page=mahasiswa"><i class="fas fa-user-circle"></i> Mahasiswa </a></li>
            <li class="nav-item active"><a class="nav-link" href="?page=pendaftaran"><i class="fas fa-address-book"></i> Pendaftaran </a></li>
            <li class="nav-item active"><a class="nav-link" href="?page=perangkingan&thn="><i class="fas fa-address-book"></i> Perangkingan </a></li>
            <li class="nav-item active"><a class="nav-link" href="?page=report"><i class="fas fa-file"></i> Report </a></li>
        <?php 
            }
        ?>  
        <li class="nav-item active"><a class="nav-link" href="logout.php"><i class="fas fa-door-closed"></i> Logout </a></li>
    </ul>
</nav>

<div class="container" style="margin-top:100px;margin-bottom:100px">
    <?php

        // pengaturan menu
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page==""){
            include "welcome.php";
        }elseif ($page=="mahasiswa"){
            if ($action==""){
                include "tampil_mahasiswa.php";
            }elseif($action=="tambah"){
                include "tambah_mahasiswa.php";
            }elseif($action=="update"){
                include "update_mahasiswa.php";
            }else{
                include "hapus_mahasiswa.php";
            }
        }elseif ($page=="pendaftaran"){
            if ($action==""){
                include "tampil_pendaftaran.php";
            }elseif($action=="tambah"){
                include "tambah_pendaftaran.php";
            }elseif($action=="update"){
                include "update_pendaftaran.php";
            }else{
                include "hapus_pendaftaran.php";
            }
        }elseif ($page=="perangkingan"){
            if ($action==""){
                include "perangkingan.php";
            }
        }elseif ($page=="users"){
            if ($action==""){
                include "tampil_users.php";
            }elseif($action=="tambah"){
                include "tambah_users.php";
            }elseif($action=="update"){
                include "update_users.php";
            }else{
                include "hapus_users.php";
            }
        }elseif ($page=="report"){
            if ($action==""){
                include "report.php";
            }
        }else{

        }
    ?>
</div>

    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script>
       $(document).ready(function () {
           $('#myTable').dataTable();
       });
    </script>

    <script src="assets/js/chosen.jquery.min.js"></script>
    <script>
     $(function() {
       $('.chosen').chosen();
     });
    </script>

</body>
</html>