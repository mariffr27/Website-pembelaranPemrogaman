<?php
class RegisterUser  {
    private $email;
    private $name;
    private $password;
    private $error;
    private $success;
    private $storage = "data.json";
    private $stored_users;

    public function __construct($email, $name, $password) {
        // Pastikan nama input form sesuai dengan nama yang diterima
        $this->email = filter_var(trim($email), FILTER_SANITIZE_STRING);
        $this->name = filter_var(trim($name), FILTER_SANITIZE_STRING);
        $this->password = trim($password); // Menghapus hashing password

        // Cek apakah file data.json ada dan sudah memiliki data
        if (file_exists($this->storage)) {
            $this->stored_users = json_decode(file_get_contents($this->storage), true);
        } else {
            $this->stored_users = [];
        }
    }

    private function checkFieldValues() {
        if (empty($this->email) || empty($this->name) || empty($this->password)) {
            $this->error = "Both fields are required.";
            return false;
        }
        return true;
    }

    private function usernameExists() {
        foreach ($this->stored_users as $user) {
            if ($this->email == $user['email']) {
                $this->error = "Email already exists.";
                return true;
            }
        }
        return false; // Jika email tidak ditemukan
    }

    private function insertUser () {
        if ($this->usernameExists() == false) {
            // Menambahkan user baru ke array
            $new_user = [
                "email" => $this->email,
                "name" => $this->name,
                "password" => $this->password, // Menyimpan password dalam bentuk plaintext
                "role" => "user" // Menambahkan role sebagai 'user'
            ];
            array_push($this->stored_users, $new_user);
    
            // Menyimpan data ke file data.json
            if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
                $this->success = "Registration successful!";
                return true;
            } else {
                $this->error = "Error saving data.";
                return false;
            }
        }
        return false;
    }
    

    public function register() {
        if ($this->checkFieldValues()) {
            if ($this->insertUser ()) {
                return ["success" => true, "message" => $this->success];
            } else {
                return ["success" => false, "message" => $this->error];
            }
        } else {
            return ["success" => false, "message" => $this->error];
        }
    }
}

// Menangani submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Membuat objek RegisterUser  dan memproses pendaftaran
    $user = new RegisterUser ($email, $name, $password);
    $response = $user->register();

    // Cek status pendaftaran dan tampilkan pesan dalam format JSON
    echo json_encode($response);
    exit;
}
?>