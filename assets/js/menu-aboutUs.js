
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