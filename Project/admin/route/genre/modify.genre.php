<?php 
define("ROUTE", "modify.genre"); 
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];
$genre_id = $_GET['genre_id'] ?? null;

if (!$genre_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Modify Genre</h1>
            <form method="GET" action="" class="space-y-4">
                <label for="genre_id" class="block text-sm font-bold">Please provide genre ID to modify its details</label>
                <input type="number" id="genre_id" name="genre_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Genre ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Load Genre</button>
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
$genre = $result->fetch_assoc();

if (!$genre) {
    echo '
        <main class="w-full h-full flex items-center justify-center h-screen flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Genre not found with the provided ID</h1>
            <a href="./modify.genre.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

$name = $genre['name'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);

    if (empty($name)) {
        $errors['name'] = "Genre name is required.";
    }

    if (empty($errors)) {
        $query = "UPDATE genres SET name = ? WHERE genre_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $name, $genre_id);

        if ($stmt->execute()) {
            echo "<script>window.location.href = './view.genre.php';</script>";
            exit;
        } else {
            $errors['database'] = "Error updating genre in database.";
        }
    }
}
?>

<main class="w-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Modify Genre</h1>
    <form method="POST" action="" class="space-y-4">
        <?php if (!empty($errors)): ?>
        <div class="bg-red-500 text-white p-3 rounded">
            <ul>
                <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div>
            <label for="name" class="block text-xs font-bold pl-2">Genre Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Update
            Genre</button>
    </form>
</main>
</body>

</html>