<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Draco Code</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="image-section"></div>
        <div class="form-section">
            <img src="assets/images/logo.png" alt="Draco Code">
            <h1>Selamat Datang, Silahkan Login Saudara</h1>
            <form onsubmit="submitLogin(event)">
                <label for="email">Email Atau Phone Number</label>
                <input type="text" name="email" id="email" placeholder="Email atau Phone Number" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukan Password" required>

                <div class="remember">
                    <input type="checkbox" id="remember"> 
                    <label for="remember">Ingat Pengguna</label>
                </div>

                <button type="submit">Masuk</button>
            </form>

            <div class="register">
                Tidak Memiliki Akun? <a href="menu-register.php">Daftar Sekarang</a>
            </div>
        </div>
    </div>
    <script>
    async function submitLogin(event) {
        event.preventDefault(); // Mencegah refresh halaman

        const formData = new FormData(event.target);
        const response = await fetch("login.class.php", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message);

            // Periksa apakah pengguna adalah admin
            if (result.isAdmin) {
                window.location.href = "./admin/dashboard-admin.php"; // Arahkan ke dashboard admin
            } else {
                window.location.href = "index.php"; // Arahkan ke halaman default
            }
        } else {
            alert(result.message);
        }
    }
</script>

</body>
</html>
