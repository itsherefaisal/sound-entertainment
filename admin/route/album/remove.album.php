<?php
define("ROUTE", "delete.album");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$album_id = $_GET['album_id'] ?? ($_POST['album_id'] ?? null);

if (!$album_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Delete Album</h1>
            <form method="POST" action="" class="space-y-4">
                <label for="album_id" class="block text-sm font-bold">Please provide album ID to delete the album</label>
                <input type="number" id="album_id" name="album_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Album ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Delete</button>
            </form>
        </main>
    ';
    exit;
}

$query = "SELECT * FROM albums WHERE album_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $album_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $album = $result->fetch_assoc();
} else {
    echo '
        <main class="w-full h-full flex items-center justify-center min-h-[80vh] flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Album not found with the provided ID</h1>
            <a href="./remove.album.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    // Optionally, delete the album cover image from the server if needed
    $cover_image_path = "../../../assets/media/images/" . $album['cover_image'];
    if (file_exists($cover_image_path)) {
        unlink($cover_image_path);
    }

    $delete_query = "DELETE FROM albums WHERE album_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $album_id);

    if ($stmt->execute()) {
        echo '
            <script>
                window.location.href = "./view.album.php";
            </script>
        ';
        exit;
    } else {
        echo '
            <main class="w-full h-full flex items-center justify-center flex-col bg-[#160F30] p-8 text-white">
                <h1 class="text-xl font-medium mb-4">Error deleting album. Please try again later.</h1>
                <a href="./remove.album.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
            </main>
        ';
    }
}

$stmt->close();
$conn->close();
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Delete Album</h1>
    <p>Are you sure you want to delete the album titled <strong><?php echo htmlspecialchars($album['name']); ?></strong>?</p>
    <form method="POST" action="" class="space-y-4">
        <input type="hidden" name="album_id" value="<?php echo $album['album_id']; ?>">
        <button type="submit" name="confirm_delete" class="px-5 py-2 bg-[#FF2929] transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] text-white rounded">Delete</button>
        <a href="./view.album.php" class="px-5 py-2 bg-gray-600 hover:bg-gray-800 text-white rounded">Cancel</a>
    </form>
</main>
</section>

</body>

</html>
