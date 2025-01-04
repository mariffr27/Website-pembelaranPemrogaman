<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Draco Code</title>
    <link rel="stylesheet" href="assets/css/register.css">

</head>
<body>
    <div class="container">
        <div class="image-section"></div>
        <div class="form-section">
            <img src="assets/images/logo.png" alt="Draco Code">
            <h1>Selamat Datang, Silahkan Registrasi User</h1>
            <form method="POST" action="register.class.php" onsubmit="submitForm(event)">
                <label for="email">Email Atau Phone Number</label>
                <input type="text" name="email" id="email" placeholder="Email atau Phone Number" required>

                <label for="name">Nama</label>
                <input type="text" name="name" id="name" placeholder="Masukan Nama Anda" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukan Password" required>

                <button type="submit" name="submit">Register</button>
            </form>

            <div class="login">
                Sudah Memiliki Akun? <a href="menu-login.php">Login Sekarang</a>
            </div>
        </div>
    </div>
    <script>
        async function submitForm(event) {
            event.preventDefault(); // Mencegah form refresh

            const formData = new FormData(event.target);
            const response = await fetch(event.target.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            // Tampilkan pop-up berdasarkan hasil
            if (result.success) {
                alert(result.message); // Pesan sukses
                event.target.reset(); // Reset form setelah registrasi berhasil
            } else {
                alert(result.message); // Pesan error
            }
        }
    </script>
</body>
</html>
