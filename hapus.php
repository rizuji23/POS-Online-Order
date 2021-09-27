<?php 

    require 'config/modelvi.php';

    if (empty($_SESSION['username_user'])){

        header('location: index.php');
    } else {

        $id_users = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '".$_SESSION['username_user']."'");

        $iu = mysqli_fetch_assoc($id_users);

    $check = mysqli_query($koneksi, "SELECT * FROM cart WHERE id_user = '" . $iu['id_user']."'");

    $c = mysqli_fetch_assoc($check);

    if ($c['id_user'] == $iu['id_user']){
        $id = mysqli_escape_string($koneksi, $_GET['pro']);

        $hapus = mysqli_query($koneksi, "UPDATE cart SET status = '0', tanggal_update = '$tanggal' WHERE id_cart = '$id' ");

        if ($hapus){
            header('location: cart.php');
        }
    }

?>




<?php 


    }
    
?>