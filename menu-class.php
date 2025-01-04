<?php
    session_start();
    $is_logged_in = isset($_SESSION['user']); // Cek apakah user login
    echo "<script>var isLoggedIn = " . json_encode($is_logged_in) . ";</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Draco Code - Kelas</title>
  <link rel="stylesheet" href="assets/css/class.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <nav>
            <div class="main-bar">
                <img src="assets/images/logo.png" alt="logo" class="logo-web" style="max-width: 100px;">
                <button class="menu-toggle">☰</button>
                <ul class="navbar">
                    <li><a href="Index.php">Beranda</a></li>
                    <li><a href="menu-class.php">Kelas</a></li>
                    <li><a href="menu-forum.php">Forum</a></li>
                    <li><a href="menu-aboutUs.php">About Us</a></li>        
                </ul>
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="user-info">
                        <span>Halo, <?= htmlspecialchars($_SESSION['user']['name']); ?></span>
                        <a href="logout.php"><button class="btn-logout">Keluar</button></a>
                    </div>
                <?php else: ?>
                    <a href="menu-login.php"><button class="btn-login">Masuk</button></a>
                <?php endif; ?>
            </div>
        </nav>
    
    <div class="sidebar">
        <span class="close-btn">&times;</span>
        <ul>
            <li><a href="Index.php">Beranda</a></li>
            <li><a href="menu-class.php">Kelas</a></li>
            <li><a href="menu-forum.php">Forum</a></li>
            <li><a href="menu-aboutUs.php">About Us</a></li>
            <li>
            <?php if (isset($_SESSION['user'])): ?>
            <div class="user-info">
                <span>Halo, <?= htmlspecialchars($_SESSION['user']['name']); ?></span>
                <a href="logout.php"><button class="btn-logout">Keluar</button></a>
            </div>
        <?php else: ?>
            <a href="menu-login.php"><button class="btn-login">Masuk</button></a>
        <?php endif; ?>
            </li>
        </ul>
    </div>
        
</header>
  <div class="container">
        <section class="header-section">
            <h1>Pelajari Berbagai Bahasa Pemrograman Terpopuler Dan Relevan Di Industri</h1>

            <div class="search-bar">
    <input id="search-input" type="text" placeholder="Cari Kursus">
    <button id="search-button">Cari</button>
</div>
<div id="search-results"></div>
        </section>

        <section>
  <div class="cards"></div>
</section>

    
  </div>


  <footer>
        <div class="footer-content">
            <p>Mentor Terbaik Untuk Membantu Anda Menguasai Pemrograman dan Beragam Teknologi</p>
            <div class="footer-links">
                <a href="#">About Us</a>
                <a href="#">Contact Us</a>
                <a href="#">Terms of Use</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

  <script>
    // Search bar
    document.getElementById("search-button").addEventListener("click", function () {
        const query = document.getElementById("search-input").value.toLowerCase();
        const cards = document.querySelectorAll(".card");

        fetch("course.json")
            .then(response => response.json())
            .then(courses => {
                // Filter matching courses
                const courseKeys = Object.keys(courses).filter(key =>
                    courses[key].title.toLowerCase().includes(query)
                );

                // Show/hide cards based on search results
                cards.forEach(card => {
                    const cardId = card.getAttribute("data-id");
                    if (courseKeys.includes(cardId)) {
                        card.style.display = "block"; // Show matching card
                    } else {
                        card.style.display = "none"; // Hide non-matching card
                    }
                });
            })
            .catch(error => {
                console.error("Error fetching courses:", error);
            });
    });


  // Card

  // Ambil elemen kontainer
const cardsContainer = document.querySelector('.cards');

// Fungsi untuk membuat kartu
function createCard(course, key) {
  const card = document.createElement('div');
  card.classList.add('card');
  card.dataset.id = key;

  card.innerHTML = `
    <img src="${course.image}" alt="${course.title}">
    <div class="card-content">
      <h3>${course.title}</h3>
      <p>${course.description}</p>
      <a href="${course.link}" target="_blank">Mulai</a>
    </div>
  `;



  return card;

}

// Ambil data dari course.json
fetch('course.json')
  .then(response => {
    if (!response.ok) {
      throw new Error('Gagal mengambil data JSON');
    }
    return response.json(); // Mengubah response menjadi JSON
  })
  .then(courses => {
    // Iterasi melalui kunci objek JSON
    Object.keys(courses).forEach(key => {
      const course = courses[key];
      const card = createCard(course, key);
      cardsContainer.appendChild(card);
    });
  })
  .catch(error => {
    console.error('Terjadi kesalahan:', error);
  });


  cardsContainer.addEventListener('click', (event) => {
  if (event.target.tagName === 'A') {
    const courseId = event.target.closest('.card').dataset.id;
    console.log(`Kursus "${courseId}" dipilih oleh pengguna.`);
    // Lanjutkan ke link
  }
});
  // end

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

  document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
      card.addEventListener("click", () => {
        const courseId = card.getAttribute("data-id");
        // Redirect to the specific course page or dynamically load content
        window.location.href = `menu-class-enroll.php?course=${courseId}`;
      });
    });
  });

  
</script>

</body>
</html>
