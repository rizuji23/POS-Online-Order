<?php 
require 'modelvi.php';
    if (isset($_POST['tableDataProduk'])){
        

        $tableData = $_POST['tableDataProduk'];

        if ($tableData == '*'){
            $data_produk = mysqli_query($koneksi, "SELECT * FROM produk INNER JOIN kategori ON produk.kategori = kategori.id_kategori WHERE produk.status = '1'");
        } else {
            // $data_produk = mysqli_query($con, "SELECT * FROM produk INNER JOIN kategori ON produk.kategori = kategori.id_kategori INNER JOIN sub_kategori ON produk.sub_kategori = sub_kategori.id_subKat WHERE produk.id_produk LIKE '%$tableData%' OR produk.nama_produk LIKE '%$tableData%' OR produk.harga_produk  LIKE '%$tableData%' OR kategori.kategori LIKE '%$tableData%' OR sub_kategori.sub_kategori LIKE '%$tableData%'");
        }
                                        
        

        $no = 1;

        if (mysqli_num_rows($data_produk)){

        foreach ($data_produk as $d){ ?>
        
        <tr>
                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>
                                        <td class="budget">
                                            <?php echo $d['id_produk'] ?>
                                        </td>
                                        <td>
                                            <?php echo $d['nama_produk'] ?>
                                        </td>
                                        <td>
                                            Rp. <?php echo $d['harga'] ?>
                                        </td>
                                        <?php if ($_SESSION['level'] == "Management" || $_SESSION['level'] == "Keuangan" || $_SESSION['level'] == "Kasir" || $_SESSION['level'] == "Marketing") {
                                            echo '<td class="">
                                            <span class="text-danger">(No Privilages)</span>
                                        </td>';
                                        } elseif ($_SESSION['level'] == "Super Admin") { ?>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" onclick="hapusproduk('<?php echo $d['id_produk'] ?>')" class="btn btn-sm btn-danger">Hapus</a>
                                            <a href="editproduk.php?pro=<?php echo $d['id_produk'] ?>" class="btn btn-sm btn-success">Edit</a>
                                            <a href="javascript:void(0)" onclick="detailproduk('<?php echo $d['id_produk'] ?>')" class="btn btn-sm btn-info" data-toggle="modal" data-targe='#detailProduct'>Detail</a>
                                        </td>
                                        <?php } ?>

                                    </tr>
        <?php }
        } else {
            echo "<p><b>Data Tidak Ditemukan</b></p>";
        }
        } elseif (isset($_POST['dataprodukh'])){
            $data = mysqli_real_escape_string($koneksi, $_POST['dataprodukh']);

            $sql = mysqli_query($koneksi, "UPDATE produk SET status = '0' WHERE id_produk='$data'");


        } elseif (isset($_POST['dataDetailp'])){
    
            $dataDetail = mysqli_real_escape_string($koneksi, $_POST['dataDetailp']);
    
            $sql_data = mysqli_query($koneksi, "SELECT * FROM produk INNER JOIN kategori ON produk.kategori = kategori.id_kategori WHERE produk.status = '1' AND id_produk = '$dataDetail'");
    
            $foto_produk = mysqli_query($koneksi, "SELECT * FROM foto_produk WHERE id_produk = '$dataDetail' AND status = '1'");

    
            $ds = mysqli_fetch_array($sql_data);
    
    ?>
    
        <div class="modal_datas">
                <div class="foto_produk">
                    <div class="card">
                        <div class="card-body">
                            <div class="container-foto">
                                <p>Thumbnail Foto Produk</p>
                              
    
                                <div class="img-dproduk">
                                    <img width="200" src="../assets/img/thumb_produk/<?php echo $ds['thumb_img'] ?>" alt="">
                                    </div>
    
                               
                            </div>
                        </div>
                    </div>
                </div>


                <div class="foto_produk">
                    <div class="card">
                        <div class="card-body">
                            <div class="container-foto">
                                <p>Foto Produk</p>
                                <?php 
    
                                    foreach ($foto_produk as $fp){
                                ?>
    
                                <div class="img-dproduk">
                                    <img width="200" src="../assets/img/foto_produk/<?php echo $fp['dir_foto'] ?>" alt="">
                                    </div>
    
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="nama_produk">
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" disabled value="<?php echo $ds['nama_produk'] ?>" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="">Harga Produk</label>
                        <input type="text" disabled value="Rp. <?php echo $ds['harga'] ?>" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="">Deskripsi Produk</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['desk_produk'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tentang Produk</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['tentang_produk'] ?>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="">Volume Produk</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['ml'] ?>ml
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <input type="text" class="form-control" disabled value="<?php echo $ds['kategori'] ?>">
                    </div>
    
                    <div class="form-group">
                        <p for="">Tanggal Dibuat : <span class="text-primary"><?php echo $ds['tanggal'] ?></span></p>
                        <p for="">Tanggal Diupdate : <span class="text-danger"><?php echo $ds['tanggal_update'] ?></span></p>
                        
                    </div>
                    
    
                    
                   
    
                </div>
    
            </div>
    
    
    <?php
    
        } elseif (isset($_POST['tableDatauserm'])){
                    

        $tableData = $_POST['tableDatauserm'];

        if ($tableData == '*'){
            $data_user = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id_user DESC");
        } else {
            // $data_produk = mysqli_query($con, "SELECT * FROM produk INNER JOIN kategori ON produk.kategori = kategori.id_kategori INNER JOIN sub_kategori ON produk.sub_kategori = sub_kategori.id_subKat WHERE produk.id_produk LIKE '%$tableData%' OR produk.nama_produk LIKE '%$tableData%' OR produk.harga_produk  LIKE '%$tableData%' OR kategori.kategori LIKE '%$tableData%' OR sub_kategori.sub_kategori LIKE '%$tableData%'");
        }
                                        
        

        $no = 1;

        if (mysqli_num_rows($data_user)){

        foreach ($data_user as $d){ ?>
        
        <tr>
                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>
                                        <td class="budget">
                                        <?php echo $d['nama_lengkap'] ?>
                                        </td>
                                        <td>
                                        <?php echo $d['username'] ?>
                                        </td>
                                        <td>
                                        
                                                
                                                <?php 
                                                    if ($d['status'] == 2){
                                                ?>
                                                <span class="text-primary">Akun Membership</span>
                                                <?php } elseif ($d['status'] == 3) { ?>
                                                    <span class="text-primary">Akun Tamu</span>
                                                <?php } else { ?>
                                                     <span class="text-danger">Tidak Aktif</span>
                                                <?php } ?>
                                        </td>

                                        <td class="text-right">
                                            
                                            <a href="javascript:void(0)" onclick="detailUser('<?php echo $d['id_user'] ?>')" class="btn btn-sm btn-info">Detail</a>
                                        </td>

                                    </tr>
        <?php }
        } else {
            echo "<p>Data user tidak ditemukan...</p>";
        }
    }elseif (isset($_POST['tableDatausert'])){
                    

        $tableData = $_POST['tableDatausert'];

        if ($tableData == '*'){
            $data_user = mysqli_query($koneksi, "SELECT * FROM user_tamu");
        } else {
            // $data_produk = mysqli_query($con, "SELECT * FROM produk INNER JOIN kategori ON produk.kategori = kategori.id_kategori INNER JOIN sub_kategori ON produk.sub_kategori = sub_kategori.id_subKat WHERE produk.id_produk LIKE '%$tableData%' OR produk.nama_produk LIKE '%$tableData%' OR produk.harga_produk  LIKE '%$tableData%' OR kategori.kategori LIKE '%$tableData%' OR sub_kategori.sub_kategori LIKE '%$tableData%'");
        }
                                        
        

        $no = 1;

        if (mysqli_num_rows($data_user)){

        foreach ($data_user as $d){ ?>
        
        <tr>
                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>
                                        <td class="budget">
                                        <?php echo $d['ip_address'] ?>
                                        </td>
                                       
                                        <td>
                                            <?php if ($d['status'] == 1){ ?>
                                                <span class="text-primary">Aktif</span>
                                            <?php } else { ?>
                                                <span class="text-danger">Tidak Aktif</span>
                                                <?php } ?>
                                        </td>

                                        <td class="text-right">
                                            
                                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                                        </td>

                                    </tr>
        <?php }
        } else {
            echo "<p>Data user tidak ditemukan...</p>";
        }
    } elseif (isset($_POST['dataDetailUsers'])){
        $dataDetail = mysqli_real_escape_string($koneksi, $_POST['dataDetailUsers']);
    
            $sql_data = mysqli_query($koneksi, "SELECT * FROM users INNER JOIN user_data ON users.id_user = user_data.id_user WHERE users.id_user = '$dataDetail'");
    
            $ds = mysqli_fetch_array($sql_data);
    
    ?>
    
        <div class="modal_datas">
                <div class="nama_produk">
                    <div class="form-group">
                        <label for="">Nama User</label>
                        <input type="text" disabled value="<?php echo $ds['nama_lengkap'] ?>" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" disabled value="<?php echo $ds['email'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">No Telp</label>
                        <input type="text" disabled value="<?php echo $ds['no_telp'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" disabled value="<?php echo $ds['username'] ?>" class="form-control">
                    </div>

    
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['alamat'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <?php 
                            if ($ds['status'] == 2){
                        ?>
                        <input type="text" class="form-control" disabled value="Membership">
                        <?php } elseif ($ds['status'] == 3) { ?>
                            <input type="text" class="form-control" disabled value="Tamu">
                        <?php } else { ?>
                            <input type="text" class="form-control" disabled value="Tidak Aktif">
                        <?php } ?>
                    </div>
    
                    <div class="form-group">
                        <p for="">Tanggal Dibuat : <span class="text-primary"><?php echo $ds['tanggal'] ?></span></p>
                        <p for="">Tanggal Diupdate : <span class="text-danger"><?php echo $ds['tanggal_update'] ?></span></p>
                        
                    </div>
                    
    
                    
                   
    
                </div>
    
            </div>
    
    <?php
    } elseif (isset($_POST['dataDetailPenjualan'])){
        $dataDetail = mysqli_real_escape_string($koneksi, $_POST['dataDetailPenjualan']);
    
            $sql_data = mysqli_query($koneksi, "SELECT * FROM pemesanan_front INNER JOIN users ON pemesanan_front.id_user = users.id_user INNER JOIN user_data ON pemesanan_front.id_user = user_data.id_user WHERE id_pemesanan_front = '$dataDetail' ");

            $pemesanan_item = mysqli_query($koneksi, "SELECT * FROM pemesanan INNER JOIN produk ON pemesanan.id_produk = produk.id_produk WHERE id_pemesanan_f = '$dataDetail'");
    
            $ds = mysqli_fetch_array($sql_data);
    
    ?>
    
        <div class="modal_datas">
                <div class="nama_produk">
                    <div class="form-group">
                        <label for="">Nama User</label>
                        <input type="text" disabled value="<?php echo $ds['nama_lengkap'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">No Telp</label>
                        <input type="text" disabled value="<?php echo $ds['no_telp'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" disabled value="<?php echo $ds['username'] ?>" class="form-control">
                    </div>

    
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['alamat'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <div class="card">
                            <div class="card-body">
                                <hr>
                                <?php foreach ($pemesanan_item as $pi){ ?>
                                    <div class="col">
                                        <p style="margin-bottom: 5px"><b><?php echo $pi['nama_produk'] ?></b></p>
                                        <p>Qty : <?php echo $pi['qty'] ?> <br> Sub Total => Rp. <?php echo $pi['sub_harga'] ?></p>
                                    </div>
                                    <hr>
                                <?php } ?>
                               
                              
                               <div class="col">
                                    <p>Voucher => <?php echo $ds['voucher'] ?></p>
                                    <p><b style="color: red;">Total Belanja => Rp. <?php echo number_format($ds['total'], 0, ',', '.') ?></b></p>
                               </div>
                                
                            </div>
                        </div>
                    </div>

                    
    
                    <div class="form-group">
                        <p for="">Tanggal Dibuat : <span class="text-primary"><?php echo $ds['tanggal'] ?></span></p>
                        <p for="">Tanggal Diupdate : <span class="text-danger"><?php echo $ds['tanggal_update'] ?></span></p>
                        
                    </div>
                    
    
                    
                   
    
                </div>
    
            </div>
    
    <?php
    } elseif (isset($_POST['dataDetailkredit'])){
        $dataDetail = mysqli_real_escape_string($koneksi, $_POST['dataDetailkredit']);
    
            $sql_data = mysqli_query($koneksi, "SELECT * FROM kredit WHERE id_kredit = '$dataDetail'");
            $ds = mysqli_fetch_array($sql_data);
    
    ?>
    
        <div class="modal_datas">
                <div class="nama_produk">
                    <div class="form-group">
                        <label for="">Label Kredit</label>
                        <input type="text" disabled value="<?php echo $ds['label_kredit'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi Kredit</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['desk_kredit'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Uang Keluar</label>
                        <input type="text" disabled value="<?php echo $ds['uang_keluar'] ?>" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="">Kategori</label>
                        <input type="text" disabled value="<?php echo $ds['kategori'] ?>" class="form-control">
                    </div>                    
    
                    <div class="form-group">
                        <p for="">Tanggal Dibuat : <span class="text-primary"><?php echo $ds['tanggal'] ?></span></p>
                        <p for="">Tanggal Diupdate : <span class="text-danger"><?php echo $ds['tanggal_update'] ?></span></p>
                        
                    </div>
                    
    
                    
                   
    
                </div>
    
            </div>
    
    <?php
    } elseif (isset($_POST['dataDetaildebit'])){
        $dataDetail = mysqli_real_escape_string($koneksi, $_POST['dataDetaildebit']);
    
            $sql_data = mysqli_query($koneksi, "SELECT * FROM debit WHERE id_debit = '$dataDetail'");
            $ds = mysqli_fetch_array($sql_data);
    
    ?>
    
        <div class="modal_datas">
                <div class="nama_produk">
                    <div class="form-group">
                        <label for="">Label Debit</label>
                        <input type="text" disabled value="<?php echo $ds['label_debit'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi Debit</label>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $ds['desk_debit'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Uang Keluar</label>
                        <input type="text" disabled value="<?php echo $ds['uang_masuk'] ?>" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="">Kategori</label>
                        <input type="text" disabled value="<?php echo $ds['kategori'] ?>" class="form-control">
                    </div>                    
    
                    <div class="form-group">
                        <p for="">Tanggal Dibuat : <span class="text-primary"><?php echo $ds['tanggal'] ?></span></p>
                        <p for="">Tanggal Diupdate : <span class="text-danger"><?php echo $ds['tanggal_update'] ?></span></p>
                        
                    </div>
                    
    
                    
                   
    
                </div>
    
            </div>
    
    <?php
    }
    ?>
    