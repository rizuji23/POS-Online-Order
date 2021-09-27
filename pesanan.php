<?php 

    require 'config/modelvi.php';

    if (empty($_SESSION['username_user'])){

        header('location: index.php');
    } else {
        if (empty($_SESSION['produk_front'])){
            header('location: home.php');

        } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Imajinasi</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="container-fluid">
            <div class="img-navbar">
                <img src="assets/img/logo.png" class="img-nav" alt="">
            </div>
            <div class="user-text">
                <p>Hi, <?php echo $_SESSION['username_user'] ?></p>
            </div>
            <hr class="hrs">
        </div>



        <a class="active" href="index.php">Home</a>
        <a href="caraorder.php">Cara Order</a>
        <a href="menuminuman.php">Menu Minuman</a>
        <a href="kontak.php">Kontak Kami</a>
        <a href="tentang.php">Tentang Kami</a>
        <a href="logout.php">Logout</a>

        <div class="socialm">
            <div class="container-fluid">
                <p>Follow sosial media kami.</p>
                <button class="btn btn-dark btn-panjang" id="follow">Follow</button>
            </div>

        </div>
    </div>

    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
        <ul class="navbar-nav mr-auto pl-4">
            <li class="nav-item">
                <a href="javascript:void(0)" id="backpesanan"><img src="assets/img/back.svg" class="pointer" alt=""></a>
            </li>
        </ul>

        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <img src="assets/img/logo.png" class="img-logo-home pointer" alt="">
            </li>
        </ul>

        <ul class="navbar-nav ml-auto pr-4">
            <li class="nav-item">
                <img src="assets/img/search.svg" class="pointer" alt="">
            </li>
        </ul>

    </nav>


    <div class="container-custom" onclick="closeNav()">

        <div class="home-content">
            <div class="title-content">
                <span>Data Pemesanan</span>

            </div>

            <?php 
            
            
                if (isset($_POST['nama'])){
                    pesanan($_POST);
                }

                $users = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '". $_SESSION['username_user']. "'");
                $u = mysqli_fetch_assoc($users);
                
                if ($_SESSION['level'] == 'tamu'){
                    $check_data = mysqli_query($koneksi, "SELECT * FROM user_data WHERE id_user = '". $u['id_user'] ."'");

                } elseif ($_SESSION['level'] == 'login') {
                    $check_data = mysqli_query($koneksi, "SELECT * FROM user_data WHERE id_user = '". $u['id_user'] ."'");

                }


                if (mysqli_num_rows($check_data) == 0){
            
            ?>

            <div class="content-data mt-3">
                <form action="" id="formpesanan" method="POST">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                       <label for="">No Telepon</label>
                       <input type="number" name="notelp" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                       <label for="">Alamat Lengkap</label>
                       <textarea name="alamat" class="control-custom form-control" required id="" cols="30"
                           rows="10"></textarea>
                    </div>

                    
                <?php } else { ?>
                    <?php 
                        
                        $cd = mysqli_fetch_assoc($check_data);
                        
                        ?>
                    <div class="content-data mt-3">
                <form action="" id="formpesanan" method="POST">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" value="<?php echo $u['nama_lengkap'] ?>" name="nama" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                       <label for="">No Telepon</label>
                       <input type="number" value="<?php echo $u['no_telp'] ?>" name="notelp" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                       <label for="">Alamat Lengkap</label>
                       <textarea name="alamat" class="control-custom form-control" required id="" cols="30"
                           rows="10"><?php echo $cd['alamat'] ?></textarea>
                    </div>


                    
                    <?php } ?>

                    <div class="title-content">
                        <span>Catatan Pembeli</span>
                    </div>

                    <div class="form-group mt-3">
                        <textarea name="catatan" placeholder="Contoh: less sugar, less ice, Bitter Kopi(Low, Medium, High)" class="control-custom form-control" required id="" cols="30"
                            rows="10"></textarea>
                    </div>


                    <div class="title-content">
                        <span>Kode Voucher</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Kode</label>
                        <input type="text" id="kode" class="form-control control-custom">
                        <button id="btngunakan" class="btn btn-dark btn-panjang btn-block mt-2">Gunakan</button>
                    </div>

                </form>
                    <div class="title-content">
                        <span>Detail Pemesanan</span>
                    </div>

                    <?php 

                        $data_f = mysqli_query($koneksi, "SELECT * FROM pemesanan INNER JOIN produk ON pemesanan.id_produk = produk.id_produk WHERE id_pemesanan_f = '".$_SESSION['produk_front']."'");

                        foreach ($data_f as $df){


                        ?>

                    <div class="cart-content">
                        <div class="cart-box">
                            <div class="row no-gutters">
                                <div class="col-sm">
                                    <div class="img-cart">
                                        <img src="assets/img/thumb_produk/<?php echo $df['thumb_img'] ?>" class="cart-produk" alt="">
                                    </div>
                                    <div class="text-cart">
                                        <p><?php echo $df['nama_produk']  ?></p>
                                        <span>Rp. <?php echo $df['sub_harga'] ?></span>
                                    </div>

                                </div>

                                <div class="col-sm">
                                    <div class="qty-cart2">
                                        <p>Qty</p>
                                        <span><?php echo $df['qty'] ?></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="info-ongkir">
                        <div class="info-content">
                            <p>Ongkir akan diberitahu oleh admin
                                saat anda memesan.</p>
                        </div>
                    </div>

                    <?php 
                    
                            $pemesanan_f = mysqli_query($koneksi, "SELECT * FROM pemesanan_front WHERE id_pemesanan_front = '".$_SESSION['produk_front']."'");

                            $pf = mysqli_fetch_assoc($pemesanan_f);
                    
                    
                    ?>

                    <div class="footer-cart">
                        <div class="fo-cart-content">
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="total-foot">
                                        <p>Total</p>
                                    </div>

                                </div>

                                <div class="col" id="pesanan-a">
                                    <div class="tot-har-foot">
                                        <p id="">Rp. <span class="pharga"><?php echo number_format($pf['total'], 0, ',', '.'); ?></span></p>
                                        
                                    </div>
                                    
                                    

                                </div>
                            </div>
                        </div>
                        <div class="button-foot">
                            <button class="btn btn-dark btn-panjang btn-block" id="btnbeli">Pesan</button>
                        </div>
                    </div>

               
            </div>


        </div>

        <div class="footer text-center">
            <span>v1.0 Created and Development by <a href="https://www.instagram.com/rizuji23/" target="_blank">Rizki Fauzi</a></span>
        </div>

    </div>

    <div class="alerts" id="pesan">
        <div class="alert-content">
            <div class="alert-box">
                <div class="alert-b-content">
                    <div class="dialog text-center">
                        <p>Yakin?</p>
                        <span>Ingin dipesan sekarang?</span>
                    </div>

                </div>

                <hr>
                <div class="promp">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="batal-p text-center">
                                <a href="javascript:void(0)" id="batalalert">Batal</a>
                            </div>

                        </div>

                        <div class="col">
                            <div class="beli-p text-center">
                                <a href="javascript:void(0)" id="belialert2">Beli</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-alert">
        <div class="toast-body">
            <p class="data-toast"></p>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>
<?php } 
}
?>