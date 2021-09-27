<?php 
session_start();

    require 'config.php';

    function daftar_user($data){
        global $koneksi;
        global $tanggal;

        $id_user_l = uniqid();
        $id_user_data = uniqid();

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        

        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $no_telp = htmlspecialchars($data['no_telp']);
        $alamat = htmlspecialchars($data['alamat']);
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars(md5($data['password']));

        $check_username = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
        $check = mysqli_num_rows($check_username);

        if ($check == 0){
            $data = mysqli_query($koneksi, "INSERT INTO users VALUES(NULL, '$id_user_l', '$nama', '$email', '$no_telp', '$username', '$password', '3', '1','$tanggal', '$tanggal')");

            if ($data){
                $data2 = mysqli_query($koneksi, "INSERT INTO user_data VALUES(NULL, '$id_user_data', '$id_user_l', '$alamat', '$tanggal', '$tanggal')");
    
                if ($data2) {
                    echo '<div class="toast-alert">
                <div class="toast-body">
                    <p class="data-toast">Berhasil</p>
                </div>
            </div>';
    
            echo '<script>document.location.href = "login.php"</script>';
                } else {
                    echo '<div class="toast-alert">
                <div class="toast-body">
                    <p class="data-toast">Gagal Daftar</p>
                </div>
            </div>';
                }
            } else {
                echo '<div class="toast-alert">
                <div class="toast-body">
                    <p class="data-toast">Gagal Daftar</p>
                </div>
            </div>';
            }
        } else {
            echo '<div class="toast-alert">
            <div class="toast-body">
                <p class="data-toast">Maaf Username Sudah Terdaftar</p>
            </div>
        </div>';
        }
    }

    function login_user($data){
        global $koneksi;
        global $tanggal;

        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars(md5($data['password']));

        $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $c = mysqli_fetch_assoc($check);

        if (empty($username) || empty($password)){
            echo '<div class="toast-alert">
            <div class="toast-body">
                <p class="data-toast">Username atau Password Wajib Disisi</p>
            </div>
        </div>';
        } else {
            if ($c['username'] == $username && $c['password'] == $password){
                $_SESSION['username_user'] = $username;
                $_SESSION['level'] = 'login';
                header('location:home.php');
            } else {
                echo '<div class="toast-alert">
                <div class="toast-body">
                    <p class="data-toast">Username Atau Password Salah</p>
                </div>
            </div>';
            }
        }

    }


    function pemesanan($data){
        global $koneksi;
        global $tanggal;

        $id_pemesanan_f = uniqid(); 
        $qty = $data['qty'];
        
        $produk = $data['produk'];
        $user = mysqli_escape_string($koneksi, $data['user']);
       
        $harga_sub = $data['harga_sub'];

        $check_u = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");
        $cu = mysqli_fetch_assoc($check_u);

        $id_pemesanan = uniqid();

        $total_harga = 0;
        foreach($harga_sub as $hs){
           
            $h2 = str_replace('.', "", $hs);
            

            $total_harga += $h2;

        }


        $pf = mysqli_query($koneksi, "INSERT INTO pemesanan_front VALUES(NULL, '$id_pemesanan_f', '" . $cu['id_user'] ."', '$total_harga', '-', '-', '1', '$tanggal', '$tanggal')");

        if ($pf){
            $id = 0;
            foreach($produk as $p){
                mysqli_query($koneksi, "INSERT INTO pemesanan VALUES(NULL, '$id_pemesanan', '$id_pemesanan_f', '$p','". $cu['id_user'] ."', '$qty[$id]', '$harga_sub[$id]', '1', '$tanggal', '$tanggal')");

                $id++;
            }
            
            $sets = mysqli_query($koneksi, "UPDATE cart SET status = '0' WHERE id_user = '".$cu['id_user']."'");

            if ($sets){
                $_SESSION['produk_front'] = $id_pemesanan_f;
                echo "<script>document.location.href = 'pesanan.php'</script>";
            }
          
        } else {
            echo '<div class="toast-alert">
            <div class="toast-body">
                <p class="data-toast">Gagal!</p>
            </div>
        </div>';
        }



    }



    function pesanan($data){
        global $koneksi;
        global $tanggal;
        global $website_url;
        global $whatsaap_number;

        $nama = mysqli_escape_string($koneksi, $data['nama']);
        $catatan = $data['catatan'];

        $id_pemesanan_f = $_SESSION['produk_front'];
        $user_data = uniqid();

        $update = mysqli_query($koneksi, "UPDATE pemesanan_front SET catatan = '$catatan', tanggal_update = '$tanggal' WHERE id_pemesanan_front = '$id_pemesanan_f'");

        $users = $_SESSION['username_user'];

        $id_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$users'");
        $iu = mysqli_fetch_assoc($id_user);


        if ($update){

            $check_u = mysqli_query($koneksi, "SELECT * FROM user_data WHERE id_user = '".$iu['id_user']."'");

            $insert = mysqli_query($koneksi, "INSERT INTO user_data VALUES(NULL, '$user_data', '". $iu['id_user']. "', 'dawdaw', '$tanggal', '$tanggal')");

            $u = mysqli_query($koneksi, "UPDATE users SET nama_lengkap = '$nama', no_telp = 'adawd' WHERE id_user = '".$iu['id_user']."'");

            if ($insert && $u){

                $produk_1 = mysqli_query($koneksi, "SELECT * FROM pemesanan INNER JOIN produk ON pemesanan.id_produk = produk.id_produk WHERE id_pemesanan_f = '$id_pemesanan_f'");
                $produk_2 = mysqli_query($koneksi, "SELECT * FROM pemesanan_front INNER JOIN users ON pemesanan_front.id_user = users.id_user INNER JOIN user_data ON pemesanan_front.id_user = users.id_user WHERE id_pemesanan_front = '$id_pemesanan_f'");

                $pr2 = mysqli_fetch_assoc($produk_2);

                $data_produk = "";
                $no = 1;

                foreach ($produk_1 as $p1) {
                    $data_produk .= "*". $no++ .". ". $p1['nama_produk'] ."* 
                    *Qty: ". $p1['qty'] ."    
                    *Harga: Rp. ". $p1['harga'] ."  
                    *Total Harga: Rp. ". $p1['sub_harga'] ."";
                }


                $template_m = urlencode("Hai, saya mau order :

                ". $data_produk ."
                
                **Ongkir* : Oleh Admin 
                *Voucher* : ". $pr2['voucher'] ."
                **Total* : Rp. ". $pr2['total'] ."
                Catatan : 
                *". $pr2['catatan'] ."*
                --------------------------------
                Nama :
                *". $pr2['nama_lengkap'] ."*
                No. Telp :
                *". $pr2['no_telp'] ."*
                Alamat :
                *". $pr2['alamat'] ."*

                Via https://imajinasi.lesmanadesign.com/");

                header('location: https://api.whatsapp.com/send?phone='. $whatsaap_number .'&text='. $template_m .'');
                unset($_SESSION['produk_front']);

            } else {
                echo "gagal1";
            }

        } else {
            echo "gagal3";
        }
}

?>