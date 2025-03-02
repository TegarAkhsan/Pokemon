<?php
// Koneksi ke database
$servername = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "pokemon_db";


// Coba koneksi
$conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

// if (!$conn) {
//     die("Koneksi Gagal : " . mysqli_connect_error());
// } else {
//     echo "Koneksi Berhasil";
// }