<?php
include '../config.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8; 
$offset = ($page - 1) * $limit;

$total_query = "SELECT COUNT(*) as total FROM videos";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];

$query = "
    SELECT 
        v.video_id, 
        v.title, 
        v.year, 
        v.language, 
        v.cover_image, 
        v.description, 
        g.name AS genre_name
    FROM videos v
    JOIN genres g ON v.genre_id = g.genre_id
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($conn, $query);

$videos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $videos[] = $row;
}

// Determine if there are previous/next pages
$hasPrev = $page > 1;
$hasNext = $page * $limit < $total;

header('Content-Type: application/json');
echo json_encode([
    'videos' => $videos,
    'hasNext' => $hasNext,
    'hasPrev' => $hasPrev
]);
?>
