# Website-pembelaranPemrogaman
Projek UAS Website-pembelaranPemrogaman

## Deskripsi proyek
Web Pembelajaran Koding adalah platform edukasi online yang bertujuan untuk memfasilitasi pembelajaran bahasa pemrograman dan konsep-konsep pengembangan perangkat lunak. Proyek ini menyediakan materi pembelajaran yang terstruktur, mulai dari pemrograman dasar hingga teknik-teknik pengembangan aplikasi yang lebih lanjut. Pengguna dapat mengakses tutorial interaktif, soal latihan, dan forum diskusi untuk meningkatkan keterampilan pemrograman mereka.

Fitur utama dari web ini meliputi:
- **Tutorial Langkah-demi-Langkah:** Materi yang mudah diikuti dengan contoh kode yang jelas.
- **Soal Latihan:** Soal interaktif untuk menguji pemahaman setelah setiap sesi pembelajaran.
- **Forum Diskusi:** Tempat untuk berdiskusi dan berbagi pengetahuan dengan komunitas pemrograman.
- **Berbagai Bahasa Pemrograman:** Mulai dari HTML, CSS, JavaScript, hingga bahasa pemrograman tingkat lanjut seperti Python, Java, dan C++.

Web Pembelajaran Koding ini cocok untuk siapa saja yang ingin memulai perjalanan mereka dalam dunia pengembangan perangkat lunak atau bagi mereka yang ingin memperdalam keterampilan pemrograman yang sudah ada.

## Cara Instalasi dan Penggunaan

### 1. Download Proyek
Unduh file proyek web pembelajaran koding dari repository GitHub atau sumber lainnya.

### 2. Pindahkan File ke Folder `htdocs` XAMPP
Setelah Anda mendownload file proyek, salin atau pindahkan seluruh folder proyek ke direktori `htdocs` pada instalasi XAMPP. Biasanya, direktori `htdocs` terletak di:
- **Windows**: `C:\xampp\htdocs\`
- **Mac**: `/Applications/XAMPP/htdocs/`

### 3. Install Dependencies
Sebelum menjalankan proyek, Anda perlu menginstal beberapa dependencies seperti PHPMailer, FPDF, dan Composer.

### 4. Akses Web Pembelajaran Koding
Buka browser Anda dan ketikkan alamat berikut: http://localhost/nama-folder-proyek/
Gantilah `nama-folder-proyek` dengan nama folder tempat Anda menaruh file proyek di dalam folder `htdocs`. Misalnya, jika folder proyek Anda bernama `web-pembelajaran-koding`, maka URL yang diakses akan menjadi:

## Penjelasan Struktur Folder

- **`root/`**: Menyimpan semua file json dan php pada user login.
- **`admin/`**: Menyimpan file untuk bagian admin, termasuk halaman admin dan skrip khusus admin.
- **`assets/`**: Menyimpan semua file statis yang digunakan di web, seperti gambar, CSS, dan JavaScript.
- **`certificates/`**: Menyimpan template dan sertifikat yang diterbitkan untuk pengguna.
- **`index.php`**: Halaman utama yang digunakan untuk mengakses fitur pembelajaran koding.
