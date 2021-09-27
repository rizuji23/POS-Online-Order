<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Version App - Imajinasi</title>
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
                <p>Hi, Rizki</p>
            </div>
            <hr class="hrs">
        </div>



        <a class="active" href="home.php">Home</a>
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
                <span>Version</span>
            </div>

            <div class="catalog-content mt-4">
                <div class="card-custom">
                    <div class="card-custom-body">
                        <div class="card-kontak">
                            <span>Versi Sekarang</span>
                            <p>imj-appv.1.2</p>

                            <span>Change Log</span>
                            <p style="margin-bottom: 0">(imj-appv.1.2) - 31 Mar 2021</p>
                            <p style="margin-bottom: 0">#Added</p>
                            <p style="margin-bottom: 0">- Added menu Version App</p>
                            <p style="margin-bottom: 0">- Added offline mode and installing web app on phone</p>
                            <p style="margin-bottom: 0">- Added button Install App in index</p>
                            <p style="margin-bottom: 0">- Added icon Tidak ada data in Keranjang</p>
                            <p style="margin-bottom: 0">- Added link Facebook, Tiktok on Kontak Kami page</p>
                            <p style="margin-bottom: 0">- Added link Facebook, Tiktok, Youtube on Alert Home Social Media</p>
                            <p style="margin-bottom: 0">- Added icon Tiktok, Youtube on Alert Home Social Media</p>
                            <p style="margin-bottom: 0">- Added swipe right for sidebar active</p>
                            <p style="margin-bottom: 0">#Improved</p>
                            <p style="margin-bottom: 0">- Improved Pemesanan</p>
                            <p style="margin-bottom: 0">- Improved menu product</p>
                            <p style="margin-bottom: 0">- Improved typo text</p>
                            <p style="margin-bottom: 0">#Removed</p>
                            <p style="margin-bottom: 0">- Removed Lihat Semua at home page</p>
                            
                            <hr>
                            
                            
                            
                        </div>

                    </div>

                </div>


            </div>


            <div class="title-content">
                <span>Feedback</span>
            </div>

            <div class="catalog-content mt-4">
                <div class="card-custom">
                    <div class="card-custom-body">
                        <div class="card-kontak">
                            <span>Kirimkan Feedback ke</span>
                            <p style="margin-bottom: 0"><a href="https://www.instagram.com/imajinasi.cafe/" target="_blank">imajinasi.cafe (Instagram)</a>
                            </p>
                            <p style="margin-bottom: 0"><a href="https://web.whatsapp.com/send?phone=6289657581114&text=Feedback Web Imajinasi" target="_blank">WhatsApp (Developer)</a>
                            </p>
                        </div>
                    </div>

                </div>


            </div>


        </div>

        <div class="footer text-center">
            <span>v1.0 Created and Development by <a href="https://www.instagram.com/rizuji23/" target="_blank">Rizki
                    Fauzi</a></span>
        </div>

    </div>

    <!-- <div class="cart">
        <div class="container">
            <div class="cart-content">
                <div class="img-cart mtts">
                    <img src="assets/img/cart.svg" alt="">
                </div>
                <div class="cart-in mtts ">
                    <div class="box-circle ml-3">
                        <img src="assets/img/foto_produk/cm.png" class="img-fluid" alt="">
                    </div>

                    <div class="box-circle ml-3">
                        <img src="assets/img/foto_produk/kg.png" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="cart-count mtts text-center">
                    <div class="box-circle2">
                        <p>2</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>