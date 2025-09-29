<?php
include_once 'config/conn.php';

$tasks = [];

$sql = "SELECT * FROM tasks ORDER BY id ASC"; // Select all tasks in ascending order
$stmt = $conn->query($sql); // Execute the query

// Check if there are any tasks
if ($stmt->rowCount() > 0) {
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all tasks as an associative array (key->value pairs)
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/styles/style.css" />
    <title>To-do list</title>
</head>

<body>
    <div id="to_do">
        <h1>Things to do</h1>

        <form action="actions/create.php" method="POST" class="to-do-form">
            <input type="text" name="description" placeholder="Write your task here" required />
            <button type="submit" class="form-button">
                <i class="fa-solid fa-plus"></i>
            </button>
        </form>

        <div id="tasks">
            <?php foreach ($tasks as $task): ?>
                <div class="task">
                    <input
                        type="checkbox"
                        name="progress"
                        class="progress <?= $task['completed'] ? 'done' : '' ?>"
                        <?= $task['completed'] ? 'checked' : '' ?> 
                    />

                    <p class="task-description">
                        <?= // equivalent to <?php echo 
                        htmlspecialchars($task['description']) // htmlspecialchars() converts special characters to HTML entities to prevent XSS 
                        ?>
                    </p>

                    <div class="task-actions">
                        <a class="action-button edit-button">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="actions/delete.php?id=<?= $task['id'] ?>" class="action-button delete-button">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </div>

                    <form action="actions/update.php" method="POST" class="to-do-form edit-task hidden">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <input type="text" name="description" value="<?= htmlspecialchars($task['description']) ?>" />
                        <button type="submit" class="form-button confirm-button">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="src/javascript/script.js"></script>
</body>

</html>