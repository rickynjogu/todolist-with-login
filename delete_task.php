<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

if ($id) {
    $sql = 'DELETE FROM tasks WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo json_encode(['message' => 'Task deleted successfully']);
} else {
    echo json_encode(['message' => 'Invalid ID']);
}
?>

