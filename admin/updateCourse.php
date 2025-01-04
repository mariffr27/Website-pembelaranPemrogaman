<?php
// Read the existing JSON data
$jsonFile = '../course.json';
$jsonData = file_get_contents($jsonFile);
$courses = json_decode($jsonData, true);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated courses data from the request
    $updatedCourses = json_decode(file_get_contents('php://input'), true);

    // Save the updated data back to the JSON file
    file_put_contents($jsonFile, json_encode($updatedCourses, JSON_PRETTY_PRINT));
    echo 'Courses updated successfully';
} else {
    // Return the current courses data
    header('Content-Type: application/json');
    echo json_encode($courses);
}
?>