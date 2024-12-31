<footer class=" rounded-lg shadow bg-[#202040] <?php if (ROUTE === "login" || ROUTE === "register") {
                                                        echo 'mt-0';
                                                    } else {
                                                        echo 'mt-16';
                                                    }
                                                ?>">
    <div class="w-full max-w-screen-xl mx-auto py-6 md:py-12">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="<?= ROUTE === "index" ? './' : '../' ?>"
                class="flex items-center mb-2 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="<?= ROUTE === "index" ? './assets/images/sound.png' : '../assets/images/sound.png' ?>"
                    class="h-8" alt="Sound" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Sound</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-4" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                href="<?= ROUTE === "index" ? './' : '../' ?>" class="hover:underline">Sound™</a>. All Rights
            Reserved.</span>
    </div>
</footer>
<?php 
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
?>
<script>
$('#show-profile').on('click', function() {
    $('#profile-container')
        .fadeIn(300)
        .css('display', 'flex');
    $('body').css('overflow', 'hidden');
});

$('#close-profile').on('click', function() {
    $('#profile-container').fadeOut(300);
    $('body').css('overflow', 'auto');
});

// Search functionlity 
$(document).ready(function() {
    function debounce(func, delay) {
        let debounceTimer;
        return function(...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function searchContent(query) {
        if (query.trim() === "") {
            $(".search-list").empty().hide();
            return;
        }

        $.ajax({
            url: "<?= (ROUTE === 'index') ? './controller/search.controller.php' : '../controller/search.controller.php' ?>",
            type: "GET",
            data: {
                query
            },
            success: function(response) {
                const {
                    music,
                    videos
                } = response;

                $(".search-list").empty();

                if (music.length > 0) {
                    $(".search-list").append(
                        '<h4 class="text-gray-400 text-xs px-2">Music Results</h4>');
                    music.forEach((result) => {
                        const detailUrl =
                            `<?= (ROUTE === 'index') ? './routes/' : './' ?>music.php?music_id=${result.id}`;
                        $(".search-list").append(`
                        <div onclick="window.location.href='${detailUrl}'" class="search-result flex items-center gap-1 p-2 cursor-pointer hover:bg-gray-800">
                            <img src="<?= (ROUTE === 'index') ? './assets/media/images/' : '../assets/media/images/' ?>${result.cover_image}" class="object-fit size-12" alt="${result.title}">
                            <div class="search-details flex flex-col overflow-hidden ml-2">
                                <h3 class="truncate text-sm my-0 text-gray-200">Song: ${result.title}</h3>
                                <span class="truncate text-xs text-gray-300">Artist: ${result.artist_name}</span>
                                <span class="truncate text-xs text-gray-300">Album: ${result.album_name}</span>
                            </div>
                        </div>
                    `);
                    });
                }

                if (videos.length > 0) {
                    $(".search-list").append(
                        '<h4 class="text-gray-400 text-xs px-2 mt-2">Video Results</h4>');
                    videos.forEach((result) => {
                        const detailUrl =
                            `<?= (ROUTE === 'index') ? './routes/' : './' ?>video.php?video_id=${result.id}`;
                        $(".search-list").append(`
                        <div onclick="window.location.href='${detailUrl}'" class="search-result flex items-center gap-1 p-2 cursor-pointer hover:bg-gray-800">
                            <img src="<?= (ROUTE === 'index') ? './assets/media/images/' : '../assets/media/images/' ?>${result.cover_image}" class="object-fit size-12" alt="${result.title}">
                            <div class="search-details flex flex-col overflow-hidden ml-2">
                                <h3 class="truncate text-sm my-0 text-gray-200">Video: ${result.title}</h3>
                                <span class="truncate text-xs text-gray-300">Genre: ${result.genre_name}</span>
                                <span class="truncate text-xs text-gray-300">Language: ${result.language}</span>
                            </div>
                        </div>
                    `);
                    });
                }

                if (music.length === 0 && videos.length === 0) {
                    $(".search-list").append(
                        `<div class="text-gray-300 p-2 text-sm text-center">No music or videos found</div>`
                    );
                }

                $(".search-list").show();
            },
            error: function() {
                $(".search-list")
                    .empty()
                    .append(
                        `<div class="text-red-500 p-2 text-sm text-center">Error fetching results</div>`
                        )
                    .show();
            },
        });
    }


    $("#search-bar").on(
        "input",
        debounce(function() {
            const query = $(this).val();
            searchContent(query);
        }, 300)
    );
});
</script>
<?php 
}
?>