<?php
header('Content-Type: application/json');

$filename = '../data.json';

// Mendapatkan data pengguna
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        echo $data;
    } else {
        echo json_encode([]);
    }
}

// Memperbarui data pengguna
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = file_get_contents('php://input');
    file_put_contents($filename, $input);
    echo json_encode(['message' => 'Data updated successfully']);
}

// Menambahkan pengguna baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUser  = json_decode(file_get_contents('php://input'), true);
    
    if (file_exists($filename)) {
        $data = json_decode(file_get_contents($filename), true);
    } else {
        $data = [];
    }

    $data[] = $newUser ; // Tambahkan pengguna baru ke array
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(['message' => 'User  added successfully']);
}
?>