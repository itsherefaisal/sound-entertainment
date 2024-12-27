<?php
include '../config.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

if ($query === '') {
    echo json_encode(['results' => []]);
    exit;
}

// Search query
$sql = "
    SELECT m.music_id, m.title, m.cover_image, 
           a.name AS artist_name, al.name AS album_name
    FROM music m
    JOIN artists a ON m.artist_id = a.artist_id
    JOIN albums al ON m.album_id = al.album_id
    WHERE m.title LIKE '%$query%' 
       OR a.name LIKE '%$query%' 
       OR al.name LIKE '%$query%'
    LIMIT 10
";

$result = mysqli_query($conn, $sql);

$results = [];
while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

header('Content-Type: application/json');
echo json_encode(['results' => $results]);
?>
