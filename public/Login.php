<?php
ob_start();// Memastikan tidak ada output sebelum header
session_start(); // Memulai sesi

// Koneksi ke database
$servername = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "pokemon_db";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Simpan user_id di sesi
            $_SESSION['username'] = $user['username']; // Simpan username (opsional)
            header("Location: index.php"); // Arahkan ke halaman Collection setelah login
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
?>
