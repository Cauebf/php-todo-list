<?php
include_once '../config/conn.php';

$description = filter_input(INPUT_POST, 'description'); // Get the description from the form, filtered to prevent SQL injection (equivalent to $_POST['description'])

// if description is empty, redirect to index
if (!$description) {
    header("Location: ../index.php"); // Redirect to index page
    exit; // Exit the script to prevent further execution of the code
}

try {
    $stmt = $conn->prepare("INSERT INTO tasks (description) VALUES (:description)"); // Prepare the SQL statement with a placeholder to prevent SQL injection
    $stmt->bindParam(':description', $description); // Bind the $description to the placeholder
    $stmt->execute(); // Execute the statement

    header("Location: ../index.php"); // Redirect to index page
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
