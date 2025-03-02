window.onload = function () {
    let username = localStorage.getItem("loggedInUser");
    let signIn = document.querySelector(".sign-in");
    let signUp = document.querySelector(".sign-up");
    let profilePic = document.querySelector(".profile-pic");

    console.log("Status login:", username); // Debugging

    if (username && username !== "null") {
        console.log("User logged in, updating UI...");

        // Sembunyikan tombol Sign In & Sign Up
        if (signIn) signIn.style.display = "none";
        if (signUp) signUp.style.display = "none";

        // Tampilkan gambar profil
        if (profilePic) {
            profilePic.style.display = "block";
            profilePic.src = localStorage.getItem("profilePic") || "images/default-profile.png";

            // Tambahkan event click untuk logout
            profilePic.addEventListener("click", function () {
                if (confirm("Logout dari akun ini?")) {
                    logout();
                }
            });
        }
    } else {
        console.log("User not logged in, showing Sign In & Sign Up");

        if (signIn) signIn.style.display = "inline-block";
        if (signUp) signUp.style.display = "inline-block";
        if (profilePic) profilePic.style.display = "none";
    }
};

// Fungsi Logout
function logout() {
    localStorage.removeItem("loggedInUser");
    localStorage.removeItem("profilePic");
    window.location.href = "home.html"; // Kembali ke home
}
