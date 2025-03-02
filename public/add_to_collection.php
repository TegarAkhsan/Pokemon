<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $pokemon_id = $_POST['pokemon_id'];

    // Periksa apakah Pokémon sudah ada di koleksi
    $check_sql = "SELECT * FROM user_collection WHERE user_id = ? AND pokemon_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $pokemon_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Tambahkan Pokémon ke koleksi
        $insert_sql = "INSERT INTO user_collection (user_id, pokemon_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $user_id, $pokemon_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Pokémon berhasil ditambahkan ke koleksi!";
        } else {
            $_SESSION['message'] = "Terjadi kesalahan. Coba lagi.";
        }
    } else {
        $_SESSION['message'] = "Pokémon sudah ada di koleksi!";
    }

    $stmt->close();
    $conn->close();
    header("Location: collection.php");
    exit();
}
?>
