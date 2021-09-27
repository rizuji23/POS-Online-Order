<?php 
session_start();

    require 'config.php';

    function login($data){
        global $koneksi;
        global $tanggal;

        $username = mysqli_real_escape_string($koneksi, $data['username']);
        $password = mysqli_real_escape_string($koneksi, $data['password']);

        $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '".$username."' AND password = '".md5($password)."'");
        $l = mysqli_fetch_assoc($login);

        if ($l['username'] == $username && $l['password'] == md5($password) && $l['status'] == 1){
            $_SESSION['username_admin'] = $l['username'];
            $_SESSION['level'] = $l['level'];
            
            $id_admin = $l['id_admin'];
            $username = $l['username'];
            
            if(mysqli_query($koneksi, "INSERT INTO log_admin VALUES(NULL, '$id_admin', '$username', 'Logging', '$tanggal', '$tanggal')")){
                echo "<script> alert('Selamat Datang ". $l['nama_admin'] ."'); document.location.href = 'dashboard.php'; </script>";
            }

            
        } else {
            echo "<script> alert('Username atau Password Salah, atau Akun anda belum di aktifasi!'); document.location.href = 'index.php'; </script>";

        }

    }


    function simpan_kategori($data){
        global $koneksi;
        global $tanggal;

        $nama_kategori = htmlspecialchars($data['nama_kategori']);
        $jenis_kategori = htmlspecialchars($data['jenis_kategori']);

        $id_kategori = uniqid();

        $sql = mysqli_query($koneksi, "INSERT INTO kategori VALUES(NULL, '$id_kategori', '$nama_kategori', '$jenis_kategori', '1', '$tanggal', '$tanggal')");

        if ($sql){
            echo "<script> alert('Kategori Sudah Disimpan'); document.location.href = 'pengaturan.php'; </script>";
        } else {
            echo "<script> alert('Kategori Gagal Disimpan!!'); document.location.href = 'pengaturan.php'; </script>"; 
        }
    }

    function simpan_produk($data){
        global $koneksi;
        global $tanggal;

        $nama_produk = htmlspecialchars($data['nama_produk']);
        $desk_produk = htmlspecialchars($data['desk_produk']);
        $harga = htmlspecialchars($data['harga']);
        $vol = htmlspecialchars($data['vol']);
        $tentang = htmlspecialchars($data['tentang']);
        $kategori = htmlspecialchars($data['kategori']);
        $thumb_foto = $_FILES['thumb_foto']['name'];
        $temp_thumb = $_FILES['thumb_foto']['tmp_name'];

        $id_produk = uniqid();
        $id_produk_foto = uniqid();
        
        $total_foto_produk = count($_FILES['foto_produk']['name']);

        for ($i = 0; $i < $total_foto_produk; $i++){
            $foto_produk_tmp = $_FILES['foto_produk']['tmp_name'][$i];

            $extension_produk = explode('.', $_FILES['foto_produk']['name'][$i]);
            $extension_produk = strtolower(end($extension_produk));

            if ($foto_produk_tmp != ""){
                
                $namaBaru = uniqid();
                $namaBaru .= '.';
                $namaBaru .= $extension_produk;

                $filepath = "/home/lesc9227/public_html/imajinasi/assets/img/foto_produk/" . $namaBaru;

                if (move_uploaded_file($foto_produk_tmp, $filepath)){
                    $data_upload = mysqli_query($koneksi, "INSERT INTO foto_produk VALUES(NULL, '$id_produk_foto', '$id_produk', '$namaBaru', '1','$tanggal', '$tanggal')");
                    
                } else {
                    echo "<script> alert('Gagal Memindah Gambar Produk!!'); document.location.href = 'dataproduk.php' </script>";
                }
            }

        }

        $extension_thumb = explode('.', $thumb_foto);
        $extension_thumb = strtolower(end($extension_thumb));

        $namaBaruThumb = uniqid();
        $namaBaruThumb .= '.';
        $namaBaruThumb .= $extension_thumb;

        $filepath2 = "/home/lesc9227/public_html/imajinasi/assets/img/thumb_produk/" . $namaBaruThumb;

        move_uploaded_file($temp_thumb, $filepath2);

        $dataall = mysqli_query($koneksi, "INSERT INTO produk VALUES(NULL, '$id_produk', '$nama_produk', '$desk_produk', '$namaBaruThumb', '$id_produk_foto', '$harga', '$tentang', '$vol', '$kategori', '1', '$tanggal', '$tanggal')");

        if ($dataall){
            echo "<script> alert('Produk Sudah Disimpan'); document.location.href = 'dataproduk.php'; </script>";
        } else {
            echo "<script> alert('Produk Gagal Disimpan!!'); document.location.href = 'dataproduk.php'; </script>"; 
        }
        
    }


    function edit_produk($data, $id){
        global $koneksi;
        global $tanggal;

        $nama_produk = htmlspecialchars($data['nama_produk']);
        $desk_produk = htmlspecialchars($data['desk_produk']);
        $harga = htmlspecialchars($data['harga']);
        $vol = htmlspecialchars($data['vol']);
        $tentang = htmlspecialchars($data['tentang']);
        $kategori = htmlspecialchars($data['kategori']);


        $sql = mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$nama_produk', desk_produk = '$desk_produk', harga = '$harga', ml = '$vol', tentang_produk = '$tentang', kategori = '$kategori', tanggal_update = '$tanggal' WHERE id_produk = '$id' ");

        if ($sql){
            echo "<script> alert('Produk Sudah Diedit'); document.location.href = 'kelolaproduk.php'; </script>";
        } else {
            echo "<script> alert('Produk Gagal Diedit!!'); document.location.href = 'kelolaproduk.php'; </script>"; 
        }

    }


    function editfoto($data, $id){
        global $koneksi;
        global $tanggal;

        $total_foto_produk = count($_FILES['foto_produk']['name']);

        $id_produk_foto = uniqid();
        mysqli_query($koneksi, "UPDATE foto_produk SET status = '0' WHERE id_produk = '$id'");
        for ($i = 0; $i < $total_foto_produk; $i++){
            $foto_produk_tmp = $_FILES['foto_produk']['tmp_name'][$i];

            $extension_produk = explode('.', $_FILES['foto_produk']['name'][$i]);
            $extension_produk = strtolower(end($extension_produk));

            if ($foto_produk_tmp != ""){
                
                $namaBaru = uniqid();
                $namaBaru .= '.';
                $namaBaru .= $extension_produk;

                $filepath = "/home/lesc9227/public_html/imajinasi/assets/img/foto_produk/" . $namaBaru;

                if (move_uploaded_file($foto_produk_tmp, $filepath)){
                    
                    $data_upload = mysqli_query($koneksi, "INSERT INTO foto_produk VALUES(NULL, '$id_produk_foto', '$id', '$namaBaru', '1','$tanggal', '$tanggal')");
                    echo "<script> alert('Foto Sudah Diedit'); document.location.href = 'kelolaproduk.php'; </script>";
                } else {
                    echo "<script> alert('Gagal Memindah Gambar Produk!!'); document.location.href = 'kelolaproduk.php' </script>";
                }
            }

        }
    }

    function simpanvoucher($data){
        global $koneksi;
        global $tanggal;

        $kode_v = mysqli_escape_string($koneksi, $data['kode_voucher']);
        $percent = mysqli_escape_string($koneksi, $data['percent_potongan']);
        $jenis_voucher = mysqli_escape_string($koneksi, $data['jenis_voucher']);

        $id_voucher = uniqid();

        $sql = mysqli_query($koneksi, "INSERT INTO voucher VALUES(NULL, '$id_voucher', '$kode_v', '$percent', '$jenis_voucher', '1', '$tanggal', '$tanggal')");

        if ($sql){
            echo "<script> alert('Voucher Sudah Disimpan'); document.location.href = 'pengaturan.php'; </script>";
                } else {
                    echo "<script> alert('Voucher Gagal Disimpan!!'); document.location.href = 'pengaturan.php' </script>";
                }

    }
    
    
     function edit_kategori($data, $id){
        global $koneksi;
        global $tanggal;

        $kategori = mysqli_escape_string($koneksi, $data['kategori']);
        $jenis_kategori = mysqli_escape_string($koneksi, $data['jenis_kategori']);


        $update = mysqli_query($koneksi, "UPDATE kategori SET kategori = '$kategori', jenis_kategori = '$jenis_kategori' WHERE id_kategori = '$id'");


        if ($update){
            echo "<script> alert('Kategori berhasil diedit'); document.location.href = 'kelolakategori.php'; </script>";
                } else {
                    echo "<script> alert('Kategori gagal diedit!!'); document.location.href = 'kelolakategori.php' </script>";
                }
    }


    function edit_voucher($data, $id){
        global $koneksi;
        global $tanggal;

        $kode_voucher = mysqli_escape_string($koneksi, $data['kode_voucher']);
        $percent = mysqli_escape_string($koneksi, $data['percent']);
        $jenis_voucher = mysqli_escape_string($koneksi, $data['jenis_voucher']);

        $update = mysqli_query($koneksi, "UPDATE voucher SET kode_voucher = '$kode_voucher', percent = '$percent', jenis_voucher = '$jenis_voucher' WHERE id_voucher = '$id'");

        if ($update){
            echo "<script> alert('Voucher berhasil diedit'); document.location.href = 'kelolavoucher.php'; </script>";
                } else {
                    echo "<script> alert('Voucher gagal diedit!!'); document.location.href = 'kelolavoucher.php' </script>";
                }
    }


    function simpan_user($data){
        global $koneksi;
        global $tanggal;


        $nama_admin = mysqli_escape_string($koneksi, $data['nama_admin']);
        $email_admin = mysqli_escape_string($koneksi, $data['email_admin']);
        $username = mysqli_escape_string($koneksi, $data['username']);
        $password = mysqli_escape_string($koneksi, $data['password']);

        $level = mysqli_escape_string($koneksi, $data['level']);

        $password_md5 = md5($password);

        $id_admin = uniqid();

        $input = mysqli_query($koneksi, "INSERT INTO admin VALUES(NULL, '$id_admin','$nama_admin', '$email_admin', '$username', '$password_md5', '$level', '1', '$tanggal', '$tanggal')");

        if ($input){
            echo "<script> alert('Admin berhasil disimpan'); document.location.href = 'pengaturan.php'; </script>";
                } else {
                    echo "<script> alert('Admin gagal disimpan!!'); document.location.href = 'pengaturan.php' </script>";
                }


    }

    function edit_admin($data, $id){
        global $koneksi;
        global $tanggal;


        $nama_admin = mysqli_escape_string($koneksi, $data['nama_admin']);
        $email_admin = mysqli_escape_string($koneksi, $data['email_admin']);
        $username = mysqli_escape_string($koneksi, $data['username']);
        $level = mysqli_escape_string($koneksi, $data['level']);

        $update = mysqli_query($koneksi, "UPDATE admin SET nama_admin = '$nama_admin', email_admin = '$email_admin', username = '$username', level = '$level' WHERE id_admin = '$id'");

        if ($update){
            echo "<script> alert('Admin berhasil diedit'); document.location.href = 'kelolaadmin.php'; </script>";
                } else {
                    echo "<script> alert('Admin gagal diedit!!'); document.location.href = 'kelolaadmin.php' </script>";
                }
    }


    function simpanpemasukan($data){
        global $koneksi;
        global $tanggal;


        $label_debit = mysqli_escape_string($koneksi, $data['label_debit']);
        $desk_debit = mysqli_escape_string($koneksi, $data['desk_debit']);
        $tanggal2 = mysqli_escape_string($koneksi, $data['tanggal']);
        $uang_masuk = mysqli_escape_string($koneksi, $data['uang_masuk']);
        $kategori = mysqli_escape_string($koneksi, $data['kategori']);

        $id_debit = uniqid();

        $input = mysqli_query($koneksi, "INSERT INTO debit VALUES(NULL, '$id_debit', '$label_debit', '$desk_debit', '$tanggal2', '$uang_masuk', '$kategori', '1','$tanggal')");

        if ($input){
            echo "<script> alert('Debit berhasil ditambah'); document.location.href = 'tambahpemasukan.php'; </script>";
                } else {
                    echo "<script> alert('Debit gagal ditambah!!'); document.location.href = 'tambahpemasukan.php' </script>";
                }

    }


    function simpankredit($data){
        global $koneksi;
        global $tanggal;


        $label_kredit = mysqli_escape_string($koneksi, $data['label_kredit']);
        $desk_kredit = mysqli_escape_string($koneksi, $data['desk_kredit']);
        $tanggal2 = mysqli_escape_string($koneksi, $data['tanggal']);
        $uang_keluar = mysqli_escape_string($koneksi, $data['uang_keluar']);
        $kategori = mysqli_escape_string($koneksi, $data['kategori']);

        $id_kredit = uniqid();

        $input = mysqli_query($koneksi, "INSERT INTO kredit VALUES(NULL, '$id_kredit', '$label_kredit', '$desk_kredit', '$tanggal2', '$uang_keluar', '$kategori', '1', '$tanggal')");

        if ($input){
            echo "<script> alert('Kredit berhasil ditambah'); document.location.href = 'tambahpemasukan.php'; </script>";
                } else {
                    echo "<script> alert('Kredit gagal ditambah!!'); document.location.href = 'tambahpemasukan.php' </script>";
                }

    }


?>