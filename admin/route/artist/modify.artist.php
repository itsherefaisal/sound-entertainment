<?php
define("ROUTE", "modify.artist"); 
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];
$artist_id = $_GET['artist_id'] ?? null;

if (!$artist_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Modify Artist</h1>
            <form method="GET" action="" class="space-y-4">
                <label for="artist_id" class="block text-sm font-bold">Please provide artist ID to modify their details</label>
                <input type="number" id="artist_id" name="artist_id" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter Artist ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Load Artist</button>
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
$artist = $result->fetch_assoc();

if (!$artist) {
    echo '
        <main class="w-full h-full flex items-center justify-center h-screen flex-col bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-medium mb-4">Artist not found with the provided ID</h1>
            <a href="./modify.artist.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

$artist_name = $artist['name'];
$bio = $artist['bio'];
$profile_image = $artist['image_url'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artist_name = trim($_POST['name']);
    $bio = $_POST['bio'];
    $profile_image_name = $profile_image; 

    if (!empty($_FILES['profile_image']['name'])) {
        $profile_image_name = uniqid() . "_artist.jpg";
        $profile_image_upload_path = "../../../assets/media/images/" . $profile_image_name;

        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image_upload_path)) {
            $errors['profile_image'] = "Failed to upload profile image.";
        }
    }

    if (empty($artist_name)) {
        $errors['name'] = "Artist name is required.";
    }
    if (empty($bio)) {
        $errors['bio'] = "Biography is required.";
    }

    if (empty($profile_image_name)) {
        $errors['profile_image'] = "Profile image is required.";
    }

    if (empty($errors)) {
        $query = "UPDATE artists SET name = ?, bio = ?, image_url = ? WHERE artist_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $artist_name, $bio, $profile_image_name, $artist_id);

        if ($stmt->execute()) {
            echo "<script>window.location.href = './view.artist.php';</script>";
            exit;
        } else {
            $errors['database'] = "Error updating artist in the database.";
        }
    }
}

?>

<main class="w-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Modify Artist</h1>
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
            <label for="name" class="block text-xs font-bold pl-2">Artist Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($artist_name); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>

        <div>
            <label for="bio" class="block text-xs font-bold pl-2">Biography</label>
            <textarea id="bio" name="bio" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($bio); ?></textarea>
        </div>

        <div>
            <label for="profile_image" class="block text-xs font-bold pl-2">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
            <?php if ($profile_image): ?>
            <p class="mt-2 text-xs text-gray-300">Current Profile Image: <a
                    href="../../../assets/media/images/<?php echo $profile_image; ?>" target="_blank"
                    class="text-blue-500">View Image</a></p>
            <?php endif; ?>
        </div>

        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Update
            Artist</button>
    </form>
</main>
</section>

</body>

</html>