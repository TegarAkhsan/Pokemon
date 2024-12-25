<?php
// Koneksi ke database
$servername = "localhost:3308";
$db_name = "pokemon_db";
$db_username = "root"; // Sesuaikan dengan username phpMyAdmin Anda
$db_password = "Akhsan45"; // Sesuaikan dengan password phpMyAdmin Anda

// Coba koneksi
$conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
} else {
    echo "Koneksi Berhasil";
}