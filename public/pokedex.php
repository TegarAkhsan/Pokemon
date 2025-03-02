<?php
include 'koneksi.php';

// Ambil tipe Pokémon dari URL, default ke Fire jika tidak ada parameter
$type = isset($_GET['type']) ? $_GET['type'] : 'Fire';  
$sql = "SELECT * FROM pokedex WHERE type LIKE '%$type%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $type; ?> Pokémon</title>
    <link rel="stylesheet" href="css/pokedex.css"> <!-- Tambahkan kembali CSS -->
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="hero">
        <img src="images/pokedex-image/Fire-Pokedex.png" class="hero-img">
    </div>
    <div class="hero-space"></div>

    <div class="type-pokemon">
        <button class="fire" onclick="window.location.href='pokedex.php?type=Fire'">Fire</button>
        <button class="water" onclick="window.location.href='pokedex.php?type=Water'">Water</button>
        <button class="grass" onclick="window.location.href='pokedex.php?type=Grass'">Grass</button>
        <button class="ground" onclick="window.location.href='pokedex.php?type=Ground'">Ground</button>
        <button class="rock" onclick="window.location.href='pokedex.php?type=Rock'">Rock</button>
        <button class="dark" onclick="window.location.href='pokedex.php?type=Dark'">Dark</button>
        <button class="dragon" onclick="window.location.href='pokedex.php?type=Dragon'">Dragon</button>
        <button class="steel" onclick="window.location.href='pokedex.php?type=Steel'">Steel</button>
    </div>

    <?php
    // Misalkan $result adalah hasil query dari database
    $counter = 0; // Counter untuk menghitung jumlah card
    $containerCount = 1; // Counter untuk menentukan container saat ini

    while ($row = $result->fetch_assoc()):
        // Jika counter habis dibagi 3 dan bukan awal, tutup container sebelumnya dan buka container baru
        if ($counter % 3 == 0 && $counter != 0) {
            echo '</div>'; // Tutup container sebelumnya
            $containerCount++; // Naikkan counter container
        }

        // Jika counter habis dibagi 3, buka container baru
        if ($counter % 3 == 0) {
            echo '<div class="con-' . $containerCount . '-pokedex">';
        }
        ?>

        <div class="card" onclick="showPopup('<?php echo $row['name']; ?>', '<?php echo $row['type']; ?>', '<?php echo $row['image_path']; ?>')">
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>" class="card-pokemon">
            <h2><?php echo $row['name']; ?></h2>
            <div class="type">
                <button class=><?php echo $row['type']; ?></button>
            </div>
        </div>

        <?php
        $counter++; // Naikkan counter card
    endwhile;

    // Tutup container terakhir jika masih terbuka
    if ($counter % 3 != 0) {
        echo '</div>';
    }
    ?>

    <div class="popup" id="popup">
        <span class="close" onclick="closePopup()">✖</span>
        <img id="popup-img" src="" alt="" class="popup-img">
        <h2 id="pokemon-name"></h2>
        <p id="pokemon-type"></p>
    </div>

    <script>
        
        function showPopup(name, type, image) {
            document.getElementById("pokemon-name").innerText = name;
            document.getElementById("pokemon-type").innerText = "Type: " + type;
            document.getElementById("popup-img").src = image;
            document.getElementById("popup").classList.add("active");
        }

        function closePopup() {
            document.getElementById("popup").classList.remove("active");
        }

        // Event listener untuk klik pada setiap kartu Pokémon
        document.querySelectorAll(".card").forEach(card => {
            card.addEventListener("click", () => {
                const pokemonName = card.querySelector("h2").innerText;
                const pokemonType = card.querySelector("button").innerText;
                const pokemonImg = card.querySelector("img").src;
                showPopup(pokemonName, pokemonType, pokemonImg);
            });
        });
    </script>
    <script src="js/pokedex-header.js"></script>
</body>
</html>

<?php $conn->close(); ?>
