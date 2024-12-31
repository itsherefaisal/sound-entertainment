<?php
include '../config.php';

$video_id = isset($_GET['video_id']) ? intval($_GET['video_id']) : 0;

$video_query = "
    SELECT 
        v.video_id, 
        v.title, 
        v.year, 
        v.language, 
        v.cover_image, 
        v.description, 
        g.name AS genre_name, 
        v.duration, 
        v.release_date, 
        v.file_path 
    FROM videos v
    JOIN genres g ON v.genre_id = g.genre_id
    WHERE v.video_id = ?
";
$stmt = $conn->prepare($video_query);
$stmt->bind_param('i', $video_id);
$stmt->execute();
$video_result = $stmt->get_result();
$video = $video_result->fetch_assoc();

$related_query = "
    SELECT 
        v.video_id, 
        v.title, 
        v.cover_image, 
        g.name AS genre_name, 
        v.duration 
    FROM videos v
    JOIN genres g ON v.genre_id = g.genre_id
    WHERE v.genre_id = ? AND v.video_id != ?
    LIMIT 4
";
$related_stmt = $conn->prepare($related_query);
$related_stmt->bind_param('ii', $video['genre_id'], $video_id);
$related_stmt->execute();
$related_result = $related_stmt->get_result();

$related_videos = [];
while ($row = $related_result->fetch_assoc()) {
    $related_videos[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'video' => $video,
    'relatedVideos' => $related_videos
]);
?>
