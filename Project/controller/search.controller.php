<?php
include '../config.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

if ($query === '') {
    echo json_encode(['music' => [], 'videos' => []]);
    exit;
}

$sql_music = "
    SELECT m.music_id AS id, m.title, m.cover_image, 
           a.name AS artist_name, al.name AS album_name, 'music' AS type
    FROM music m
    JOIN artists a ON m.artist_id = a.artist_id
    JOIN albums al ON m.album_id = al.album_id
    WHERE m.title LIKE '%$query%' 
       OR a.name LIKE '%$query%' 
       OR al.name LIKE '%$query%'
    LIMIT 10
";

$sql_videos = "
    SELECT v.video_id AS id, v.title, v.cover_image, 
           g.name AS genre_name, v.language, 'video' AS type
    FROM videos v
    JOIN genres g ON v.genre_id = g.genre_id
    WHERE v.title LIKE '%$query%' 
       OR g.name LIKE '%$query%' 
       OR v.language LIKE '%$query%'
    LIMIT 10
";

$result_music = mysqli_query($conn, $sql_music);
$result_videos = mysqli_query($conn, $sql_videos);

$music = [];
$videos = [];

while ($row = mysqli_fetch_assoc($result_music)) {
    $music[] = $row;
}

while ($row = mysqli_fetch_assoc($result_videos)) {
    $videos[] = $row;
}

header('Content-Type: application/json');
echo json_encode(['music' => $music, 'videos' => $videos]);
?>