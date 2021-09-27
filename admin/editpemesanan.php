<?php 



    require 'config/modelvi.php';

    if (empty($_SESSION['username_admin']) || $_SESSION['level'] != "Super Admin"){
        echo "<script> document.location.href = '404.html' </script>";
    } else {
        if (isset($_GET['pro'])){
            $id_pro = mysqli_escape_string($koneksi, $_GET['pro']);

            $func = mysqli_query($koneksi, "UPDATE pemesanan_front SET status = '2', tanggal_update = '$tanggal' WHERE id_pemesanan_front = '$id_pro'");

            if ($func){
                echo "<script> document.location.href = 'datapenjualan.php' </script>";
            } else {
                echo "<script> alert('Prosses penjualan gagal!!') document.location.href = 'datapenjualan.php' </script>";
            }
        } elseif (isset($_GET['sel'])){
            $id_sel = mysqli_escape_string($koneksi, $_GET['sel']);

            $func = mysqli_query($koneksi, "UPDATE pemesanan_front SET status = '3', tanggal_update = '$tanggal' WHERE id_pemesanan_front = '$id_sel'");

            if ($func){
                echo "<script> document.location.href = 'datapenjualan.php' </script>";
            } else {
                echo "<script> alert('Selesai penjualan gagal!!') document.location.href = 'datapenjualan.php' </script>";
            }
        } elseif (isset($_GET['del'])){
           $id_del = mysqli_escape_string($koneksi, $_GET['del']);

            $func = mysqli_query($koneksi, "UPDATE pemesanan_front SET status = '0', tanggal_update = '$tanggal' WHERE id_pemesanan_front = '$id_del'");

            if ($func){
                echo "<script> document.location.href = 'datapenjualan.php' </script>";
            } else {
                echo "<script> alert('Delete penjualan gagal!!') document.location.href = 'datapenjualan.php' </script>";
            }
        }
    }



?>