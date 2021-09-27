<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Imajinasi</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php 

    require 'config/modelvi.php';
    
    if (isset($_POST['daftar'])){
        daftar_user($_POST);
    }

?>


    <div class="container-custom">
        <div class="back-icon">
            <a href="index.html"><img src="assets/img/back.svg" class="back-icons" alt=""></a>
        </div>
        <div class="login-content text-center">
            <img src="assets/img/logo.png" class="img-login" alt="">

            <div class="text-center text-splash">
                <span>Daftar</span>
            </div>

            <div class="form-login mt-3">
                <form method="POST">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                        <label for="">No Telepon</label>
                        <input type="number" name="no_telp" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control control-custom" id="" cols="30" rows="8" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control control-custom" required>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control control-custom" required>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" name="daftar" class="btn btn-dark btn-panjang btn-block">Daftar</button>
                    </div>


                </form>

            </div>

            <a href="login.html" class="text-center text-daftar">Sudah punya akun?</a>

            <div class="footer text-center">
                <span>v1.0 Created and Development by <a href="https://www.instagram.com/rizuji23/" target="_blank">Rizki Fauzi</a></span>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>