<?php
require '../config.php';
session_start();

$comment_id = $_POST['comment_id'] ?? null;
$reply_content = $_POST['reply_content'] ?? null;
$current_user_id = $_SESSION['user_id'] ?? null;
$music_id = $_POST['music_id'] ?? null;

if (!$comment_id || !$reply_content || !$music_id) {
    echo json_encode(['error' => 'Invalid request.']);
    exit;
}

$query = "INSERT INTO comments (content, user_id, commentable_type, commentable_id, parent_comment_id) 
          VALUES (?, ?, 'MUSIC', null, ?)";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['error' => 'Failed to prepare statement.']);
    exit;
}

$stmt->bind_param("sii", $reply_content, $current_user_id, $comment_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to submit reply.']);
}
?>
