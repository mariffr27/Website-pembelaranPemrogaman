document.addEventListener("DOMContentLoaded", function () {
const buttons = document.querySelectorAll(".btn-enroll-class");

buttons.forEach(button => {
    button.addEventListener("click", () => {
    const courseId = button.getAttribute("data-id");
    // Redirect ke halaman menu-class-course.php dengan parameter courseId
    window.location.href = `menu-class-course.php?course=${courseId}`;
        });
    });
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