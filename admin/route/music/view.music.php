<?php 

define("ROUTE", "view.music");
include_once("../../includes/header.admin.php");

include_once("../../../config.php");

$songs = [];
$sql = "SELECT music.music_id, music.title, music.language, music.year, albums.name AS album, 
        artists.name AS artist, music.cover_image, music.description, music.is_new 
        FROM music 
        JOIN albums ON music.album_id = albums.album_id
        JOIN artists ON music.artist_id = artists.artist_id";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Songs</h1>
    <table class="w-full table-auto border-collapse border border-gray-600">
        <thead>
            <tr class="bg-[#1B1833] text-white text-xs">
                <th class="border border-gray-600 px-4 py-2">Song ID</th>
                <th class="border border-gray-600 px-4 py-2">Title</th>
                <th class="border border-gray-600 px-4 py-2">Language</th>
                <th class="border border-gray-600 px-4 py-2">Year</th>
                <th class="border border-gray-600 px-4 py-2">Album</th>
                <th class="border border-gray-600 px-4 py-2">Artist</th>
                <th class="border border-gray-600 px-4 py-2">Cover Image</th>
                <th class="border border-gray-600 px-4 py-2">Description</th>
                <th class="border border-gray-600 px-4 py-2">New</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($songs)): ?>
            <tr>
                <td colspan="10" class="text-center border border-gray-600 px-4 py-8 text-sm text-gray-300">
                    No songs found.
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($songs as $song): ?>
            <tr class="hover:bg-[#4B4376] text-sm">
                <td class="border border-gray-600 px-4 py-2"><?= $song['music_id']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($song['title']); ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= $song['language']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= $song['year']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($song['album']); ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($song['artist']); ?></td>
                <td class="border border-gray-600 px-4 py-2">
                    <?php if ($song['cover_image']): ?>
                    <img src="../../../assets/media/images/<?= htmlspecialchars($song['cover_image']); ?>"
                        alt="Cover Image" class="w-16 h-16 object-cover rounded-2xl">
                    <?php else: ?>
                    N/A
                    <?php endif; ?>
                </td>
                <td class="border border-gray-600 px-4 py-2"><?= nl2br(htmlspecialchars($song['description'])); ?></td>
                <td class="border border-gray-600 px-4 py-2 text-center"><?= $song['is_new'] ? "Yes" : "No"; ?></td>
                <td class="border border-gray-600 px-4 py-2 text-center">
                    <form method="GET" action="./modify.music.php" class="inline-block">
                        <input type="hidden" name="music_id" value="<?= $song['music_id']; ?>">
                        <button type="submit"
                            class="transition duration-300 bg-[#433878] hover:bg-[#7E60BF] text-white py-1 px-2 rounded">Edit</button>
                    </form>
                    <form method="GET" action="./remove.music.php" class="inline-block">
                        <input type="hidden" name="music_id" value="<?= $song['music_id']; ?>">
                        <button type="submit"
                            class="transition duration-300 bg-[#C62E2E] hover:bg-[#F95454] text-white py-1 px-2 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>

</html>