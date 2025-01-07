<?php
define("ROUTE", "delete.genre");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$genre_id = $_GET['genre_id'] ?? ($_POST['genre_id'] ?? null);

if (!$genre_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Delete Genre</h1>
            <form method="POST" action="" class="space-y-4">
                <label for="genre_id" class="block text-sm font-bold">Please provide genre ID to delete the genre</label>
                <input type="number" id="genre_id" name="genre_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Genre ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Delete</button>
            </form>
        </main>
    ';
    exit;
}

$query = "SELECT * FROM genres WHERE genre_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $genre_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $genre = $result->fetch_assoc();
} else {
    echo '
        <main class="w-full h-full flex items-center justify-center flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Genre not found with provided ID</h1>
            <a href="./delete.genre.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $delete_query = "DELETE FROM genres WHERE genre_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $genre_id);

    if ($stmt->execute()) {
        echo '
            <script>
                window.location.href = "./view.genre.php";
            </script>
        ';
        exit;
    } else {
        echo '
            <main class="w-full h-full flex items-center justify-center flex-col bg-[#160F30] p-8 text-white">
                <h1 class="text-xl font-medium mb-4">Error deleting genre. Please try again later.</h1>
                <a href="./delete.genre.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
            </main>
        ';
    }
}

$stmt->close();
$conn->close();
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Delete Genre</h1>
    <p>Are you sure you want to delete the genre named <strong><?php echo htmlspecialchars($genre['name']); ?></strong>?
    </p>
    <form method="POST" action="" class="space-y-4">
        <input type="hidden" name="genre_id" value="<?php echo $genre['genre_id']; ?>">
        <button type="submit" name="confirm_delete"
            class="px-5 py-2 bg-[#FF2929] transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] text-white rounded">Delete</button>
        <a href="./view.genre.php" class="px-5 py-2 bg-gray-600 hover:bg-gray-800 text-white rounded">Cancel</a>
    </form>
</main>
</section>

</body>

</html>