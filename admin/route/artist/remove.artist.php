<?php
define("ROUTE", "delete.artist"); 
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$artist_id = $_GET['artist_id'] ?? ($_POST['artist_id'] ?? null);

if (!$artist_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Delete Artist</h1>
            <form method="POST" action="" class="space-y-4">
                <label for="artist_id" class="block text-sm font-bold">Please provide artist ID to delete the artist</label>
                <input type="number" id="artist_id" name="artist_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Artist ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Delete</button>
            </form>
        </main>
    ';
    exit;
}

$query = "SELECT * FROM artists WHERE artist_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $artist_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $artist = $result->fetch_assoc();
} else {
    echo '
        <main class="w-full h-full flex items-center justify-center min-h-[80vh] flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Artist not found with the provided ID</h1>
            <a href="./remove.artist.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $image_url_path = "../../../assets/media/images/" . $artist['image_url'];
    if (file_exists($image_url_path)) {
        unlink($image_url_path);
    }

    $delete_query = "DELETE FROM artists WHERE artist_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $artist_id);

    if ($stmt->execute()) {
        echo '
            <script>
                window.location.href = "./view.artist.php";
            </script>
        ';
        exit;
    } else {
        echo '
            <main class="w-full h-full flex items-center justify-center flex-col bg-[#160F30] p-8 text-white">
                <h1 class="text-xl font-medium mb-4">Error deleting artist. Please try again later.</h1>
                <a href="./remove.artist.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
            </main>
        ';
    }
}

$stmt->close();
$conn->close();
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Delete Artist</h1>
    <p>Are you sure you want to delete the artist titled
        <strong><?php echo htmlspecialchars($artist['name']); ?></strong>?
    </p>
    <form method="POST" action="" class="space-y-4">
        <input type="hidden" name="artist_id" value="<?php echo $artist['artist_id']; ?>">
        <button type="submit" name="confirm_delete"
            class="px-5 py-2 bg-[#FF2929] transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] text-white rounded">Delete</button>
        <a href="./view.artist.php" class="px-5 py-2 bg-gray-600 hover:bg-gray-800 text-white rounded">Cancel</a>
    </form>
</main>
</section>

</body>

</html>