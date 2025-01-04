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
    <title>DragoCode</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    <section class="hero">
        <div class="hero-content">
            <h1>Tingkatkan kemampuan belajar hari ini!</h1>
            <p>Mulai dengan materi dasar yang mudah dipahami untuk pemula. Kuasai berbagai Bahasa Pemrograman, diskusi, kolaborasi, dan belajar bersama coder lainnya.</p>
            <button class="btn-primary">Mulai Belajar Sekarang</button>
        </div>
        <div class="hero-image">
            <img src="assets/images/hero-img.png" alt="Belajar dengan Laptop">
        </div>
    </section>

    <section class="learning-options">
        <div class="judul"><p>Pelajari berbagai Bahasa Pemograman <br> Terpopuler dan Relavan Di Industri</p></div>
            <div class="learning-options-container">
                
                <a href="menu-class.php?course" class="learning-card-link">
                    <div class="learning-option">
                        <img src="assets/images/icon-frontend.png" alt="Gambar 1">
                        <div class="text">
                            <h2>Front End</h2>
                            <p>HTML, CSS, JavaScript, React.Js</p>
                        </div>
                    </div>
                </a>

                <a href="menu-class.php?course" class="learning-card-link">
                    <div class="learning-option">
                        <img src="assets/images/icon-backend.png" alt="Gambar 2">
                        <div class="text">
                            <h2>Back End</h2>
                            <p>Node.Js, Python, PHP, Java</p>
                        </div>
                    </div>
                </a>

                <a href="menu-class.php?course" class="learning-card-link">
                    <div class="learning-option">
                        <img src="assets/images/icon-mobile.png" alt="Gambar 3">
                        <div class="text">
                            <h2>Mobile</h2>
                            <p>Flutter, Kotlin, Swift, React Native</p>
                        </div>
                    </div>
                </a>

                <a href="menu-class.php?course" class="learning-card-link">
                    <div class="learning-option">
                        <img src="assets/images/icon-DataScience.jpg" alt="Gambar 4">
                        <div class="text">
                            <h2>Data Science</h2>
                            <p>Python (Pandas, NumPy), R</p>
                        </div>
                    </div>
                </a>
                <div id="courseOptionsContainer"></div>
        </div>
    </section>

    <section class="programs">
        <h1>Program Kami</h1>
        <div class="program-cards-container">
            <div class="program-card">
                <img src="assets/images/program-img1.jpg" alt="Program 1">
                <div class="program-info">
                    <h3>Untuk Pemula</h3>
                    <p>Program ini dirancang khusus untuk pemula yang ingin membangun dasar pengetahuan yang kuat.</p>
                </div>
                <button class="view-program-button">View Program →</button>
            </div>
            <div class="program-card">
                <img src="https://www.educenter.id/wp-content/uploads/2018/10/Maksimalkan-Penggunaan-Laptop.jpg" alt="Program 2">
                <div class="program-info">
                    <h3>Untuk Senior</h3>
                    <p>Dirancang untuk meningkatkan keterampilan atau mempelajari bidang tertentu atau baru untuk menunjang karrier.</p>
                </div>
                <button class="view-program-button">View Program →</button>
            </div>
        </div>
    </section>
    
    <section class="reviews">
        <h1>Ulasan</h1>
        <div class="review-cards-container">
            <button class="scroll-btn left">←</button>
            <div class="review-cards">
                <div class="review-card">
                    <div class="review-content">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/022/205/829/small_2x/face-profile-images-illustration-in-flat-style-free-vector.jpg" alt="Pengguna 1" class="review-image">
                        <h4 class="review-title">M.Arif</h4>
                    </div>
                    <p class="review-description">“Platform ini membantu saya meningkatkan keterampilan coding saya dengan pesat!”</p>
                </div>
                <div class="review-card">
                    <div class="review-content">
                        <img src="assets/images/userMan-img.png" alt="Pengguna 2" class="review-image">
                        <h4 class="review-title">Aditya D</h4>
                    </div>
                    <p class="review-description">“Saya suka pelajaran interaktif dan bagaimana komunitasnya sangat menyenangkan!”</p>
                </div>
                <div class="review-card">
                    <div class="review-content">
                        <img src="https://png.pngtree.com/png-clipart/20230524/original/pngtree-girl-cartoon-face-png-image_9169195.png" alt="Pengguna 3" class="review-image">
                        <h4 class="review-title">Dhika S</h4>
                    </div>
                    <p class="review-description">“Sumber daya yang luar biasa untuk pemula dan pengembang berpengalaman.”</p>
                </div>
                <div class="review-card">
                    <div class="review-content">
                        <img src="https://th.bing.com/th/id/OIP.9x9hajzdYXUB9-e0Z3xh0wHaHa?w=1200&h=1200&rs=1&pid=ImgDetMain" alt="Pengguna 4" class="review-image">
                        <h4 class="review-title">Anggit T</h4>
                    </div>
                    <p class="review-description">“Bergabung dengan platform ini mengubah karir saya ke arah yang lebih baik!”</p>
                </div>
            </div>
            <button class="scroll-btn right">→</button>
        </div>
        <div class="pagination">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        <button class="more-reviews">Read More Reviews</button>
    </section>

    <section class="features">
        <h2>DragoCode Presents A Wide Range Of Solutions</h2>
        <ul>
            <li>Diskusi dan kolaborasi dengan para ahli industri</li>
            <li>Belajar dari kurikulum berbasis industri</li>
            <li>Materi up-to-date untuk web, mobile, dan data science</li>
        </ul>
        <div class="feature-image">
            <img src="assets/images/features-img.jpeg" alt="DragoCode Logo">
        </div>
    </section>

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
    <script src="assets/js/index.js"></script>
</body>
</html>
