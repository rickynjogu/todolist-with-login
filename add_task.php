<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$text = $data->text;

if ($text) {
    $sql = 'INSERT INTO tasks (text, completed) VALUES (:text, 0)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':text', $text);
    $stmt->execute();

    echo json_encode(['message' => 'Task added successfully']);
} else {
    echo json_encode(['message' => 'Invalid input']);
}
?>

