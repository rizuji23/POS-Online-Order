<?php 

require 'database.php';

$tanggal = date("d-m-Y h:i:s A");
$koneksi = mysqli_connect($host, $username, $password, $database);
$website_url = 'https://google.com';
$whatsaap_number = '';

?>