function login(event) {
    event.preventDefault(); // Mencegah halaman refresh saat submit

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    // Simulasi login sederhana (gantilah dengan validasi backend)
    if (username.trim() !== "" && password.trim() !== "") {
        let userProfileImage = "images/user-profile.jpg"; // Ambil gambar default

        // Simpan ke Local Storage
        localStorage.setItem("loggedInUser", username);
        localStorage.setItem("profilePic", userProfileImage);

        console.log("Login berhasil! Redirect ke home.html");

        // Redirect ke home & pastikan UI berubah
        window.location.href = "home.html";
    } else {
        alert("Username atau password tidak boleh kosong!");
    }
}
