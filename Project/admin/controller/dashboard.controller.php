<?php
header('Content-Type: application/json');

include_once("../../config.php");

$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

$totalVideos = $conn->query("SELECT COUNT(*) AS total FROM videos")->fetch_assoc()['total'];

$totalSongs = $conn->query("SELECT COUNT(*) AS total FROM music")->fetch_assoc()['total'];

$latestVideos = $conn->query("
    SELECT title, language, created_at 
    FROM videos 
    ORDER BY created_at DESC 
    LIMIT 3
");

$latestSongs = $conn->query("
    SELECT music.title, artists.name AS artist, music.created_at 
    FROM music 
    INNER JOIN artists ON music.artist_id = artists.artist_id 
    ORDER BY music.created_at DESC 
    LIMIT 3
");

$latestVideosArray = [];
while ($row = $latestVideos->fetch_assoc()) {
    $latestVideosArray[] = $row;
}

$latestSongsArray = [];
while ($row = $latestSongs->fetch_assoc()) {
    $latestSongsArray[] = $row;
}

$response = [
    "totalUsers" => $totalUsers,
    "totalVideos" => $totalVideos,
    "totalSongs" => $totalSongs,
    "latestVideos" => $latestVideosArray,
    "latestSongs" => $latestSongsArray,
];

echo json_encode($response);

$conn->close();
?>
