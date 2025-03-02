<?php
// Pastikan session hanya dimulai jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mendapatkan nama file saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="website-header">
    <div class="logo-container">
        <img src="images/Logo-image/Logo.png" alt="Logo" class="logo">
    </div>
    <button class="menu-toggle" id="menu-toggle">☰</button>
    <nav class="nav-links">
        <ul>
            <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
            <li><a href="pokedex.php" class="<?= ($current_page == 'pokedex.php') ? 'active' : ''; ?>">Pokedex</a></li>
            <li><a href="pokeball.php" class="<?= ($current_page == 'pokeball.php') ? 'active' : ''; ?>">Pokeball</a></li>
            <li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="collection.php" class="<?= ($current_page == 'collection.php') ? 'active' : ''; ?>">Collection</a>
                <?php else: ?>
                    <a href="#" onclick="showLoginPopup()">Collection</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <div class="header-buttons">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="#" class="sign-out" onclick="showLogoutPopup()">Logout</a>
        <?php else: ?>
            <a href="login.html" class="sign-in">Sign In</a>
            <a href="signup.html" class="sign-up">Sign Up</a>
        <?php endif; ?>
    </div>
</header>

<!-- Pop Up Konfirmasi Logout -->
<div id="logoutPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeLogoutPopup()">✖</span>
        <p>Apakah Anda yakin ingin logout?</p>
        <button onclick="window.location.href='logout.php'">Ya</button>
        <button onclick="closeLogoutPopup()">Tidak</button>
    </div>
</div>

<!-- Pop-up Login -->
<div id="loginPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeLoginPopup()">✖</span>
        <p>Anda harus login terlebih dahulu untuk mengakses halaman koleksi!</p>
        <button onclick="window.location.href='login.html'">Login Sekarang</button>
    </div>
</div>

<script>
    // Tambahkan class 'active' ke menu yang sesuai
    document.addEventListener('DOMContentLoaded', function() {
        const currentPage = window.location.pathname.split('/').pop();
        const navLinks = document.querySelectorAll('.nav-links a');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });

    // Pop-up Login
    function showLoginPopup() {
        document.getElementById("loginPopup").style.display = "block";
    }
    function closeLoginPopup() {
        document.getElementById("loginPopup").style.display = "none";
    }

    // Pop-up Logout
    function showLogoutPopup() {
        document.getElementById("logoutPopup").style.display = "block";
    }
    function closeLogoutPopup() {
        document.getElementById("logoutPopup").style.display = "none";
    }
</script>

<style>
    .header-buttons .sign-in,
    .header-buttons .sign-up,
    .header-buttons .sign-out {
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .header-buttons .sign-in {
        background: transparent;
        color: white;
        border: 2px solid white;
    }
    
    .header-buttons .sign-in:hover {
        background: linear-gradient(to right, #ff4500, #ff1493);
        color: white;
        border-color: transparent;
    }
    
    .header-buttons .sign-up {
        background: linear-gradient(to right, #ff4500, #ff1493);
        color: white;
        box-shadow: 0px 4px 10px rgba(255, 69, 0, 0.5);
    }
    
    .header-buttons .sign-up:hover {
        box-shadow: 0px 6px 20px rgba(255, 69, 0, 0.8);
        transform: scale(1.05);
    }

    .header-buttons .sign-out {
        background: linear-gradient(to right, #ff4500, #ff1493);
        color: white;
        box-shadow: 0px 4px 10px rgba(255, 69, 0, 0.5);
    }
    
    .header-buttons .sign-out:hover {
        box-shadow: 0px 6px 20px rgba(255, 69, 0, 0.8);
        transform: scale(1.05);
    }
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 20px;
        border-radius: 10px;
        z-index: 1000;
        text-align: center;
    }

    .popup-content {
        padding: 10px;
    }

    .popup .close {
        cursor: pointer;
        color: red;
        float: right;
    }

    .popup button {
        background-color: #ff5a00;
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .popup button:hover {
        background-color: #ff1493;
    }
</style>
