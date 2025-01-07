<?php 

define("ROUTE", "view.video");
include_once("../../includes/header.admin.php");

include_once("../../../config.php");

$movies = [];
$sql = "SELECT videos.video_id, videos.title, videos.language, videos.year, genres.name AS genre, 
        videos.cover_image, videos.description, videos.is_new 
        FROM videos 
        JOIN genres ON videos.genre_id = genres.genre_id";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Movies</h1>
    <table class="w-full table-auto border-collapse border border-gray-600">
        <thead>
            <tr class="bg-[#1B1833] text-white text-xs">
                <th class="border border-gray-600 px-4 py-2">Movie ID</th>
                <th class="border border-gray-600 px-4 py-2">Title</th>
                <th class="border border-gray-600 px-4 py-2">Language</th>
                <th class="border border-gray-600 px-4 py-2">Year</th>
                <th class="border border-gray-600 px-4 py-2">Genre</th>
                <th class="border border-gray-600 px-4 py-2">Cover Image</th>
                <th class="border border-gray-600 px-4 py-2">Description</th>
                <th class="border border-gray-600 px-4 py-2">New</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($movies)): ?>
            <tr>
                <td colspan="9" class="text-center border border-gray-600 px-4 py-8 text-sm text-gray-300">
                    No movies found.
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($movies as $movie): ?>
            <tr class="hover:bg-[#4B4376] text-sm">
                <td class="border border-gray-600 px-4 py-2"><?= $movie['video_id']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($movie['title']); ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= $movie['language']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= $movie['year']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($movie['genre']); ?></td>
                <td class="border border-gray-600 px-4 py-2">
                    <?php if ($movie['cover_image']): ?>
                    <img src="../../../assets/media/images/<?= htmlspecialchars($movie['cover_image']); ?>"
                        alt="Cover Image" class="w-16 h-16 object-cover rounded-2xl">
                    <?php else: ?>
                    N/A
                    <?php endif; ?>
                </td>
                <td class="border border-gray-600 px-4 py-2"><?= nl2br(htmlspecialchars($movie['description'])); ?></td>
                <td class="border border-gray-600 px-4 py-2 text-center"><?= $movie['is_new'] ? "Yes" : "No"; ?></td>
                <td class="border border-gray-600 px-4 py-2 text-center">
                    <form method="GET" action="./modify.video.php" class="inline-block">
                        <input type="hidden" name="video_id" value="<?= $movie['video_id']; ?>">
                        <button type="submit"
                            class="transition duration-300 bg-[#433878] hover:bg-[#7E60BF] text-white py-1 px-2 rounded">Edit</button>
                    </form>
                    <form method="GET" action="./remove.video.php" class="inline-block">
                        <input type="hidden" name="video_id" value="<?= $movie['video_id']; ?>">
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