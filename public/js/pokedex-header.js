const menuToggle = document.getElementById("menu-toggle");
const navLinks = document.querySelector(".nav-links");
const headerButtons = document.querySelector(".header-buttons");

menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("active");
    headerButtons.classList.toggle("active");
});

document.getElementById('menu-toggle').addEventListener('click', function () {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
});
