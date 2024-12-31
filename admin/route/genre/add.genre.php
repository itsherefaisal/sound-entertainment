<?php 
define("ROUTE", "add.genre");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genre_names = trim($_POST['genre_name']);
    
    if (empty($genre_names)) {
        $errors['genre_name'] = "Genre name is required.";
    }

    if (empty($errors)) {
        $genres = explode(" ", $genre_names);
        $success_count = 0;
        $failure_count = 0;

        foreach ($genres as $genre_name) {
            $genre_name = trim($genre_name);
            if (!empty($genre_name)) {
                $query = "INSERT INTO genres (name) VALUES (?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $genre_name);

                if ($stmt->execute()) {
                    $success_count++;
                } else {
                    $failure_count++;
                }
            }
        }

        if ($success_count > 0) {
            echo "<script>window.location.href = './view.genre.php';</script>";
            exit;
        } else {
            $errors['database'] = "Error adding genres to database. $failure_count failed.";
        }
    }
}
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4">Add New Genres</h1>
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
            <label for="genre_name" class="block text-xs font-bold pl-2">Genre Names</label>
            <div id="genre-container"
                class="flex flex-wrap gap-2 py-2 px-2 border-2 border-gray-400 rounded-3xl bg-transparent">
                <input type="text" id="genre_name" name="genre_name" placeholder="Type genres and press space"
                    class="flex-grow text-sm py-1 pl-2 outline-none rounded bg-transparent border-none text-white">
            </div>
            <p class="text-xs text-gray-400 mt-1 ml-4">Enter multiple genres separated by spaces (e.g., "Action
                Adventure
                Drama").</p>
        </div>

        <button type="submit"
            class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Add
            Genres</button>
    </form>
</main>

<script>
$(document).ready(function() {
    const $genreInput = $('#genre_name');
    const $genreContainer = $('#genre-container');
    const genres = [];

    $genreInput.on('keypress', function(e) {
        if (e.which === 32) { // Space key
            e.preventDefault();
            const genre = $genreInput.val().trim();
            if (genre && !genres.includes(genre)) {
                genres.push(genre);
                const $tag = $(
                    `<span class="bg-blue-600 text-white px-2 py-1 h-full rounded-full text-sm font-semibold">${genre}<button class="ml-2 text-white text-xs font-bold hover:text-gray-300">&times;</button></span>`
                );
                $genreContainer.prepend($tag);
                $genreInput.val('');

                $tag.find('button').on('click', function() {
                    $tag.remove();
                    const index = genres.indexOf(genre);
                    if (index !== -1) {
                        genres.splice(index, 1);
                    }
                });
            }
        }
    });

    // Serialize genres for form submission
    $('form').on('submit', function() {
        $genreInput.val(genres.join(' '));
    });
});
</script>

</section>
</body>

</html>