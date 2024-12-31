<?php 
define("ROUTE", "add.album");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $release_year = $_POST['release_year'];
    $description = trim($_POST['description']);

    if (empty($name)) {
        $errors['name'] = "Album name is required.";
    }
    if (empty($release_year) || !filter_var($release_year, FILTER_VALIDATE_INT) || $release_year < 1900 || $release_year > date('Y')) {
        $errors['release_year'] = "Enter a valid release year.";
    }
    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }
    if (empty($_FILES['cover_image']['name'])) {
        $errors['cover_image'] = "Cover image is required.";
    }

    if (empty($errors)) {
        $cover_image = $_FILES['cover_image']['name'];

        $cover_image_name = uniqid() . "_cover." . pathinfo($cover_image, PATHINFO_EXTENSION);

        $cover_image_upload_path = "../../../assets/media/images/" . $cover_image_name;

        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_upload_path)) {
            $query = "INSERT INTO albums (name, release_year, description, cover_image) 
                      VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("siss", $name, $release_year, $description, $cover_image_name);

            if ($stmt->execute()) {
                echo "<script>window.location.href = './view.album.php';</script>";
                exit;
            } else {
                $errors['database'] = "Error adding album to database.";
            }
        } else {
            $errors['upload'] = "Failed to upload cover image.";
        }
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Add New Album</h1>
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
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="release_year" class="block text-xs font-bold pl-2">Release Year</label>
            <input type="number" id="release_year" name="release_year" min="1900" max="<?php echo date('Y'); ?>"
                value="<?php echo htmlspecialchars($release_year ?? ''); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="description" class="block text-xs font-bold pl-2">Description</label>
            <textarea id="description" name="description"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
        </div>
        <div>
            <label for="cover_image" class="block text-xs font-bold pl-2">Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Add
            Album</button>
    </form>
</main>

</section>

</body>

</html>