<?php 

    require 'config/modelvi.php';

    if (empty($_SESSION['username_admin']) || $_SESSION['level'] != "Super Admin"){
        echo "<script> document.location.href = '404.html' </script>";
    } else {
        if (isset($_GET['kat'])){
            $id_kat = mysqli_escape_string($koneksi, $_GET['kat']);

            $func = mysqli_query($koneksi, "UPDATE kategori SET status = '0', tanggal_update = '$tanggal' WHERE id_kategori = '$id_kat'");

            if ($func){
                echo "<script> document.location.href = 'kelolakategori.php' </script>";
            } else {
                echo "<script> alert('Hapus kategori gagal!!') document.location.href = 'kelolakategori.php' </script>";
            }
        } elseif (isset($_GET['voc'])){
            $id_voc = mysqli_escape_string($koneksi, $_GET['voc']);

            $func = mysqli_query($koneksi, "UPDATE voucher SET status = '0', tanggal_update = '$tanggal' WHERE id_voucher = '$id_voc'");

            if ($func){
                echo "<script> document.location.href = 'kelolavoucher.php' </script>";
            } else {
                echo "<script> alert('Hapus voucher gagal!!') document.location.href = 'kelolavoucher.php' </script>";
            }
        } elseif (isset($_GET['ad'])){
            $id_ad = mysqli_escape_string($koneksi, $_GET['ad']);

            $func = mysqli_query($koneksi, "UPDATE admin SET status = '0', tanggal_update = '$tanggal' WHERE id_admin = '$id_ad'");

            if ($func){
                echo "<script> document.location.href = 'kelolaadmin.php' </script>";
            } else {
                echo "<script> alert('Hapus Admin gagal!!') document.location.href = 'kelolaadmin.php' </script>";
            }
        }
    }


?>