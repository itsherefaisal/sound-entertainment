<?php 

define("ROUTE", "view.album");
include_once("../../includes/header.admin.php");

include_once("../../../config.php");

$albums = [];
$sql = "SELECT 
            albums.album_id, 
            albums.name AS album_name, 
            albums.release_year, 
            albums.cover_image, 
            COUNT(music.music_id) AS song_count 
        FROM albums 
        LEFT JOIN music ON albums.album_id = music.album_id 
        GROUP BY albums.album_id";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $albums[] = $row;
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Albums</h1>
    <table class="w-full table-auto border-collapse border border-gray-600">
        <thead>
            <tr class="bg-[#1B1833] text-white text-xs">
                <th class="border border-gray-600 px-4 py-2">Album ID</th>
                <th class="border border-gray-600 px-4 py-2">Album Name</th>
                <th class="border border-gray-600 px-4 py-2">Release Year</th>
                <th class="border border-gray-600 px-4 py-2">Cover Image</th>
                <th class="border border-gray-600 px-4 py-2">Song Count</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($albums)): ?>
            <tr>
                <td colspan="6" class="text-center border border-gray-600 px-4 py-8 text-sm text-gray-300">
                    No albums found.
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($albums as $album): ?>
            <tr class="hover:bg-[#4B4376] text-sm">
                <td class="border border-gray-600 px-4 py-2"><?= $album['album_id']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($album['album_name']); ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= $album['release_year']; ?></td>
                <td class="border border-gray-600 px-4 py-2">
                    <?php if ($album['cover_image']): ?>
                    <img src="../../../assets/media/images/<?= htmlspecialchars($album['cover_image']); ?>"
                        alt="Cover Image" class="w-16 h-16 object-cover rounded-2xl">
                    <?php else: ?>
                    N/A
                    <?php endif; ?>
                </td>
                <td class="border border-gray-600 px-4 py-2 text-center"><?= $album['song_count']; ?></td>
                <td class="border border-gray-600 px-4 py-2 text-center">
                    <form method="GET" action="./view.album.details.php" class="inline-block">
                        <input type="hidden" name="album_id" value="<?= $album['album_id']; ?>">
                        <button type="submit"
                            class="transition duration-300 bg-[#433878] hover:bg-[#7E60BF] text-white py-1 px-2 rounded">View
                            Songs</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </section>

    </body>

    </html>