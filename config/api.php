<?php 
require 'modelvi.php';
   
if (isset($_POST['masuktamu'])){
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
    
    $id_tamu = uniqid();

    $check = mysqli_query($koneksi, "SELECT  * FROM users WHERE username = '$ipaddress'");
    $cip = mysqli_fetch_assoc($check);
    
    if ($cip['username'] == $ipaddress){
        $_SESSION['username_user'] = $cip['username'];
        $_SESSION['level'] = 'tamu';

    } else {
        $sql = mysqli_query($koneksi, "INSERT INTO users VALUES(NULL, '$id_tamu', '-', '-', '-', '$ipaddress', '-','3', '0','$tanggal', '$tanggal')");
        if ($sql){
            $_SESSION['username_user'] = $ipaddress;
            $_SESSION['level'] = 'tamu';

        }
    }

    
    
    

} elseif (isset($_POST['kategori_minum'])){
    $id = mysqli_escape_string($koneksi, $_POST['kategori_minum']);

    $kat1 = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori = '$id' AND status = '1'");

    if (!empty(mysqli_num_rows($kat1))){

    foreach ($kat1 as $k1){

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
        <?php
    }

} else {
    echo '<img src="assets/img/not_found.png" width="100" class="mx-auto d-block" alt="">';
}
} elseif (isset($_POST['cart-in'])){
    $user = $_SESSION['username_user'];
    $check_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");

    $cu = mysqli_fetch_assoc($check_user);

    $cart = mysqli_query($koneksi, "SELECT * FROM cart INNER JOIN produk ON cart.id_produk = produk.id_produk WHERE id_user = '". $cu['id_user'] ."' AND cart.status = '1'");

    foreach ($cart as $c){

        ?>
            <div class="box-circle ml-3">
                <img src="assets/img/thumb_produk/<?php echo $c['thumb_img'] ?>" class="img-fluid" alt="">
            </div>
        <?php
    }
} elseif (isset($_POST['cartcount'])){
    $user = $_SESSION['username_user'];

    $check_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");

    $cu = mysqli_fetch_assoc($check_user);


    $cart = mysqli_query($koneksi, "SELECT * FROM cart INNER JOIN produk ON cart.id_produk = produk.id_produk WHERE id_user = '". $cu['id_user'] ."' AND cart.status = '1'");

    $c = mysqli_num_rows($cart);

    echo $c;
} elseif (isset($_POST['cartproduk']) && isset($_POST['qty'])){
    $user  = $_SESSION['username_user'];
    $qty = mysqli_escape_string($koneksi, $_POST['qty']);

    $check_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");

    $cu = mysqli_fetch_assoc($check_user);

    $cd = mysqli_escape_string($koneksi, $_POST['cartproduk']); 

    $id_cart = uniqid();

    $check = mysqli_query($koneksi, "SELECT * FROM cart WHERE id_user = '". $cu['id_user'] ."' AND id_produk = '$cd' AND status = '1'");

    if (empty(mysqli_num_rows($check))){
        $sql = mysqli_query($koneksi, "INSERT INTO cart VALUES(NULL, '$id_cart', '$cd', '". $cu['id_user'] ."', '$qty','1', '$tanggal', '$tanggal')");

        echo "Produk disimpan dikeranjang...";
    } else {
        echo "Produk sudah ada dikeranjang...";
    }

    

} elseif (isset($_POST['datacart'])){
    $user  = $_SESSION['username_user'];

    $check_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");

    $cu = mysqli_fetch_assoc($check_user);

    $produk = mysqli_query($koneksi, "SELECT * FROM cart INNER JOIN produk ON cart.id_produk = produk.id_produk WHERE id_user = '". $cu['id_user'] ."' AND cart.status = '1'");


    foreach ($produk as $p){

        ?>
 <div class="cart-box">
                    <div class="row no-gutters" id="">
                        <div class="col-sm">
                            <div class="img-cart">
                                <img src="assets/img/thumb_produk/<?php echo $p['thumb_img'] ?>" class="cart-produk" alt="">
                            </div>
                            <div class="text-cart">
                                <p><?php echo $p['nama_produk'] ?></p>
                                <span>Rp. <?php echo $p['harga'] ?></span>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="qty-cart">
                                <div class="qty2">
                                    <div class="number2">
                                        <span class="minus2">-</span>
                                        <input type="text" name="qty[]" class="qty-input2" value="1" />
                                        <span class="plus2">+</span>
                                    </div>
                                </div>
                                <a href="#">Hapus Produk</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php 
    }

} elseif (isset($_POST['kode'])){
    $kode = mysqli_escape_string($koneksi, $_POST['kode']);

    $check = mysqli_query($koneksi, "SELECT * FROM voucher WHERE kode_voucher = '$kode'");
    $ck = mysqli_num_rows($check);

    if (!$ck == 0){
        $pf = $_SESSION['produk_front'];

        $ps = mysqli_query($koneksi, "SELECT * FROM pemesanan_front WHERE id_pemesanan_front = '$pf'");
        $p = mysqli_fetch_assoc($ps);

        $total_harga = $p['total'];
        $percent = $ck['percent'];
        $totals =  ($percent/100) * $total_harga;
        $total_harga2 = $total_harga - $totals;

        $da = mysqli_query($koneksi, "UPDATE pemesanan_front SET total = '$total_harga2', voucher = '$kode', tanggal_update = '$tanggal' WHERE id_pemesanan_front = '$pf'");

        if ($da){
            echo "Voucher digunakan...";
        } else {
            echo "Voucher gagal digunakan...";
        }
    } else {
        echo "Voucher yang diinput tidak benar...";
    }
} elseif (isset($_POST['kode2'])){
    $kode = mysqli_escape_string($koneksi, $_POST['kode2']);

    $check = mysqli_query($koneksi, "SELECT * FROM voucher WHERE kode_voucher = '$kode'");
    $ck = mysqli_num_rows($check);

    if (!$ck == 0){
        $pf = $_SESSION['produk_front'];

        $ps = mysqli_query($koneksi, "SELECT * FROM pemesanan_front WHERE id_pemesanan_front = '$pf'");
        $p = mysqli_fetch_assoc($ps);

        ?>
            <div class="tot-har-foot">
                <p id="">Rp. <span class="pharga"><?php echo number_format($p['total'], 0, ',', '.'); ?></span></p>

                </div>
                                    
                <div class="voucher-text">
                    <p>Voucher - <span><?php echo $ck['kode_voucher'] ?></span> Potongan <span><?php echo $ck['percent'] ?>%</span></p>
                </div>
        <?php
    } else {
        // echo "Voucher yang diinput tidak benar...";
    }

} elseif (isset($_POST['batalpesanan'])){
    if ($_POST['batalpesanan'] == 1){
        $pf = $_SESSION['produk_front'];
        $del = mysqli_query($koneksi, "UPDATE pemesanan_front SET status = '0' WHERE id_pemesanan_front = '$pf'");
        if ($del) {
            $del2 = mysqli_query($koneksi, "UPDATE pemesanan SET status = '0' WHERE id_pemesanan_f = '$pf'");

            if ($del2){
                echo "done";
            } else {
                echo "error del2";
            }
        } else {
            echo "error del";
        }
    }
}

?>
    