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
    <title>Home - Imajinasi</title>
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



        <a class="active" href="home.php">Home</a>
        <a href="caraorder.php">Cara Order</a>
        <a href="menuminuman.php">Menu Minuman</a>
        <a href="kontak.php">Kontak Kami</a>
        <a href="tentang.php">Tentang Kami</a>
        <a href="version.php">Version App</a>
        <a href="logout.php">Logout</a>

        <div class="socialm">
            <div class="container-fluid">
                <p>Follow sosial media kami.</p>
                <button class="btn btn-dark btn-panjang" id="follow">Follow</button>
            </div>

        </div>
    </div>


    <div class="slideside">
        
    </div>

    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
        <ul class="navbar-nav mr-auto pl-4">
            <li class="nav-item">
                <img src="assets/img/icon-navbar.svg" onclick="openNav()" class="pointer" alt="">
            </li>
        </ul>

        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <img src="assets/img/logo.png" class="img-logo-home pointer" alt="">
            </li>
        </ul>

        <ul class="navbar-nav ml-auto pr-4">
            <li class="nav-item">
                <img src="assets/img/search.svg" id="btnsearch" class="pointer" alt="">
            </li>
        </ul>

    </nav>


    <div class="container-custom" onclick="closeNav()">

        <div class="home-content">
            <div class="title-content">
                <p>Minuman</p>
                <span>Spesial untuk kamu</span>
            </div>

            <div class="slider-menu">
                <ul>
                    <li class="lists active-menu" onclick="location.reload()">Populer</li>
                    <?php 

                        $kategori1 = mysqli_query($koneksi, "SELECT * FROM kategori WHERE jenis_kategori = 'Minuman'");
                    
                    ?>
                    <?php 

                        foreach ($kategori1 as $k1){

                    ?>
                    <li class="menu-ml"><a id="<?php echo $k1['id_kategori'] ?>" class="kategori_minum" href="javascript:void(0)"><?php echo $k1['kategori'] ?></a></li>
                    <?php } ?>
                    
                </ul>
            </div>

            <div class="slider-menu-detail" id="slideminuman">
                <?php 
                
                    $data_sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE status = '1' ORDER BY id_produk ASC");
                    
                    foreach ($data_sql as $k1){
                
                ?>
                <a href="detail.php?pro=<?php echo $k1['id_produk'] ?>" class="ml-2">
                    <div class="box-menu">
                        <div class="menu-image">
                            <img src="assets/img/thumb_produk/<?php echo $k1['thumb_img'] ?>" class="img-fluid" alt="">
                        </div>
                        <div class="menu-text">
                            <span><?php echo $k1['nama_produk'] ?></span><br>
                            <small><?php echo $k1['desk_produk'] ?></small>
                            <p>Rp. <?php echo $k1['harga'] ?></p>
                        </div>
                    </div>
                </a>
                <?php } ?>


            </div>
            <div class="text-center mt-3">
                <a href="#" class="lookall">Lihat Semua</a>
            </div>

            <!-- merchendaise -->


            <div class="title-content">
                <p>Merchandise</p>
                <span>Spesial untuk kamu</span>
            </div>

            <div class="slider-menu">
                <ul>
                    <li class="active-menu">Populer</li>
                    <li class="menu-ml ">Biji Kopi</li>
                    <li class="menu-ml">Tote Bag</li>
                    <li class="menu-ml">Mug/Botol</li>
                    <li class="menu-ml">Celemek</li>
                </ul>
            </div>

            <div class="slider-menu-detail">
                <img src="assets/img/coming_soon.png" width="100" class="mx-auto d-block" alt="">
            </div>
            <div class="text-center mt-3">
                <!-- <a href="#" class="lookall">Lihat Semua</a> -->
            </div>



        </div>

        <div class="footer text-center">
            <span>v1.0 Created and Deevelopment by <a href="#">Rizki Fauzi</a></span>
        </div>

    </div>

    <div class="cart">
        <div class="container">
            <div class="cart-content">
                <div class="img-cart mtts">
                    <img src="assets/img/cart.svg" alt="">
                </div>
                <div class="cart-in mtts ">
                   

                </div>

                <div class="cart-count mtts text-center">
                    <div class="box-circle2">
                        <p class="cart-counts">2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="alerts" id="social">
        <div class="alert-content">
            <div class="alert-box2">
                <div class="alert-b-content2">
                    <div class="dialog2 ">
                        <p class="text-center">Sosial Media</p>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="assets/img/icons8-instagram.svg" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">imajinasi.cafe</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.instagram.com/imajinasi.cafe/" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="assets/img/icons8-facebook.svg" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">imajinasi.cafe</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.facebook.com/imajinasi.cafe/" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="https://img.icons8.com/color/48/000000/youtube-play.png" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">Imajinasi ID</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.youtube.com/channel/UCLTphtgr9OaKBLL9ED58JXw" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="https://img.icons8.com/color/48/000000/tiktok.png" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">imajinasi.cafe</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.tiktok.com/@imajinasi.cafe" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>
                <div class="promp pb-3">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="batal-p text-center">
                                <a href="javascript:void(0)" id="batalsocial">Batal</a>
                            </div>

                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="alerts" id="search">
        <div class="alert-content">
            <div class="alert-box2">
                <div class="alert-b-content2">
                    <div class="dialog2 ">
                        <p class="text-center">Sosial Media</p>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="assets/img/icons8-instagram.svg" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">imajinasi.cafe</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.instagram.com/imajinasi.cafe/" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="assets/img/icons8-facebook.svg" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">imajinasi.cafe</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.facebook.com/imajinasi.cafe/" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="https://img.icons8.com/color/48/000000/youtube-play.png" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">Imajinasi ID</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.youtube.com/channel/UCLTphtgr9OaKBLL9ED58JXw" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <img src="https://img.icons8.com/color/48/000000/tiktok.png" width="50" alt="">
                            </div>
                            <div class="col">
                                <p class="text-left social-name">imajinasi.cafe</p>
                            </div>
                            <div class="col-3 text-center">
                                <div class="open">
                                    <a href="https://www.tiktok.com/@imajinasi.cafe" rel="noopener" target="_blank">Buka</a>
                                </div>
                                
                            </div>
                        </div>
                <div class="promp pb-3">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="batal-p text-center">
                                <a href="javascript:void(0)" id="batalsocial">Batal</a>
                            </div>

                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <script src="assets/js/scripts.js"></script>

</body>

</html>
<?php } ?>