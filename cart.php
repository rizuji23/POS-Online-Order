<?php 

    require 'config/modelvi.php';

    if (empty($_SESSION['username_user'])){

        header('location: index.php');
    } else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Imajinasi</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body onload="">

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="container-fluid">
            <div class="img-navbar">
                <img src="assets/img/logo.png" class="img-nav" alt="">
            </div>
            <div class="user-text">
                <p>Hi, Rizki</p>
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
                <a href="home.php"><img src="assets/img/back.svg" class="pointer" alt=""></a>
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
                <span>Keranjang</span>
            </div>

            <?php 
            
            $user  = $_SESSION['username_user'];

            $check_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");
        
            $cu = mysqli_fetch_assoc($check_user);
        
            $produk = mysqli_query($koneksi, "SELECT * FROM cart INNER JOIN produk ON cart.id_produk = produk.id_produk WHERE id_user = '". $cu['id_user'] ."' AND cart.status = '1'");

            if (isset($_POST['user'])){
                pemesanan($_POST);
            }
            
            ?>

            <form action="" method="POST" id="form_cart">

            <div class="cart-content">
                <?php 
                
                if (mysqli_num_rows($produk) == 0){
                    echo '<img src="assets/img/not_found.png" width="150" class="mx-auto d-block" alt="">';
                } else {
                
                foreach($produk as $p){ ?>
                <div class="subs">
                    <div class="cart-box">
                        <div class="row no-gutters">
                            <div class="col-sm">
                                <div class="img-cart">
                                    <img src="assets/img/thumb_produk/<?php echo $p['thumb_img'] ?>" class="cart-produk" alt="">
                                    
                                </div>
                                <div class="text-cart">
                                    <p><?php echo $p['nama_produk'] ?></p>
                                    <span class="text-subs-harga">Rp. <?php echo $p['harga'] ?></span>
                                </div>

                                
                            </div>

                            <div class="col-sm">
                                <div class="qty-cart">
                                   
                                    <div class="qty2">
                                        <div class="number2">
                                            <span class="minus2">-</span>
                                            <input type="text" name="qty[]" id="qtys" class="qty-input2" value="<?php echo $p['qty'] ?>" />
                                            <span class="plus2">+</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" id="<?php echo $p['id_cart'] ?>" class="hapus_cart">Hapus Produk</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="form-hidden">
                        <input type="hidden" value="<?php echo $p['harga'] ?>" class="harga_produk">
                        <input type="hidden" name="produk[]" value="<?php echo $p['id_produk'] ?>">
                        <input type="hidden" name="user" value="<?php echo $_SESSION['username_user'] ?>">
                        <input type="hidden" name="harga_sub[]" class="harga_sub">


                    </div>
                </div>
                <?php }
                }?>
                
            </div>

            </form>



            <div class="footer-cart">
                <div class="fo-cart-content">
                    <div class="row">
                        <div class="col">
                            <div class="total-foot">
                                <p>Total</p>
                            </div>

                        </div>

                        <div class="col">
                            <div class="tot-har-foot">
                                <p class="sub_harga_t">Rp. 0</p>
                            </div>

                        </div>
                    </div>
                </div>
                <?php 
                $produk2 = mysqli_query($koneksi, "SELECT * FROM cart INNER JOIN produk ON cart.id_produk = produk.id_produk WHERE id_user = '". $cu['id_user'] ."' AND cart.status = '1'");

                $p2 = mysqli_num_rows($produk2);

                if ($p2 == 0){
                
                ?>
                <div class="button-foot">
                    <button class="btn btn-dark btn-panjang btn-block" disabled>Beli</button>
                </div>
                <?php } else { ?>
                    <div class="button-foot">
                    <button class="btn btn-dark btn-panjang btn-block" id="btnbeli">Beli</button>
                </div>
                <?php } ?>
            </div>


        </div>




        <div class="footer text-center">
            <span>v1.0 Created and Development by <a href="https://www.instagram.com/rizuji23/" target="_blank">Rizki Fauzi</a></span>
        </div>


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
                                <a href="javascript:void(0)" id="belialert">Beli</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="alerts" id="hapusalert">
        
    </div>



    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>
<?php } ?>