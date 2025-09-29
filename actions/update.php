<?php
include_once '../config/conn.php';

$id = filter_input(INPUT_POST, 'id'); // Get the id from the form, filtered to prevent SQL injection (equivalent to $_POST['id'])
$description = filter_input(INPUT_POST, 'description'); // Get the description from the form, filtered to prevent SQL injection (equivalent to $_POST['description'])

// if id or description is empty, redirect to index
if (!$id || !$description) {
    header("Location: ../index.php"); // Redirect to index page
    exit; // Exit the script to prevent further execution of the code
}

try {
    $stmt = $conn->prepare("UPDATE tasks SET description = :description WHERE id = :id"); // Prepare the SQL statement with a placeholder to prevent SQL injection
    $stmt->bindParam(':id', $id); // Bind the $id to the placeholder
    $stmt->bindParam(':description', $description); // Bind the $description to the placeholder
    $stmt->execute(); // Execute the statement

    header("Location: ../index.php"); // Redirect to index page
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
