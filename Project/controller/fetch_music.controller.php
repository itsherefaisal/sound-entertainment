<?php
include '../config.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$total_query = "SELECT COUNT(*) as total FROM music";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];

$query = "
    SELECT m.music_id, m.title, m.year, m.cover_image, 
           a.name AS artist_name
    FROM music m
    JOIN artists a ON m.artist_id = a.artist_id
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($conn, $query);

$musics = [];
while ($row = mysqli_fetch_assoc($result)) {
    $musics[] = $row;
}

$hasPrev = $page > 1;
$hasNext = $page * $limit < $total;

header('Content-Type: application/json');
echo json_encode([
    'musics' => $musics,
    'hasNext' => $hasNext,
    'hasPrev' => $hasPrev
]);
?>
