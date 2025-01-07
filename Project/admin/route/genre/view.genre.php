<?php 

define("ROUTE", "view.genre");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$genres = [];
$sql = "SELECT genre_id, name FROM genres";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Genres</h1>
    <table class="w-full table-auto border-collapse border border-gray-600">
        <thead>
            <tr class="bg-[#1B1833] text-white text-xs">
                <th class="border border-gray-600 px-4 py-2">Genre ID</th>
                <th class="border border-gray-600 px-4 py-2">Name</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($genres)): ?>
            <tr>
                <td colspan="3" class="text-center border border-gray-600 px-4 py-8 text-sm text-gray-300">
                    No genres found.
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($genres as $genre): ?>
            <tr class="hover:bg-[#4B4376] text-sm">
                <td class="border border-gray-600 px-4 py-2"><?= $genre['genre_id']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($genre['name']); ?></td>
                <td class="border border-gray-600 px-4 py-2 text-center">
                    <form method="GET" action="./modify.genre.php" class="inline-block">
                        <input type="hidden" name="genre_id" value="<?= $genre['genre_id']; ?>">
                        <button type="submit"
                            class="transition duration-300 bg-[#433878] hover:bg-[#7E60BF] text-white py-1 px-2 rounded">Edit</button>
                    </form>
                    <form method="GET" action="./remove.genre.php" class="inline-block">
                        <input type="hidden" name="genre_id" value="<?= $genre['genre_id']; ?>">
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