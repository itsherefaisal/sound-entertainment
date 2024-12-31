<?php 
define("ROUTE", "modify.video");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];
$video_id = $_GET['video_id'] ?? null;

if (!$video_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Modify Video</h1>
            <form method="GET" action="" class="space-y-4">
                <label for="video_id" class="block text-sm font-bold">Please provide video ID to modify its details</label>
                <input type="number" id="video_id" name="video_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Video ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Load Video</button>
            </form>
        </main>
    ';
    exit;
}

$query = "SELECT * FROM videos WHERE video_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $video_id);
$stmt->execute();
$result = $stmt->get_result();
$video = $result->fetch_assoc();

if (!$video) {
    echo '
        <main class="w-full h-full flex items-center justify-center h-screen flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Video not found with the provided ID</h1>
            <a href="./modify.video.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}


$title = $video['title'];
$language = $video['language'];
$year = $video['year'];
$genre_id = $video['genre_id'];
$description = $video['description'];
$is_new = $video['is_new'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $language = $_POST['language'];
    $year = $_POST['year'];
    $genre_id = $_POST['genre_id'];
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
    if (empty($genre_id)) {
        $errors['genre_id'] = "Genre is required.";
    }

    $video_file_name = $video['file_path'];
    $cover_image_name = $video['cover_image'];

    if (!empty($_FILES['video_file']['name'])) {
        $video_file_name = uniqid() . "_video." . pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);
        $video_upload_path = "../../../assets/media/videos/" . $video_file_name;
        if (!move_uploaded_file($_FILES['video_file']['tmp_name'], $video_upload_path)) {
            $errors['video_file'] = "Failed to upload video file.";
        }
    }

    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image_name = uniqid() . "_video_cover.jpg";
        $cover_image_upload_path = "../../../assets/media/images/" . $cover_image_name;
        if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_upload_path)) {
            $errors['cover_image'] = "Failed to upload cover image.";
        }
    }

    if (empty($errors)) {
        $query = "UPDATE videos SET title = ?, language = ?, year = ?, genre_id = ?, file_path = ?, cover_image = ?, description = ?, is_new = ? WHERE video_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssissssii", $title, $language, $year, $genre_id, $video_file_name, $cover_image_name, $description, $is_new, $video_id);

        if ($stmt->execute()) {
            echo "<script>window.location.href = './view.video.php';</script>";
            exit;
        } else {
            $errors['database'] = "Error updating video in database.";
        }
    }
}
?>

<main class="w-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Modify Video</h1>
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
            <label for="language" class="block text-xs font-bold pl-2">Language</label>
            <select id="language" name="language" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <option value="ENGLISH" class='text-black' <?php echo $language === 'ENGLISH' ? 'selected' : ''; ?>>
                    ENGLISH</option>
                <option value="REGIONAL" class='text-black' <?php echo $language === 'REGIONAL' ? 'selected' : ''; ?>>
                    REGIONAL</option>
            </select>
        </div>
        <div>
            <label for="year" class="block text-xs font-bold pl-2">Year</label>
            <input type="number" id="year" name="year" min="1900" max="<?php echo date('Y'); ?>"
                value="<?php echo htmlspecialchars($year); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="genre_id" class="block text-xs font-bold pl-2">Genre</label>
            <select id="genre_id" name="genre_id" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
                <?php
                $genre_query = "SELECT genre_id, name FROM genres";
                $result = $conn->query($genre_query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['genre_id']}' class='text-black' " . ($genre_id == $row['genre_id'] ? ' selected' : '') . ">{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="description" class="block text-xs font-bold pl-2">Description</label>
            <textarea id="description" name="description"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="flex items-center gap-2">
            <label for="is_new" class="block text-xs font-bold pl-2">Is New</label>
            <input type="checkbox" id="is_new" name="is_new" <?php echo $is_new ? 'checked' : ''; ?>
                class="w-4 h-4 my-1 outline-none rounded bg-transparent border-2 border-gray-400">
        </div>
        <div>
            <label for="video_file" class="block text-xs font-bold pl-2">Change video File</label>
            <input type="file" id="video_file" name="video_file" accept="video/*"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="cover_image" class="block text-xs font-bold pl-2">Change cover Image</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Update
            Video</button>
    </form>
</main>

</section>

</body>

</html>