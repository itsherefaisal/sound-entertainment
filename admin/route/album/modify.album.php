<?php
define("ROUTE", "modify.album");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];
$album_id = $_GET['album_id'] ?? null;

if (!$album_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Modify Album</h1>
            <form method="GET" action="" class="space-y-4">
                <label for="album_id" class="block text-sm font-bold">Please provide album ID to modify its details</label>
                <input type="number" id="album_id" name="album_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Album ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Load Album</button>
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
$album = $result->fetch_assoc();

if (!$album) {
    echo '
        <main class="w-full h-full flex items-center justify-center h-screen flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Album not found with the provided ID</h1>
            <a href="./modify.album.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

$album_name = $album['name'];
$release_year = $album['release_year'];
$description = $album['description'];
$cover_image = $album['cover_image'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album_name = trim($_POST['name']);
    $release_year = $_POST['release_year'];
    $description = $_POST['description'];
    $cover_image_name = $cover_image; 

    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image_name = uniqid() . "_album_cover.jpg";
        $cover_image_upload_path = "../../../assets/media/images/" . $cover_image_name;

        if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_upload_path)) {
            $errors['cover_image'] = "Failed to upload cover image.";
        }
    }

    if (empty($album_name)) {
        $errors['name'] = "Album name is required.";
    }
    if (empty($release_year) || !filter_var($release_year, FILTER_VALIDATE_INT) || $release_year < 1900 || $release_year > date('Y')) {
        $errors['release_year'] = "Enter a valid release year.";
    }
    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }
    if (empty($cover_image_name)) {
        $errors['cover_image'] = "Cover image is required.";
    }

    if (empty($errors)) {
        $query = "UPDATE albums SET name = ?, release_year = ?, description = ?, cover_image = ? WHERE album_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissi", $album_name, $release_year, $description, $cover_image_name, $album_id);

        if ($stmt->execute()) {
            echo "<script>window.location.href = './view.album.php';</script>";
            exit;
        } else {
            $errors['database'] = "Error updating album in the database.";
        }
    }
}

?>

<main class="w-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Modify Album</h1>
    <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
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
            <label for="name" class="block text-xs font-bold pl-2">Album Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($album_name); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>

        <div>
            <label for="release_year" class="block text-xs font-bold pl-2">Release Year</label>
            <input type="number" id="release_year" name="release_year" min="1900" max="<?php echo date('Y'); ?>"
                value="<?php echo htmlspecialchars($release_year); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>

        <div>
            <label for="description" class="block text-xs font-bold pl-2">Description</label>
            <textarea id="description" name="description" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div>
            <label for="cover_image" class="block text-xs font-bold pl-2">Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
            <?php if ($cover_image): ?>
            <p class="mt-2 text-xs text-gray-300">Current Cover Image: <a
                    href="../../../assets/media/images/<?php echo $cover_image; ?>" target="_blank"
                    class="text-blue-500">View Image</a></p>
            <?php endif; ?>
        </div>

        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Update
            Album</button>
    </form>
</main>
</section>

</body>

</html>