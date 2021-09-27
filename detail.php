<?php 

    require 'config/modelvi.php';


   

    if (empty($_SESSION['username_user'])){

        header('location: index.php');
    } else {

        $ids = mysqli_escape_string($koneksi, $_GET['pro']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Imajinasi</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
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


    <?php 
    
        $detail = mysqli_query($koneksi, "SELECT * FROM produk WHERE status = '1' AND id_produk = '$ids'");
        $d = mysqli_fetch_assoc($detail);
    
    if (mysqli_num_rows($detail) == 0){
            echo "<script>document.location.href = '404.html'</script>";
        } 
    ?>


    <div class="container-custom" onclick="closeNav()">

        <div class="home-content">
            <div class="detail-foto">
                <?php 
                
                    $foto = mysqli_query($koneksi, "SELECT * FROM foto_produk WHERE id_produk = '".$d['id_produk']."'");
                    $id = 0;
                ?>
                <div id="slideprodukfoto" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php 
                            foreach ($foto as $f){
                        
                        ?>
                        <li data-target="#slideprodukfoto" data-slide-to="<?php $id; ?>" class="lists"></li>

                        
                        <?php 
                        $id++;
                    } ?>
                        
                    </ol>
                    <div class="carousel-inner">
                    <?php 
                            foreach ($foto as $f){
                        
                        ?>
                        <div class="carousel-item">
                            <img src="assets/img/foto_produk/<?php echo $f['dir_foto'] ?>" class="mx-auto d-block img-fluid" alt="">
                        </div>
                        <?php } ?>
                        
                    </div>
                    <a class="carousel-control-prev" href="#slideprodukfoto" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slideprodukfoto" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                
            </div>

            <div class="detail-text mt-5">
                <h2><?php echo $d['nama_produk'] ?></h2>
                <p><?php echo $d['ml'] ?>ml</p>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="qty">
                        <div class="number">
                            <span class="minus">-</span>
                            <input type="text" name="qty[]" class="qty-input" disabled value="1" />
                            <span class="plus">+</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="harga-s float-right">
                        <span>Rp. <?php echo $d['harga'] ?></span>
                    </div>

                </div>
            </div>


            <div class="tentang-detail">
                <h5>Tentang minuman</h5>
                <p><?php echo $d['tentang_produk'] ?></p>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <div class="circle-loves">
                        <img src="assets/img/love.svg" class="mx-auto d-block mt-2 img-fluid" alt="">
                    </div>
                </div>
                <div class="col">
                    <div class="float-right">
                        <button class="btn btn-dark btn-panjang2 d-block addcart" id="<?php echo $d['id_produk'] ?>">Tambah ke keranjang</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer text-center">
            <span>v1.0 Created and Development by <a href="https://www.instagram.com/rizuji23/" target="_blank">Rizki Fauzi</a></span>
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
                        <p class="cart-counts"></p>
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

<?php } ?>