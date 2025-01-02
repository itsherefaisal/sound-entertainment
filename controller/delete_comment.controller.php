<?php
require '../config.php';
session_start();

$comment_id = $_POST['comment_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if (!isset($_POST['comment_id']) || !isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Invalid request.']);
    exit;
}

$query = "SELECT user_id FROM comments WHERE comment_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Comment not found.']);
    exit;
}

$comment = $result->fetch_assoc();
if ($comment['user_id'] !== $user_id) {
    echo json_encode(['error' => 'You can only delete your own comments.']);
    exit;
}

$delete_query = "DELETE FROM comments WHERE comment_id = ?";
$delete_stmt = $conn->prepare($delete_query);
$delete_stmt->bind_param("i", $comment_id);

if ($delete_stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to delete comment.']);
}
?>
