<?php

// Memeriksa apakah parameter 'course' ada dalam URL
session_start();
    $is_logged_in = isset($_SESSION['user']); // Cek apakah user login
    echo "<script>var isLoggedIn = " . json_encode($is_logged_in) . ";</script>";

$course = isset($_GET['course']) ? $_GET['course'] : 'default';

// Memuat file JSON
$jsonData = file_get_contents('course.json');
$courses = json_decode($jsonData, true); // Mengonversi JSON menjadi array PHP

// Memeriksa apakah course yang diminta ada dalam array courses
$courseData = isset($courses[$course]) ? $courses[$course] : $courses['frontend']; // Default jika course tidak ditemukan
$courseTitle = isset($courseData['title']) ? $courseData['title'] : 'Kursus Tidak Ditemukan'; 

// Memasukkan autoloader Composer
require 'vendor/autoload.php';

// Menggunakan PHPMailer dan FPDI
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use setasign\Fpdi\Fpdi;

// Fungsi untuk menghasilkan sertifikat PDF
function generateCertificate($recipientName, $courseTitle) {
    // Membuat objek FPDI (FPDI adalah ekstensi dari FPDF)

    $directory = 'certificates/';

    // Periksa apakah folder 'certificates' ada, jika tidak, buat folder
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);  // Membuat folder jika belum ada
    }
    $pdf = new Fpdi();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $logoPath = '.\assets\images\logo.png'; // Ganti dengan path logo Anda
    $pdf->Image($logoPath, 50, 50, 50);

    // Menambahkan teks
    $pdf->Cell(40, 10, 'Sertifikat Penghargaan');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Diberikan kepada: ' . $recipientName, 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(0, 10, 'Atas keberhasilan menyelesaikan kursus:', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, $courseTitle, 0, 1, 'C');  // Nama kursus
    $pdf->Cell(0, 10, 'Atas keberhasilan menyelesaikan kursus.', 0, 1, 'C');

    // Simpan sertifikat sebagai file PDF
    $certificatePath = $directory. 'sertifikat_' . strtolower(str_replace(' ', '_', $recipientName)) . '.pdf';
    $pdf->Output('F', $certificatePath);  // Simpan file PDF ke disk

    return $certificatePath;
}

// Fungsi untuk mengirim email dengan sertifikat sebagai lampiran
function sendEmailWithCertificate($recipientEmail, $recipientName, $certificatePath, $courseTitle) {
    // Membuat objek PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Pengaturan SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'psylonds@gmail.com';  // Username Mailtrap
        $mail->Password = 'jsgs pklv pfna yuvi';  // Password Mailtrap
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan pengirim dan penerima
        $mail->setFrom('psylonds@gmail.com', 'Enancys');
        $mail->addAddress($recipientEmail);  // Ganti dengan email penerima Gmail

        // Menambahkan subjek dan isi email
        $mail->isHTML(true);
        $mail->Subject = 'Sertifikat Kursus Anda';
        $mail->Body    = 'Selamat! Anda telah menyelesaikan kursus kami. Lampirkan sertifikat Anda di bawah.';

        // Menambahkan PDF sebagai lampiran
        $mail->addAttachment($certificatePath);  // Menambahkan file sertifikat

        // Mengirim email
        $mail->send();
        echo '<script type="text/javascript">
            alert("Sertifikat berhasil dikirim!");
        </script>';

    } catch (Exception $e) {
        echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
    }
}

// Memulai sesi dan memeriksa apakah pengguna sudah login
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Mulai sesi hanya jika belum ada sesi yang aktif
}

// Asumsikan data pengguna yang login disimpan dalam variabel $_SESSION['user']
if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user'];  // Ambil data pengguna yang sedang login
    $is_logged_in = true;  // Menandakan bahwa pengguna sudah login
} else {
    $is_logged_in = false;  // Jika tidak ada pengguna yang login
}

// Menangani permintaan dari tombol 'Gabung Kelas'
if ($is_logged_in) { // Pastikan pengguna sudah login
    if (isset($_POST['enroll'])) {
        // Mengambil informasi pengguna yang sedang login
        $recipientName = $currentUser['name'];  // Nama pengguna yang sedang login
        $recipientEmail = $currentUser['email'];  // Email pengguna yang sedang login
        $courseTitle = isset($courseData['title']) ? $courseData['title'] : 'Kursus Tidak Ditemukan';

        // Menghasilkan sertifikat PDF
        $certificatePath = generateCertificate($recipientName, $courseTitle);

        // Mengirim email dengan sertifikat sebagai lampiran
        sendEmailWithCertificate($recipientEmail, $recipientName, $certificatePath, $courseTitle);
    }
} else {
    // Jika pengguna tidak login, berikan respon atau arahkan ke halaman login
    echo "<script>alert('Anda harus login untuk mengakses fitur ini.');</script>";
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DracoCode - Class enroll</title>
    <link rel="stylesheet" href="assets/css/class-enroll.css">
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
        </section>  
        <div class="details-section">
            <div class="details-card">
                <img class="img-header" src="<?= htmlspecialchars($courseData['image']); ?>" alt="<?= htmlspecialchars($courseData['title']); ?>">
                <div class="text-content">
                    <h3><?= htmlspecialchars($courseData['title']); ?></h3>
                    <p><?= htmlspecialchars($courseData['description']); ?></p>
                    <div class="content-img">
                        <div class="detail-content">
                            <img src="assets/images/detail-course-img.png" alt="Materi Pembelajaran">
                            <p><?= htmlspecialchars($courseData['materi']); ?></p>
                        </div>
                        <div class="detail-content">
                        <img src="assets/images/detail-course-img2.png" alt="Vidio Pembelajaran">
                            <p><?= htmlspecialchars($courseData['materiVideo']); ?></p>
                        </div>
                        <p>Dibuat oleh <span id="course-creator">Muhamad Arif, Rozak arts</span></p>
                    </div>
                    <div class="btn-detail">
                        <form method="POST" action="">
                            <!-- Tombol Gabung Kelas -->
                            <button  type="submit" name="enroll" class="btn-enroll-class"  data-id="<?php echo htmlspecialchars($course); ?>" formaction="<?php echo htmlspecialchars($courseData['link']); ?>">
                                Cetak sertifikat <?php echo htmlspecialchars($courseData['title']); ?>
                            </button>
                        </form>
                        
                        <button  type="submit" name="enroll" class="btn-enroll-class"  data-id="<?php echo htmlspecialchars($course); ?>" formaction="<?php echo htmlspecialchars($courseData['link']); ?>">
                            Gabung Kelas <?php echo htmlspecialchars($courseData['title']); ?>
                        </button>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <p>Mentor Terbaik Untuk Membantu Anda Menguasai Pemrograman dan Beragam Teknologi</p>
            <div class="footer-links">
                <a href="menu-aboutUs.php">About Us</a>
                <a href="menu-aboutUs.php">Contact Us</a>
                <a href="menu-aboutUs.php">Terms of Use</a>
                <a href="menu-aboutUs.php">Privacy Policy</a>
            </div>
        </div>
    </footer>
    <script src="assets/js/class-enroll.js"></script>
</body>
</html>
