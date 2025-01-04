<?php
header("Content-Type: application/json");

// Lokasi file JSON
$file = '../course.json';

// Mendapatkan metode HTTP
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Membaca input dari body request
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['action']) && $data['action'] === 'add') {
        // Operasi add
        if (!isset($data['courseId']) || !isset($data['courseData'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid request. Missing courseId or courseData"]);
            exit;
        }

        $courseId = $data['courseId'];
        $newCourse = $data['courseData'];

        // Membaca isi file JSON
        if (!file_exists($file)) {
            http_response_code(404);
            echo json_encode(["message" => "File not found"]);
            exit;
        }

        $jsonData = json_decode(file_get_contents($file), true);

        // Periksa apakah ID course sudah ada
        if (isset($jsonData[$courseId])) {
            http_response_code(409); // Konflik, ID sudah ada
            echo json_encode(["message" => "Course ID already exists"]);
            exit;
        }

        // Tambahkan data baru
        $jsonData[$courseId] = $newCourse;

        // Tulis kembali ke file JSON
        if (file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT))) {
            http_response_code(200);
            echo json_encode(["message" => "Course added successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to save new course"]);
        }
        exit;
    }
    
    else if (!isset($data['courseId']) || !isset($data['updatedCourse'])) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid request. Missing courseId or updatedCourse"]);
        exit;
    }

    $courseId = $data['courseId'];
    $updatedCourse = $data['updatedCourse'];

    // Membaca isi file JSON
    if (!file_exists($file)) {
        http_response_code(404);
        echo json_encode(["message" => "File not found"]);
        exit;
    }

    $jsonData = json_decode(file_get_contents($file), true);

    // Periksa apakah courseId ada
    if (!isset($jsonData[$courseId])) {
        http_response_code(404);
        echo json_encode(["message" => "Course ID not found"]);
        exit;
    }

    // Update data
    $jsonData[$courseId] = $updatedCourse;

    // Tulis kembali ke file JSON
    if (file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT))) {
        http_response_code(200);
        echo json_encode(["message" => "Course updated successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to save updated course"]);
    }
} elseif ($method === 'DELETE') {
    // Membaca input dari body request
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!isset($data['courseId'])) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid request. Missing courseId"]);
        exit;
    }

    $courseId = $data['courseId'];

    // Membaca isi file JSON
    if (!file_exists($file)) {
        http_response_code(404);
        echo json_encode(["message" => "File not found"]);
        exit;
    }

    $jsonData = json_decode(file_get_contents($file), true);

    // Periksa apakah courseId ada
    if (!isset($jsonData[$courseId])) {
        http_response_code(404);
        echo json_encode(["message" => "Course ID not found"]);
        exit;
    }

    // Hapus kursus
    unset($jsonData[$courseId]);

    // Tulis kembali ke file JSON
    if (file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT))) {
        http_response_code(200);
        echo json_encode(["message" => "Course deleted successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to delete course"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
}
?>
