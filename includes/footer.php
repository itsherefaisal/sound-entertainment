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

<script>
<?= (ROUTE === 'index') ? "
    <!-- slider script  -->
            const contentSlider = $('#contentSlider');
            const slides = $('.slide');
            const indicatorDots = $('.indicator-dot');
            const slideCount = slides.length;
            let currentSlideIndex = 0;

            function updateSlider() {
                const offset = -currentSlideIndex * 100;
                contentSlider.css('transform', `translateX(\${offset}%)`);
                indicatorDots.removeClass('bg-[#85A947]').addClass('bg-[#123524]');
                indicatorDots.eq(currentSlideIndex).removeClass('bg-[#123524]').addClass('bg-[#85A947]');
            }

            $('#nextButton').on('click', function () {
                currentSlideIndex = (currentSlideIndex + 1) % slideCount;
                updateSlider();
            });

            $('#prevButton').on('click', function () {
                currentSlideIndex = (currentSlideIndex - 1 + slideCount) % slideCount;
                updateSlider();
            });

            indicatorDots.on('click', function () {
                currentSlideIndex = $(this).data('slide');
                updateSlider();
            });

            updateSlider();
     ":' ';
    ?>
<?php 
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
?>
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
<?php 
}
?>
// Search functionlity 
$(document).ready(function() {
    const searchBtn = document.getElementById('searchBtn');
    const searchContainer = document.getElementById('searchContainer');
    const searchBox = document.getElementById('searchBox');
    const searchContainerCloseBtn = document.getElementById('closeBtn');
    const body = document.body;

    const toggleSearchContainer = (isVisible) => {
        const method = isVisible ? 'remove' : 'add';
        searchContainer.classList[method]('hidden');
        body.classList[isVisible ? 'add' : 'remove']('search-overlay');

        if (isVisible) {
            setTimeout(() => {
                searchBox.classList.add('show');
            }, 10);
        } else {
            searchBox.classList.remove('show');
        }
    };

    searchBtn.addEventListener('click', () => toggleSearchContainer(true));
    searchContainerCloseBtn.addEventListener('click', () => toggleSearchContainer(false));
    document.addEventListener('click', (event) => {
        if (!searchContainer.classList.contains('hidden') && !searchBox.contains(event.target) && !
            searchBtn.contains(event.target)) {
            toggleSearchContainer(false);
        }
    });

    function debounce(func, delay) {
        let debounceTimer;
        return function(...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function searchContent(query) {
        if (query.trim() === "") {
            $(".search_result_container").empty().hide();
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

                $(".search_result_container").empty();

                if (music.length > 0) {
                    $(".search_result_container").append(
                        `<div class="search_result_music_container flex flex-col gap-1">  
                            <h4 class="px-2 text-sm"> Songs </h4>`
                    );
                    music.forEach((result) => {
                        const redirectUrl =
                            `<?= (ROUTE === 'index') ? './routes/' : './' ?>music.php?music_id=${result.id}`;
                        $(".search_result_music_container").append(`
                                <div onclick="window.location.href='${redirectUrl}'" class="search_result border border-[#563A9C] transition duration-300 cursor-pointer hover:bg-[#563A9C] rounded-lg flex items-center p-2">
                                    <img src="<?= (ROUTE === 'index') ? './assets/media/images/' : '../assets/media/images/' ?>${result.cover_image}" class="search_result_image size-20 rounded-xl object-cover" alt="${result.title}">
                                    <div class="search_result_body mx-2 overflow-hidden w-full">
                                        <div class="search_result_heading flex flex-col">
                                            <div class="search_result_subhead flex items-center justify-between">
                                                <p class="text-[8px] text-gray-200">TITLE</p>
                                                <p class="text-xs font-bold text-[#FAEF5D]">SONG</p>
                                            </div>
                                            <h3 class="text-white text-sm pl-1 truncate">${result.title}</h3>
                                        </div>
                                        <div class="search_result_subheading flex flex-nowrap w-full items-end gap-1 mt-1 text-xs">
                                            <div class="flex flex-col">
                                                <span class="text-[10px] pl-2">Artist</span>
                                                <span class="py-1 px-2 bg-[#49108B] text-xs rounded-xl truncate">${result.artist_name}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[10px] pl-2">Album</span>
                                                <span class="py-1 px-2 bg-[#49108B] text-xs rounded-xl truncate">${result.album_name}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                    });
                    $(".search_result_container").append('</div>');
                }


                if (videos.length > 0) {
                    $(".search_result_container").append(
                        `<div class="search_result_video_container flex flex-col gap-1"> 
                            <h4 class="px-2 text-sm">Videos</h4>`
                    );
                    videos.forEach((result) => {
                        const redirectUrl =
                            `<?= (ROUTE === 'index') ? './routes/' : './' ?>video.php?video_id=${result.id}`;
                        $(".search_result_video_container").append(`
                            <div onclick="window.location.href='${redirectUrl}'" class="search_result border border-[#563A9C] transition duration-300 cursor-pointer hover:bg-[#563A9C] rounded-lg flex items-center p-2">
                                <img src="<?= (ROUTE === 'index') ? './assets/media/images/' : '../assets/media/images/' ?>${result.cover_image}" 
                                    class="search_result_image size-20 rounded-xl object-cover" alt="${result.title}">
                                <div class="search_result_body mx-2 overflow-hidden w-full">
                                    <div class="search_result_heading flex flex-col">
                                        <div class="search_result_subhead flex items-center justify-between">
                                            <p class="text-[8px] text-gray-200">TITLE</p>
                                            <p class="text-xs font-bold text-[#98E4FF]">VIDEO</p>
                                        </div>
                                        <h3 class="text-white text-sm pl-1 truncate">${result.title}</h3>
                                    </div>
                                    <div class="search_result_subheading flex flex-nowrap w-full items-end gap-1 mt-1 text-xs">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] pl-2">Language</span>
                                            <span class="py-1 px-2 bg-[#49108B] text-xs rounded-xl truncate">${result.language}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] pl-2">Genre</span>
                                            <span class="py-1 px-2 bg-[#49108B] text-xs rounded-xl truncate">${result.genre_name}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                    $(".search_result_container").append('</div>');
                }

                if (music.length === 0 && videos.length === 0) {
                    $(".search_result_container").append(
                        `<div class="text-gray-300 p-2 text-sm text-center">No music or videos found</div>`
                    );
                }

                $(".search_result_container").show();
            },
            error: function() {
                $(".search_result_container")
                    .empty()
                    .append(
                        `<div class="text-red-500 p-2 text-sm text-center">Error fetching results</div>`
                    )
                    .show();
            },
        });
    }


    $("#searchInput").on(
        "input",
        debounce(function() {
            const query = $(this).val();
            searchContent(query);
        }, 300)
    );
});
</script>

</body>

</html>