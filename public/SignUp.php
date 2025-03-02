<?php
// Koneksi ke database
$servername = "127.0.0.1";
$db_name = "pokemon_db";
$db_username = "root"; // Sesuaikan dengan username phpMyAdmin Anda
$db_password = ""; // Sesuaikan dengan password phpMyAdmin Anda

// Coba koneksi
$conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Proses form signup
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing password

    // Query untuk menyimpan data
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Tampilkan pesan signup berhasil dengan tombol login
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Signup Successful</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-image: url('css/Main-Background.png');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    height: 100vh;
                }
                .success-container {
                    background: #ffffff;
                    max-width: 400px;
                    margin: 0 auto;
                    border: 1px solid #ccc;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                .success-container h1 {
                    color: green;
                }
                .btn-login {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    color: #fff;
                    background-color: #007BFF;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 16px;
                    text-align: center;
                }
                .btn-login:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='success-container'>
                <h1>Signup Successful!</h1>
                <p>Your account has been created successfully.</p>
                <a href='Login.html' class='btn-login'>Login Now</a>
            </div>
        </body>
        </html>";
        exit(); // Menghentikan eksekusi setelah output
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
