document.addEventListener("DOMContentLoaded", function () {
    // Seleksi tombol dengan class 'btn-primary'
    const startLearningButton = document.querySelector(".btn-primary");

    if (startLearningButton) {
        // Tambahkan event listener untuk klik tombol
        startLearningButton.addEventListener("click", function () {
            if (isLoggedIn) {
                // Jika sudah login, arahkan ke halaman kelas
                window.location.href = "menu-class.php";
            } else {
                // Jika belum login, arahkan ke halaman login
                window.location.href = "menu-login.php";
            }
        });
    }
});

const sidebar = document.querySelector('.sidebar');
const toggleButton = document.querySelector('.menu-toggle'); // Tombol untuk membuka sidebar
const closeButton = document.querySelector('.close-btn'); // Tombol untuk menutup sidebar

// Fungsi untuk membuka sidebar
toggleButton.addEventListener('click', () => {
    sidebar.classList.add('active');
    });

// Fungsi untuk menutup sidebar
closeButton.addEventListener('click', () => {
    sidebar.classList.remove('active');
});