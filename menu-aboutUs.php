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
    <title>dragoCode Learning</title>
    <link rel="stylesheet" href="assets/css/about-us.css">
</head>
<body>
    <!-- header -->
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
            <a href="menu-login.php" class="btn-primary">Mulai Belajar Sekarang</a>


        </div>
        <div class="hero-image">
            <img src="assets/images/hero-img.png" alt="Belajar dengan Laptop">
        </div>
    </section>

    <section>

        <div class="team-section">
            <!-- Anggota 1 -->
            <div class="member">
                <div class="member-photo">
                    <img src="https://png.pngtree.com/png-clipart/20220913/ourlarge/pngtree-pompim-character-cartoon-avatar-png-image_6168949.png" alt="Anggota 1">
                    <div class="member-name">Muhammad Arif</div>
                </div>
                <div class="member-info">
                    <h3>Profil Singkat Anggota</h3>
                    <p>Profil singkat Anggota 1 <br></p>
                    <p>* NIM    : 2205101013 <br></p>
                    <p>* Kelas  : 5B/TIF</p>
                </div>
            </div>
            
            <!-- Anggota 2 -->
            <div class="member">
                <div class="member-photo">
                    <img src="https://png.pngtree.com/png-clipart/20220124/original/pngtree-little-boy-flat-style-sticker-png-image_7176473.png" alt="Anggota 2">
                    <div class="member-name">Aditya Dwi</div>
                </div>
                <div class="member-info">
                    <h3>Profil Singkat Anggota</h3>
                    <p>Profil singkat Anggota 2 <br></p>
                    <p>* NIM    : 2205101021 <br></p>
                    <p>* Kelas  : 5B/TIF</p>
                </div>
            </div>
            
             <!-- Anggota 3 -->
             <div class="member">
        <div class="member-photo">
            <img src="https://png.pngtree.com/png-clipart/20220907/ourlarge/pngtree-kartun-perempuan-menggunakan-kacamata-yang-lucu-png-image_6141122.png" alt="Anggota 3">
            <div class="member-name">Dhika Saputri</div>
        </div>
        <div class="member-info">
            <h3>Profil Singkat Anggota</h3>
            <p>Profil singkat Anggota 3 <br></p>
            <p>* NIM    : 2205101029 <br></p>
            <p>* Kelas  : 5B/TIF</p>
        </div>
    </div>
    
    <!-- Anggota 4 -->
    <div class="member">
        <div class="member-photo">
            <img src="https://png.pngtree.com/png-clipart/20230707/ourlarge/pngtree-hijab-girl-png-image_7505186.png" alt="Anggota 4">
            <div class="member-name">Nama Anggota 4</div>
        </div>
        <div class="member-info">
            <h3>Profil Singkat Anggota</h3>
            <p>Profil singkat Anggota 4 <br></p>
            <p>* NIM    : 2205101030 <br></p>
            <p>* Kelas  : 5B/TIF</p>
        </div>
    </div>
</section>
    
</main>

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
    <script src="assets/js/menu-aboutUs.js"></script>
</body>
</html>