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
    <title>Menu Forum</title>
    <link rel="stylesheet" href="assets/css/forum.css">
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

    <!-- Tombol Tambah Diskusi -->
<button class="btn-add-discussion" onclick="openAddDiscussionForm()">Tambah Diskusi</button>

<!-- Form Tambah Diskusi (Awalnya tersembunyi) -->
<div id="add-discussion-form" class="add-discussion-form" style="display: none;">
    <h3>Tambah Diskusi Baru</h3>
    <form id="add-discussion" onsubmit="submitDiscussion(event)">
        <label for="discussion-title">Judul Diskusi:</label>
        <input type="text" id="discussion-title" required>

        <label for="discussion-content">Konten Diskusi:</label>
        <textarea id="discussion-content" required></textarea>

        <label for="discussion-author">Nama Anda:</label>
        <input type="text" id="discussion-author" required>

        <button type="submit">Tambah Diskusi</button>
        <button type="button" class="btn-cancel" onclick="closeAddDiscussionForm()">Batal</button>
    </form>
</div>


    <main>
    <section class="forum-section">
        <h2>📚 Daftar Diskusi</h2>
        <div id="forum-list" class="forum-list">
            <!-- Forum items akan dimuat secara dinamis -->
        </div>
    </section>
</main>


<!-- Popup Detail Forum -->
<div id="forum-popup" class="popup-overlay" style="display: none;">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;</span>
        <div id="popup-details">
            <!-- Detail forum akan dimuat di sini -->
        </div>
        <hr>
        <div id="popup-comments">
            <h4>💬 Komentar</h4>
            <div id="comments-list">
                <!-- Daftar komentar akan dimuat di sini -->
            </div>
            <form id="add-comment-form" onsubmit="addComment(event)">
                <textarea id="comment-input" placeholder="Tulis komentar Anda..." required></textarea>
                <button type="submit" class="btn-submit">Tambahkan Komentar</button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan link Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Your Learning Platform. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="assets/js/forum.js"></script>
</body>
</html>
