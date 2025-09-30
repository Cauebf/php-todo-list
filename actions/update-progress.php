<?php
include_once '../config/conn.php';

$id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT); // Get the task ID and validate it as an integer
$completed = isset($_POST['completed']) ? ($_POST['completed'] == 1 ? 1 : 0) : null; // check if the checkbox is checked and set completed to 1, otherwise set it to 0

// if id or completed is empty, redirect to index
if (!$id || $completed === null) {
    http_response_code(400); // Bad request
    echo "Invalid input.";
    exit; // Exit the script to prevent further execution of the code
}

try {
    $stmt = $conn->prepare("UPDATE tasks SET completed = :completed WHERE id = :id"); 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':completed', $completed); 
    $stmt->execute(); 

    echo "Task progress updated successfully.";
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo "Error: " . $e->getMessage();
}
