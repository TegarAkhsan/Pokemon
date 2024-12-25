<?php
$servername = "localhost";
$username = "root";
$password = "Akhsan45"; // Sesuaikan dengan password phpMyAdmin Anda
$dbname = "pokemonweb_db";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
