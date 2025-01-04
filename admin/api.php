<?php
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $courseKey = $data['courseKey'];
    $updatedData = $data['updatedData'];

    $filePath = 'course.json';
    $courses = json_decode(file_get_contents($filePath), true);

    if (isset($courses[$courseKey])) {
        $courses[$courseKey] = $updatedData;
        file_put_contents($filePath, json_encode($courses, JSON_PRETTY_PRINT));
        echo json_encode(['message' => 'Data updated successfully']);
    } else {
        echo json_encode(['error' => 'Course not found']);
    }
    exit;
}
?>
