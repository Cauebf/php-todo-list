<?php
include_once '../config/conn.php';

$id = filter_input(INPUT_GET, 'id'); // Get the id from the URL, filtered to prevent SQL injection (equivalent to $_GET['id'])

// if id is empty, redirect to index
if (!$id) {
    header("Location: ../index.php"); // Redirect to index page
    exit; // Exit the script to prevent further execution of the code
}

try {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id"); // Prepare the SQL statement with a placeholder to prevent SQL injection
    $stmt->bindParam(':id', $id); // Bind the $id to the placeholder
    $stmt->execute(); // Execute the statement

    header("Location: ../index.php"); // Redirect to index page
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
