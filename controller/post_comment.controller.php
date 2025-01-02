<?php
session_start();
require '../config.php';

$music_id = $_POST['music_id'];
$user_id = $_SESSION['user_id'];
$content = $_POST['content'];

$query = "INSERT INTO comments (user_id, content, parent_comment_id, commentable_type, commentable_id) 
          VALUES (?, ?, NULL, 'MUSIC', ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isi", $user_id, $content, $music_id);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}
?>
