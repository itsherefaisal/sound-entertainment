<?php

define("ROUTE", "videos");
include_once("../includes/header.php");

?>

<section id="latest-videos" class="px-6 py-4 my-4 min-h-[300px]">
    <div class="video-top">
        <h1 class="text-2xl font-bold text-center my-4">Videos | Movies</h1>
    </div>

    <div class="video-container my-10 min-h-[26vh] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
        id="video-list">
        <!-- video Card -->
        <!-- <div class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
                <div class="video-img h-[500px] lg:h-[340px] relative">
                    <span class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                    <img src="../assets/images/video-card-1.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="video-body w-full p-2">
                    <p class="truncate overflow-hidden text-lg mt-2">Pathan</p>
                    <p class="overflow-hidden text-gray-200 text-xs mb-2">A Pakistani general hires a private terror outfit to conduct attacks in India while Pathaan, an Indian secret agent, is on a mission to form a special unit.
                    </p>
                    <p class="video-artist text-xs text-gray-300"><b>Genre:</b> Comedy, Action</p>
                    <p class="video-artist text-xs text-gray-300"><b>Language:</b> English, Hindi</p>
                </div>
            </div> -->
    </div>
    <div class="pagination-controls flex justify-center mt-6">
        <button class="prev-page bg-gray-200 text-gray-700 px-3 py-1 mx-2 rounded-md disabled:opacity-50"
            disabled>Previous</button>
        <button class="next-page bg-gray-200 text-gray-700 px-3 py-1 mx-2 rounded-md disabled:opacity-50"
            disabled>Next</button>
    </div>
</section>

<?php

include_once('../includes/footer.php');

?>

<script>
$(document).ready(function() {
    $('#dropdown-button').click(function() {
        $('#dropdown').toggleClass('hidden');
    });

    let currentPage = 1;

    function loadVideos(page) {
        $.ajax({
            url: "../controller/fetch_video.controller.php",
            type: "GET",
            data: {
                page: page
            },
            success: function(response) {
                const {
                    videos,
                    hasNext,
                    hasPrev
                } = response;

                $("#video-list").empty();
                videos.forEach(video => {
                    $("#video-list").append(`
                        <div class="video-card w-full rounded-xl overflow-hidden">
                            <div class="video-img h-[500px] lg:h-[330px] relative group">
                                <div onclick=\"window.location.href = './video.php?video_id=${video.video_id}'\" class="overlay-play absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-28 rounded-full transition duration-300 cursor-pointer hover:text-red-500" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1.378-13.586c-.065-.044-.142-.067-.221-.067-.221 0-.4.18-.4.401v6.505c0 .08.023.157.067.223.123.183.371.233.555.111l4.878-3.252c.043-.029.081-.067.111-.111.123-.183.073-.432-.111-.555L10.622 8.414z"></path>
                                    </svg>
                                </div>
                                <span class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">${video.year}</span>
                                <img src="../assets/media/images/${video.cover_image}" class="w-full h-full object-cover" alt="${video.title}">
                            </div>
                            <div class="video-body w-full p-2">
                                <p class="truncate overflow-hidden">${video.title}</p>
                                <p class="text-xs text-gray-300"><b>Genre:</b> ${video.genre_name}</p>
                                <p class="text-xs text-gray-300"><b>Language:</b> ${video.language}</p>
                            </div>
                        </div>
                    `);
                });

                $(".prev-page").prop("disabled", !hasPrev);
                $(".next-page").prop("disabled", !hasNext);
            },
            error: function() {
                alert("An error occurred while fetching video data.");
            }
        });
    }

    $(".prev-page").click(function() {
        if (currentPage > 1) {
            currentPage--;
            loadVideos(currentPage);
        }
    });

    $(".next-page").click(function() {
        currentPage++;
        loadVideos(currentPage);
    });

    loadVideos(currentPage);
});
</script>
</body>

</html>