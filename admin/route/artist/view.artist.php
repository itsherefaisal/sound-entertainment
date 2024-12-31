<?php 

define("ROUTE", "view.artist"); 
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$artists = [];
$sql = "SELECT 
            artist_id, 
            name AS artist_name, 
            bio, 
            image_url 
        FROM artists";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artists[] = $row;
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Artists</h1>
    <table class="w-full table-auto border-collapse border border-gray-600">
        <thead>
            <tr class="bg-[#1B1833] text-white text-xs">
                <th class="border border-gray-600 px-4 py-2">Artist ID</th>
                <th class="border border-gray-600 px-4 py-2">Artist Name</th>
                <th class="border border-gray-600 px-4 py-2">Bio</th>
                <th class="border border-gray-600 px-4 py-2">Profile Image</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($artists)): ?>
            <tr>
                <td colspan="5" class="text-center border border-gray-600 px-4 py-8 text-sm text-gray-300">
                    No artists found.
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($artists as $artist): ?>
            <tr class="hover:bg-[#4B4376] text-sm">
                <td class="border border-gray-600 px-4 py-2"><?= $artist['artist_id']; ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($artist['artist_name']); ?></td>
                <td class="border border-gray-600 px-4 py-2"><?= htmlspecialchars($artist['bio']); ?></td>
                <td class="border border-gray-600 px-4 py-2">
                    <?php if ($artist['image_url']): ?>
                    <img src="../../../assets/media/images/<?= htmlspecialchars($artist['image_url']); ?>"
                        alt="Profile Image" class="w-16 h-16 object-cover rounded-2xl">
                    <?php else: ?>
                    N/A
                    <?php endif; ?>
                </td>
                <td class="border border-gray-600 px-4 py-2 text-center">
                    <form method="GET" action="./view.artist.details.php" class="inline-block">
                        <input type="hidden" name="artist_id" value="<?= $artist['artist_id']; ?>">
                        <button type="submit"
                            class="transition duration-300 bg-[#433878] hover:bg-[#7E60BF] text-white py-1 px-2 rounded">View
                            Albums</button>
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