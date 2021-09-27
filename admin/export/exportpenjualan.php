<?php 


require '../config/modelvi.php';

if (empty($_SESSION['username_admin']) || empty($_GET['usr'])){
    echo "<script> document.location.href = '../404.html' </script>";
  } else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Penjualan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <div class="header text-center mt-5">
            <div class="text-center">
                <img src="logo.png" width="100" alt="">
            </div>
            <?php 

                $t1 = mysqli_query($koneksi, "SELECT * FROM pemesanan_front WHERE status = '3' ORDER BY tanggal ASC LIMIT 1");
                $t2 = mysqli_query($koneksi, "SELECT * FROM pemesanan_front WHERE status = '3' ORDER BY tanggal DESC LIMIT 1");


                $tt1 = mysqli_fetch_assoc($t1);
                $tt2 = mysqli_fetch_assoc($t2);
            
            ?>
            <div class="text-header">
                <h2>Data Penjualan Imajinasi</h2>
                <p>Tanggal : <?php echo $tt1['tanggal'] ?> - <?php echo $tt2['tanggal'] ?></p>
                <hr>
            </div>

        </div>


        <?php 
        
        
            $data = mysqli_query($koneksi, "SELECT  pf.id_pemesanan_front, pf.id_user, pf.total, pf.tanggal, pf.status, pf.voucher, u.id_user, u.nama_lengkap, ud.alamat, u.no_telp FROM pemesanan_front pf INNER JOIN users u ON pf.id_user = u.id_user INNER JOIN user_data ud ON u.id_user = ud.id_user WHERE pf.status = '3' ORDER BY pf.id_pemesanan_front ASC");


        
        ?>

        <div class="box-data mt-4">
            <?php 
                $no = 1;
                foreach ($data as $d){
                if (!$d['status'] == '0'){
            ?>
            <div class="card mt-5">
                <div class="card-header">
                    <?php echo $no++; ?>.) Tanggal : <span class="text-primary"><?php echo $d['tanggal']; ?></span>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col">
                            <div class="data-text">
                                <p>ID Pesanan : <span class="text-success"><?php echo $d['id_pemesanan_front'] ?></span></p>
                                <p>Nama User : <?php echo $d['nama_lengkap'] ?></p>
                                <p>No Telp : <?php echo $d['no_telp'] ?></p>
                                <p>Alamat : <?php echo $d['alamat'] ?></p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="data-text2">
                                <?php 

                                    $data_produk = mysqli_query($koneksi, "SELECT * FROM pemesanan INNER JOIN produk ON pemesanan.id_produk = produk.id_produk WHERE id_pemesanan_f = '". $d['id_pemesanan_front'] ."'");
                                
                                ?>
                                <p>Data Pesanan :</p>
                                <hr>
                                <?php 

                                    foreach ($data_produk as $dp){
                                
                                ?>
                                
                                <div class="pesanan">
                                    <p><?php echo $dp['nama_produk'] ?></p>
                                    <p>Qty : <?php echo $dp['qty'] ?></p>
                                    <p>Sub Total : Rp.<?php echo $dp['sub_harga'] ?></p>
                                </div>
                                <hr>
                                <?php } ?>

                                <div class="total">
                                    <p>Total : Rp.<?php echo number_format($d['total'],0,',','.') ?></p>
                                    <p>Voucher : <?php echo $d['voucher'] ?></p>
                                <?php if ($d['status'] == '1'){  ?>
                                    <p>Status : <span class="text-danger">Pending</span></p>
                                <?php } elseif ($d['status'] == '2'){ ?>
                                    <p>Status : <span class="text-primary">Proses</span></p>
                                <?php } elseif ($d['status'] == '3') {?>
                                    <p>Status : <span class="text-success">Selesai</span></p>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php }
            } ?>
        </div>

        <hr>

        <?php 

            $qty = mysqli_query($koneksi, "SELECT SUM(qty) AS q FROM pemesanan INNER JOIN pemesanan_front ON pemesanan.id_pemesanan_f = pemesanan_front.id_pemesanan_front WHERE pemesanan_front.status = '3'");
            $q = mysqli_fetch_assoc($qty);

            $harga_total = mysqli_query($koneksi, "SELECT SUM(total) AS total FROM pemesanan_front WHERE status = '3'");
            $ht = mysqli_fetch_assoc($harga_total);
        
        ?>

        <div class="total-all">
            <p>Total Harga Penjualan : <span class="text-success"> Rp.<?php echo number_format($ht['total'],0,',','.') ?></span></p>
            <p>Jumlah Cup/Produk Terjual : <span class="text-primary ">(<?php echo $q['q']; ?>)</span> Cup/Produk</p>
            <div class="text-right">
                <small>Generate Report pada tanggal <?php echo date('d/m/Y') ?></small>
            </div>
        </div>
<hr>
        <div class="footer text-center mt-2 mb-5">
            <small class="text-info">Copyright &copy; Rizki Fauzi - 2021</small>
        </div>

    </div>

    <script>

        window.print()

    </script>
</body>

</html>
<?php } ?>