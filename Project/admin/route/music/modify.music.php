<?php
define("ROUTE", "modify.music");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];
$song_id = $_GET['music_id'] ?? null;

if (!$song_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Modify Song</h1>
            <form method="GET" action="" class="space-y-4">
                <label for="music_id" class="block text-sm font-bold">Please provide song ID to modify its details</label>
                <input type="number" id="music_id" name="music_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Song ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Load Song</button>
            </form>
        </main>
    ';
    exit;
}

$query = "SELECT * FROM music WHERE music_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $song_id);
$stmt->execute();
$result = $stmt->get_result();
$song = $result->fetch_assoc();

if (!$song) {
    echo '
        <main class="w-full h-full flex items-center justify-center h-screen flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Song not found with the provided ID</h1>
            <a href="./modify.music.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

$title = $song['title'];
$artist_id = $song['artist_id'];
$album_id = $song['album_id'];
$year = $song['year'];
$language = $song['language'];
$description = $song['description'];
$is_new = $song['is_new'];

$artists = [];
$artist_query = "SELECT artist_id, name FROM artists";
if ($result = $conn->query($artist_query)) {
    while ($row = $result->fetch_assoc()) {
        $artists[] = $row;
    }
    $result->free();
}

$albums = [];
$album_query = "SELECT album_id, name FROM albums";
if ($result = $conn->query($album_query)) {
    while ($row = $result->fetch_assoc()) {
        $albums[] = $row;
    }
    $result->free();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $title = trim($_POST['title']);
    $artist_id = $_POST['artist_id'];
    $album_id = $_POST['album_id'];
    $year = $_POST['year'];
    $language = $_POST['language'];
    $description = trim($_POST['description']);
    $is_new = isset($_POST['is_new']) ? 1 : 0;

    $errors = [];
    if (empty($title)) {
        $errors['title'] = "Title is required.";
    }
    if (empty($artist_id)) {
        $errors['artist_id'] = "Artist is required.";
    }
    if (empty($album_id)) {
        $errors['album_id'] = "Album is required.";
    }
    if (empty($year) || !filter_var($year, FILTER_VALIDATE_INT) || $year < 1900 || $year > date('Y')) {
        $errors['year'] = "Enter a valid year.";
    }
    if (empty($language) || !in_array($language, ['ENGLISH', 'REGIONAL'])) {
        $errors['language'] = "Select a valid language.";
    }

    $song_file_name = $song['file_path'] ?? null;
    $cover_image_name = $song['cover_image'] ?? null;

    if (!empty($_FILES['song_file']['name'])) {
        $song_file_name = uniqid() . "_music." . pathinfo($_FILES['song_file']['name'], PATHINFO_EXTENSION);
        $song_upload_path = "../../../assets/media/songs/" . $song_file_name;
        if (!move_uploaded_file($_FILES['song_file']['tmp_name'], $song_upload_path)) {
            $errors['song_file'] = "Failed to upload song file.";
        }
    }

    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image_name = uniqid() . "_music_cover.jpg";
        $cover_image_upload_path = "../../../assets/media/images/" . $cover_image_name;
        if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_upload_path)) {
            $errors['cover_image'] = "Failed to upload cover image.";
        }
    }

    if (empty($errors)) {
        $query = "UPDATE music SET title = ?, artist_id = ?, album_id = ?, year = ?, language = ?, file_path = ?, cover_image = ?, description = ?, is_new = ? WHERE music_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siisssssii", $title, $artist_id, $album_id, $year, $language, $song_file_name, $cover_image_name, $description, $is_new, $song_id);

        if ($stmt->execute()) {
            echo "<script>window.location.href = './view.music.php';</script>";
            exit;
        } else {
            $errors['database'] = "Error updating song in the database.";
        }
    }
}

?>

<main class="w-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Modify Song</h1>
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
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>

        <div>
            <label for="artist" class="block text-xs font-bold pl-2">Artist</label>
            <select id="artist" name="artist_id" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <?php
                foreach ($artists as $artist) {
                    $selected = ($artist['artist_id'] == $artist_id) ? 'selected' : '';
                    echo "<option class='text-black' value=\"{$artist['artist_id']}\" $selected>{$artist['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="album" class="block text-xs font-bold pl-2">Album</label>
            <select id="album" name="album_id" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <?php
                foreach ($albums as $album) {
                    $selected = ($album['album_id'] == $album_id) ? 'selected' : '';
                    echo "<option class='text-black' value=\"{$album['album_id']}\" $selected>{$album['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="language" class="block text-xs font-bold pl-2">Language</label>
            <select id="language" name="language" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <option class="text-black" value="ENGLISH" <?php echo ($language == 'ENGLISH') ? 'selected' : ''; ?>>
                    English
                </option>
                <option class="text-black" value="REGIONAL" <?php echo ($language == 'REGIONAL') ? 'selected' : ''; ?>>
                    Regional
                </option>
            </select>
        </div>

        <div>
            <label for="year" class="block text-xs font-bold pl-2">Year</label>
            <input type="number" id="year" name="year" min="1900" max="<?php echo date('Y'); ?>"
                value="<?php echo htmlspecialchars($year); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>

        <div>
            <label for="description" class="block text-xs font-bold pl-2">Description</label>
            <textarea id="description" name="description"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="flex items-center gap-2">
            <label for="is_new" class="block text-xs font-bold pl-2">Is Featured</label>
            <input type="checkbox" id="is_new" name="is_new" <?php echo $is_new ? 'checked' : ''; ?>
                class="w-4 h-4 my-1 outline-none rounded bg-transparent border-2 border-gray-400">
        </div>
        <div>
            <label for="song_file" class="block text-xs font-bold pl-2">Change Song File</label>
            <input type="file" id="song_file" name="song_file" accept="audio/*"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="cover_image" class="block text-xs font-bold pl-2">Change Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>

        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Update
            Song</button>
    </form>
</main>


</section>

</body>

</html>