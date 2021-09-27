<?php 


    // $msg = "Halo kak, saya mau order .

    // 1. Fresh Milk Boba Aren Cheese M 
    //   Quantity: 2 
    //   Harga (@): Rp 17.000 
    //   Total Harga: Rp 34.000 
    
    // 2. Red Velvet Boba Aren Cheese L 
    //   Quantity: 1 
    //   Harga (@): Rp 20.000 
    //   Total Harga: Rp 20.000 
    
    // 3. Mango Yakult M 
    //   Quantity: 1 
    //   Harga (@): Rp 12.000 
    //   Total Harga: Rp 12.000 
    
    // 4. Kacang Kedelai Cheese M 
    //   Quantity: 1 
    //   Harga (@): Rp 16.000 
    //   Total Harga: Rp 16.000 
    
    // Sub Total : Rp 82.000
    // Ongkir : By Admin 
    // Total : Rp 82.000
    
    // Catatan : 
    // Red Velvet less ice Kacang kedelai less ice Pisan 
    
    // --------------------------------
    // Nama :
    // Reka  ( 089637279115 ) 
    
    // Alamat :
    // Jl. Ibu Noch Kartanegara No.63, Sukamentri, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44116
    
    // Via https://cimanuk.tekunindo.com/";

    // header('location: https://api.whatsapp.com/send?phone=+6289655180103&text='.urlencode($msg));


    $data = array(1, 2, 2, 3);

    $item = "";
    foreach ($data as $d){
        $item .= "awdawdaw <br>".$d;
    }

    echo $item;

?>