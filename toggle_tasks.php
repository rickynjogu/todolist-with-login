<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$completed = $data->completed;

if ($id !== null && $completed !== null) {
    $sql = 'UPDATE tasks SET completed = :completed WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo json_encode(['message' => 'Task updated successfully']);
} else {
    echo json_encode(['message' => 'Invalid input']);
}
?>
