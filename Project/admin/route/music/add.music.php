<?php 
define("ROUTE", "add.music");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $language = $_POST['language'];
    $year = $_POST['year'];
    $album_id = $_POST['album_id'];
    $artist_id = $_POST['artist_id'];
    $description = trim($_POST['description']);
    $is_new = isset($_POST['is_new']) ? 1 : 0;

    if (empty($title)) {
        $errors['title'] = "Title is required.";
    }
    if (empty($language)) {
        $errors['language'] = "Language is required.";
    }
    if (empty($year) || !filter_var($year, FILTER_VALIDATE_INT) || $year < 1900 || $year > date('Y')) {
        $errors['year'] = "Enter a valid year.";
    }
    if (empty($album_id)) {
        $errors['album_id'] = "Album is required.";
    }
    if (empty($artist_id)) {
        $errors['artist_id'] = "Artist is required.";
    }
    if (empty($music_file = $_FILES['music_file']['name'])) {
        $errors['music_file'] = "Music file is required.";
    }
    if (empty($cover_image = $_FILES['cover_image']['name'])) {
        $errors['cover_image'] = "Cover image is required.";
    }

    if (empty($errors)) {
        $music_file_name = uniqid() . "_music." . pathinfo($music_file, PATHINFO_EXTENSION);
        $cover_image_name = uniqid() . "_music_cover.jpg";

        $music_upload_path = "../../../assets/media/songs/" . $music_file_name;
        $cover_image_upload_path = "../../../assets/media/images/" . $cover_image_name;

        if (move_uploaded_file($_FILES['music_file']['tmp_name'], $music_upload_path) && move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_upload_path)) {
            $query = "INSERT INTO music (title, language, year, album_id, artist_id, file_path, cover_image, description, is_new) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssiiisssi", $title, $language, $year, $album_id, $artist_id, $music_file_name, $cover_image_name, $description, $is_new);

            if ($stmt->execute()) {
                echo "<script>window.location.href = './view.music.php';</script>";
                exit;
            } else {
                $errors['database'] = "Error adding music to database.";
            }
        } else {
            $errors['upload'] = "Failed to upload files.";
        }
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Add New Music</h1>
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
            <label for="title" class="block text-xs font-bold pl-2">Title</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title ?? ''); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="language" class="block text-xs font-bold pl-2">Language</label>
            <select id="language" name="language" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <option value="ENGLISH" class='text-black'
                    <?php echo ($language ?? '') === 'ENGLISH' ? 'selected' : ''; ?>>ENGLISH</option>
                <option value="REGIONAL" class='text-black'
                    <?php echo ($language ?? '') === 'REGIONAL' ? 'selected' : ''; ?>>REGIONAL</option>
            </select>
        </div>
        <div>
            <label for="year" class="block text-xs font-bold pl-2">Year</label>
            <input type="number" id="year" name="year" min="1900" max="<?php echo date('Y'); ?>"
                value="<?php echo htmlspecialchars($year ?? ''); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="album_id" class="block text-xs font-bold pl-2">Album</label>
            <select id="album_id" name="album_id" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <?php
                $album_query = "SELECT album_id, name FROM albums";
                $result = $conn->query($album_query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['album_id']}' class='text-black' " . (($album_id ?? '') == $row['album_id'] ? 'selected' : '') . ">{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="artist_id" class="block text-xs font-bold pl-2">Artist</label>
            <select id="artist_id" name="artist_id" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <?php
                $artist_query = "SELECT artist_id, name FROM artists";
                $result = $conn->query($artist_query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['artist_id']}' class='text-black' " . (($artist_id ?? '') == $row['artist_id'] ? 'selected' : '') . ">{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="description" class="block text-xs font-bold pl-2">Description</label>
            <textarea id="description" name="description"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
        </div>
        <div class="flex items-center gap-2">
            <label for="is_new" class="block text-xs font-bold pl-2">Is New</label>
            <input type="checkbox" id="is_new" name="is_new" <?php echo !empty($is_new) ? 'checked' : ''; ?>
                class="w-4 h-4 my-1 outline-none rounded bg-transparent border-2 border-gray-400">
        </div>
        <div>
            <label for="music_file" class="block text-xs font-bold pl-2">Music File</label>
            <input type="file" id="music_file" name="music_file" accept="audio/*" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="cover_image" class="block text-xs font-bold pl-2">Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Add
            Music</button>
    </form>
</main>

</section>

</body>

</html>