<?php 
define("ROUTE", "add.artist"); 
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $bio = trim($_POST['bio']);

    if (empty($name)) {
        $errors['name'] = "Artist name is required.";
    }
    if (empty($bio)) {
        $errors['bio'] = "Bio is required.";
    }
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = "Profile image is required.";
    }

    if (empty($errors)) {
        $image = $_FILES['image']['name'];
        $image_name = uniqid() . "_artist." . pathinfo($image, PATHINFO_EXTENSION);
        $image_upload_path = "../../../assets/media/images/" . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path)) {
            $query = "INSERT INTO artists (name, bio, image_url) 
                      VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $name, $bio, $image_name);

            if ($stmt->execute()) {
                echo "<script>window.location.href = './view.artist.php';</script>";
                exit;
            } else {
                $errors['database'] = "Error adding artist to database.";
            }
        } else {
            $errors['upload'] = "Failed to upload profile image.";
        }
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Add New Artist</h1>
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
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white">
        </div>
        <div>
            <label for="bio" class="block text-xs font-bold pl-2">Bio</label>
            <textarea id="bio" name="bio"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white"><?php echo htmlspecialchars($bio ?? ''); ?></textarea>
        </div>
        <div>
            <label for="image" class="block text-xs font-bold pl-2">Profile Image</label>
            <input type="file" id="image" name="image" accept="image/*" required
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white">
        </div>
        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Add
            Artist</button>
    </form>
</main>

</section>

</body>

</html>