<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

$message = "";

// Proses form jika tombol "Tambah Pokémon" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $type = $_POST["type"];
    $targetDir = "images/pokedex-image/Pokemon/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Periksa apakah file gambar valid
    $validExtensions = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $validExtensions)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Simpan data ke database
            $sql = "INSERT INTO pokedex (name, type, image_path) VALUES ('$name', '$type', '$targetFilePath')";
            if ($conn->query($sql) === TRUE) {
                $message = "Pokémon berhasil ditambahkan!";
            } else {
                $message = "Error: " . $conn->error;
            }
        } else {
            $message = "Gagal mengunggah gambar.";
        }
    } else {
        $message = "Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Pokémon</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div class="admin-container">
        <h2>Tambah Pokémon ke Pokedex</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="admin_pokedex.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nama Pokémon:</label>
            <input type="text" name="name" id="name" required>

            <label for="type">Tipe Pokémon:</label>
            <select name="type" id="type" required>
                <option value="Fire">Fire</option>
                <option value="Water">Water</option>
                <option value="Grass">Grass</option>
                <option value="Electric">Electric</option>
                <option value="Ice">Ice</option>
                <option value="Fighting">Fighting</option>
                <option value="Poison">Poison</option>
                <option value="Ground">Ground</option>
                <option value="Flying">Flying</option>
                <option value="Psychic">Psychic</option>
                <option value="Bug">Bug</option>
                <option value="Rock">Rock</option>
                <option value="Ghost">Ghost</option>
                <option value="Dragon">Dragon</option>
                <option value="Dark">Dark</option>
                <option value="Steel">Steel</option>
                <option value="Fairy">Fairy</option>
            </select>

            <label for="image">Upload Gambar Pokémon:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <button type="submit">Tambah Pokémon</button>
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>
