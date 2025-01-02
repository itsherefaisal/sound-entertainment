<?php
require '../config.php';
session_start();

$music_id = $_GET['music_id'] ?? null;
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$current_user_id = $_SESSION['user_id'] ?? null;

if (!$music_id) {
    echo json_encode(['error' => 'Music ID is required.']);
    exit;
}

$query = "SELECT c.comment_id, c.content, c.created_at, u.username, c.user_id
          FROM comments c
          JOIN users u ON c.user_id = u.user_id
          WHERE c.commentable_type = 'MUSIC' AND c.commentable_id = ?
          ORDER BY c.created_at DESC
          LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $music_id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo json_encode(['error' => 'Failed to fetch comments.']);
    exit;
}

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comment_id = $row['comment_id'];
    $user_id = $row['user_id'];

    $is_owner = ($user_id == $current_user_id) ? true : false;

    $replies_query = "SELECT r.comment_id, r.content, r.created_at, u.username, r.user_id
                      FROM comments r
                      JOIN users u ON r.user_id = u.user_id
                      WHERE r.parent_comment_id = ?
                      ORDER BY r.created_at ASC";
    $replies_stmt = $conn->prepare($replies_query);
    $replies_stmt->bind_param("i", $comment_id);
    $replies_stmt->execute();
    $replies_result = $replies_stmt->get_result();

    $replies = [];
    while ($reply = $replies_result->fetch_assoc()) {
        $replies[] = [
            'comment_id' => $reply['comment_id'],
            'content' => $reply['content'],
            'created_at' => $reply['created_at'],
            'username' => $reply['username'],
            'is_owner' => ($reply['user_id'] == $current_user_id) ? true : false
        ];
    }

    $row['replies'] = $replies;
    $row['is_owner'] = $is_owner;

    $comments[] = $row;
}

if (empty($comments)) {
    echo json_encode(['comments' => [], 'message' => 'No comments found.']);
} else {
    echo json_encode(['comments' => $comments]);
}
?>
