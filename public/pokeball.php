<?php
include 'koneksi.php'; // Koneksi ke database

// Ambil data Poké Ball dari database
$sql = "SELECT * FROM pokeball";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon World</title>
    <link rel="stylesheet" href="css/pokeball.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="hero">
        <div class="main-col">
            <div class="container-1">
                <img src="images/pokeball-image/Pokeball.png" class="redball">
                <h1>Poke Ball</h1>
            </div>                
            <div class="container-2">
                <img src="images/pokeball-image/Masterball.png" class="purpleball">
                <h1>Master Ball</h1>
            </div>
            <div class="container-3">
                <img src="images/pokeball-image/Ultraball.png" class="greenball">
                <h1>Ultra Ball</h1>
            </div>
        </div>
    </div>

    <div class="col-1-pokeball">
        <img src="images/pokeball-image/Pokeball.png">
        <div class="col-1-text">
            <h2>Poke Ball</h2>
            <p>
                The Poké Ball is an essential tool in the Pokémon world used to capture and store wild Pokémon.
                The Poké Ball has a distinctive design shaped like a sphere, primarily colored red and white, with a button in the center used to open or close the ball.
            </p>
            <p>
                The Poké Ball functions as a portable container designed to compress and store Pokémon in a smaller size, allowing Pokémon trainers to carry multiple Pokémon at once.
                Each type of Poké Ball has unique abilities and features that facilitate the process of capturing Pokémon.
            </p>
            <p>
                Poké Balls are used to capture different types of Pokémon.
                There are different variations of Poké Balls tailored to specific situations, such as Ultra Ball for more powerful captures or Net Ball for water and insect-type Pokémon.
            </p>
        </div>
    </div>

    <div class="col-2-pokeball">
        <div class="col-2-text">
            <h2>Ultraball</h2>
            <p>
                Ultra Ball is a type of Poké Ball that has a higher effectiveness rate compared to standard Poké Ball and Great Ball.
                With a catch rate twice as large as a regular Poké Ball, Ultra Ball increases the trainer's chances of catching wild Pokémon, especially those with low catch rates or those that are harder to tame.
                Ultra Ball is especially useful when trainers are in urgent situations or when facing strong Pokémon in the wild, as it provides a 2x catch modification.
            </p>
            <p>
                Ultra Ball is one of the tools often used by trainers at advanced levels, and is usually available at Pokémon stores (Poké Mart) at a higher price than Poké Ball and Great Ball. Although not as powerful as Master Ball, Ultra Ball is still a very
                effective option when Master Ball is not available or you want to save it for more difficult or rare Pokémon.
            </p>
        </div>
        <img src="images/pokeball-image/Ultraball.png">
    </div>

    <div class="col-3-pokeball">
        <img src="images/pokeball-image/Masterball.png">
        <div class="col-3-text">
            <h2>Masterball</h2>
            <p>
                Master Ball, on the other hand, is an extremely powerful Poké Ball with a perfect catch rate, meaning it can catch any wild Pokémon without fail. This makes Master Ball a very valuable item and is usually given out in very limited quantities during
                a Pokémon trainer's journey. Because of its sure-catch nature, trainers tend to save it for legendary or extremely rare Pokémon that are difficult to catch using other types of Poké Balls.
            </p>
            <p>
                In Pokémon lore, Master Ball is described as a technology that is very difficult to produce and extremely rare. This reason explains why Master Balls are not commercially available in Poké Marts, and players only obtain them
                through specific events or from important characters in the game. The effectiveness and exclusivity of Master Ball make it the most desired Poké Ball among Pokémon trainers.
            </p>
        </div>
    </div>

    <div class="all-pokeball">
        <h2>More Pokeball</h2>
    </div>    

    <!-- Container untuk menampilkan kartu dalam 3 kolom -->
    <div class="con-4-pokeball">
        <?php
        // Reset pointer hasil query agar bisa digunakan kembali
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()):
        ?>
            <div class="card" onclick="showPopup('<?php echo $row['name']; ?>', '<?php echo $row['description']; ?>', '<?php echo $row['image_path']; ?>')">
                <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
                <h2><?php echo $row['name']; ?></h2>
                <div class="detail-ball">
                    <button>Read Detail</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Popup untuk menampilkan detail -->
    <div class="popup" id="popup">
        <span class="close" onclick="closePopup()">✖</span>
        <img id="popup-img" src="" alt="" class="popup-img">
        <h2 id="pokeball-name"></h2>
        <p id="pokeball-description"></p>
    </div>

    <script>
        function showPopup(name, description, image) {
            document.getElementById("pokeball-name").innerText = name;
            document.getElementById("pokeball-description").innerText = description;
            document.getElementById("popup-img").src = image;
            document.getElementById("popup").classList.add("active");
        }

        function closePopup() {
            document.getElementById("popup").classList.remove("active");
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>