
<?php
session_start(); // Mulai sesi pengguna

class LoginUser {
    private $email;
    private $password;
    private $storage = "data.json";
    private $stored_users;

    public function __construct($email, $password) {
        $this->email = filter_var(trim($email), FILTER_SANITIZE_STRING);
        $this->password = trim($password);

        if (file_exists($this->storage)) {
            $this->stored_users = json_decode(file_get_contents($this->storage), true);
        } else {
            $this->stored_users = [];
        }
    }

    private function validateUser() {
        foreach ($this->stored_users as $user) {
            if ($this->email === $user['email'] && $this->password === $user['password']) {
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'] // Simpan role di sesi
                ];
    
                $isAdmin = isset($user['role']) && $user['role'] === "admin";
    
                return [
                    "success" => true,
                    "message" => "Login berhasil! Selamat datang, " . $user['name'],
                    "email" => $user['email'],
                    "isAdmin" => $isAdmin
                ];
            }
        }
        return ["success" => false, "message" => "Email atau password salah."];
    }
    

    public function login() {
        return $this->validateUser();
    }
}

// Menangani permintaan login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new LoginUser($email, $password);
    $response = $user->login();

    // Kembalikan hasil dalam format JSON
    echo json_encode($response);
    exit;
}
?>