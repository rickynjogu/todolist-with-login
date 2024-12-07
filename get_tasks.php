<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db.php';

// Check if the database connection is successful
if (!$pdo) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

try {
    // Prepare the SQL query
    $sql = 'SELECT * FROM tasks';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all tasks as an associative array
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the tasks in JSON format
    if ($tasks) {
        echo json_encode($tasks);
    } else {
        echo json_encode(['message' => 'No tasks found']);
    }
} catch (PDOException $e) {
    // Return error in case of query failure
    echo json_encode(['error' => 'Error executing query: ' . $e->getMessage()]);
}
?>

