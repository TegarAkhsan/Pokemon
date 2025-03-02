<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Debugging: Cek apakah sesi sudah ada
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// Ambil semua Pokémon dari database
$sql = "SELECT p.id, p.name, p.type, p.image_path, 
        CASE WHEN uc.pokemon_id IS NOT NULL THEN 1 ELSE 0 END AS owned 
        FROM pokedex p 
        LEFT JOIN user_collection uc ON p.id = uc.pokemon_id AND uc.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Pokémon Saya</title>
    <link rel="stylesheet" href="css/collection.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="notification" id="notification">
            <p><?php echo $_SESSION['message']; ?></p>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <div class="collection-container">
        <h2>Koleksi Pokémon Saya</h2>
        <div class="pokemon-collection">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card <?php echo ($row['owned'] ? 'owned' : 'not-owned'); ?>">
                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>" class="pokemon-img">
                    <h2><?php echo $row['name']; ?></h2>
                    <p>Tipe: <?php echo $row['type']; ?></p>
                    <?php if (!$row['owned']): ?>
                        <form action="add_to_collection.php" method="POST">
                            <input type="hidden" name="pokemon_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Tambahkan ke Koleksi</button>
                        </form>
                    <?php else: ?>
                        <button class="owned-button" disabled>Dimiliki</button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <script>
    setTimeout(function() {
        var notification = document.getElementById("notification");
        if (notification) {
            notification.style.display = "none";
        }
    }, 2000);
    </script>

</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
