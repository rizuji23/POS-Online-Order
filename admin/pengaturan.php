<?php 
    require 'config/modelvi.php';
  if (empty($_SESSION['username_admin']) || $_SESSION['level'] != "Super Admin"){
    echo "<script> document.location.href = '404.html' </script>";
  } else {



    $nama = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '". $_SESSION['username_admin'] ."'");
    $n = mysqli_fetch_assoc($nama);

   
  
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Pengaturan | Imajinasi Management System</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" href="assets/css/fileinput.min.css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <h2>IMAJINASI</h2>
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="dashboard.php">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="dataproduk.php">
                                <i class="ni ni-box-2 text-orange"></i>
                                <span class="nav-link-text">Data Produk</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="datapenjualan.php">
                                <i class="ni ni-cart text-primary"></i>
                                <span class="nav-link-text">Data Penjualan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="datauser.php">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Data User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kasir.php">
                                <i class="ni ni-shop text-default"></i>
                                <span class="nav-link-text">Kasir</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="pengaturan.php">
                                <i class="ni ni-settings-gear-65 text-default"></i>
                                <span class="nav-link-text">Pengaturan</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->

                    <!-- Heading -->

                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link active active-pro" href="upgrade.php">
                                <i class="ni ni-check-bold text-dark"></i>
                                <span class="nav-link-text">Version app v.1.0</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->

                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ni ni-bell-55"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                <!-- Dropdown header -->
                                <div class="px-3 py-3">
                                    <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong>
                                        notifications.
                                    </h6>
                                </div>
                                <!-- List group -->
                                <div class="list-group list-group-flush">
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="assets/img/theme/team-1.jpg"
                                                    class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">John Snow</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>2 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="assets/img/theme/team-2.jpg"
                                                    class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">John Snow</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>3 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="assets/img/theme/team-3.jpg"
                                                    class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">John Snow</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>5 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="assets/img/theme/team-4.jpg"
                                                    class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">John Snow</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>2 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="assets/img/theme/team-5.jpg"
                                                    class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">John Snow</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>3 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- View all -->
                                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View
                                    all</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ni ni-ungroup"></i>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                                <div class="row shortcuts px-4">
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                            <i class="ni ni-calendar-grid-58"></i>
                                        </span>
                                        <small>Calendar</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                            <i class="ni ni-email-83"></i>
                                        </span>
                                        <small>Email</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                            <i class="ni ni-credit-card"></i>
                                        </span>
                                        <small>Payments</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                            <i class="ni ni-books"></i>
                                        </span>
                                        <small>Reports</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                            <i class="ni ni-pin-3"></i>
                                        </span>
                                        <small>Maps</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                            <i class="ni ni-basket"></i>
                                        </span>
                                        <small>Shop</small>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="assets/img/theme/team-4.jpg">
                            </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold"><?php echo $n['nama_admin'] ?></span>
                            </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>

                            <a href="logout.php" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                            </a>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Pengaturan</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">Pengaturan</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <div class="card card-profile">

                        <div class="card-body pt-3">
                            <h2>Menu</h2>
                            <a href="#boxkategori" class="btn btn-primary btn-block">Tambah Kategori</a>
                            <a href="#boxadmin" class="btn btn-primary btn-block">Tambah Admin</a>
                            <a href="#boxvoucher" class="btn btn-primary btn-block">Tambah Voucher</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card" id="boxkategori">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Tambah Kategori</h3>
                                </div>

                            </div>
                        </div>
                        <?php 

                            if (isset($_POST['simpan_kat'])){
                                simpan_kategori($_POST);
                            } elseif (isset($_POST['simpanvoucher'])){
                                simpanvoucher($_POST);
                            } elseif (isset($_POST['simpan_user'])){
                                simpan_user($_POST);
                            }
                        
                        
                        ?>
                        <div class="card-body">
                            <form method="POST">
                                <h6 class="heading-small text-muted mb-4">Kategori</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Nama Kategori</label>
                                        <input type="text" required name="nama_kategori" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jenis Kategori
                                        </label>
                                        <select id="" required name="jenis_kategori" class="form-control">
                                            <option value="">--- Pilih Kategori ---</option>
                                            <option value="Minuman">Minuman</option>
                                            <option value="Makanan">Makanan</option>
                                            <option value="Merchandise">Merchandise</option>
                                        </select>
                                    </div>


                                </div>
                                <hr class="my-4" />

                                <div class="form-group float-right">
                                    <a href="kelolakategori.php" class="btn btn-info">Kelola Kategori</a>
                                    <button type="submit" name="simpan_kat" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>




                    <div class="card" id="boxvoucher">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Tambah Voucher</h3>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <h6 class="heading-small text-muted mb-4">Identitas Voucher</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Kode Voucher</label>
                                        <input type="text" name="kode_voucher" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Percent Potongan</label>
                                        <input type="number" name="percent_potongan" required class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Jenis Voucher
                                        </label>
                                        <select name="jenis_voucher" id="" class="form-control">
                                            <option value="">--- Pilih Jenis Voucher ---</option>
                                            <option value="Potongan Harga">Potongan Harga</option>
                                            <option value="Potongan Ongkir">Potongan Ongkir</option>
                                            <option value="Giveaway">Giveaway</option>
                                            
                                        </select>
                                    </div>


                                </div>
                                <hr class="my-4" />

                                <div class="form-group float-right">
                                    <a href="kelolavoucher.php" class="btn btn-info">Kelola Voucher</a>
                                    <button type="submit" name="simpanvoucher" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>



                    <div class="card" id="boxadmin">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Tambah Admin</h3>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <h6 class="heading-small text-muted mb-4">Identitas Admin</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Nama Admin</label>
                                        <input type="text" name="nama_admin" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Email Admin</label>
                                        <input type="email" name="email_admin" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Username</label>
                                        <input type="text" name="username" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Password</label>
                                        <input type="password" name="password" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Level Admin
                                        </label>
                                        <select name="level" id="" class="form-control">
                                            <option value="">--- Pilih Level ---</option>
                                            <option value="Super Admin">Super Admin</option>
                                            <option value="Management">Management</option>
                                            <option value="Keuangan">Keuangan</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Kasir">Kasir</option>
                                        </select>
                                    </div>


                                </div>
                                <hr class="my-4" />

                                <div class="form-group float-right">
                                    <a href="kelolaadmin.php" class="btn btn-info">Kelola Admin</a>
                                    <button type="submit" name="simpan_user" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>







                </div>
            </div>
            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            &copy; 2021 Template by <a href="https://www.creative-tim.com" class="font-weight-bold ml-1"
                                target="_blank">Creative
                                Tim</a> and Development by <a href="https://www.instagram.com/rizuji23"
                                class="font-weight-bold ml-1" target="_blank">Rizki Fauzi</a>
                        </div>
                    </div>

                </div>
            </footer>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="assets/js/argon.js?v=1.2.0"></script>
    <script src="assets/js/fileinput.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
<?php } ?>