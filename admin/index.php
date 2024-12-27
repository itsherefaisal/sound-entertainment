<?php 

define("ROUTE", "index");
include_once("./includes/header.admin.php");

?>

<main class="w-full h-full bg-[#160F30] p-4 text-white">
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 my-6">
        <div class="bg-[#202040] p-4 rounded-lg shadow">
            <h2 class="text-sm font-semibold">Total Users</h2>
            <p class="total-users text-4xl font-bold mt-2">0</p>
        </div>

        <div class="bg-[#202040] p-4 rounded-lg shadow">
            <h2 class="text-sm font-semibold">Total Videos</h2>
            <p class="total-videos text-4xl font-bold mt-2">0</p>
        </div>

        <div class="bg-[#202040] p-4 rounded-lg shadow">
            <h2 class="text-sm font-semibold">Total Songs</h2>
            <p class="total-songs text-4xl font-bold mt-2">0</p>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#202040] p-4 rounded-lg shadow">
            <h2 class="text-md font-semibold">Latest Movie Uploads</h2>
            <ul class="latest-videos mt-4">
            </ul>
        </div>

        <div class="bg-[#202040] p-4 rounded-lg shadow">
            <h2 class="text-md font-semibold">Latest Songs</h2>
            <ul class="latest-songs mt-4">
            </ul>
        </div>
    </section>
</main>


</section>

<script>
$(document).ready(function() {
    $.ajax({
        url: "./controller/dashboard.controller.php",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $(".total-users").text(data.totalUsers);
            $(".total-videos").text(data.totalVideos);
            $(".total-songs").text(data.totalSongs);

            const latestVideosList = $(".latest-videos");
            latestVideosList.empty();
            if (data.latestVideos.length > 0) {
                data.latestVideos.forEach(video => {
                    latestVideosList.append(`
                        <li class="flex justify-between py-2 border-b border-gray-600">
                            <span>${video.title} (${video.language})</span>
                            <span class="text-sm text-gray-400">Uploaded at ${new Date(video.created_at).toLocaleDateString()}</span>
                        </li>
                    `);
                });
            } else {
                latestVideosList.append(
                    `<li class="text-gray-400 text-sm text-center py-5">No latest videos available.</li>`
                    );
            }

            const latestSongsList = $(".latest-songs");
            latestSongsList.empty();
            if (data.latestSongs.length > 0) {
                data.latestSongs.forEach(song => {
                    latestSongsList.append(`
                        <li class="flex justify-between py-2 border-b border-gray-600">
                            <span>${song.title} - ${song.artist}</span>
                            <span class="text-sm text-gray-400">Uploaded at ${new Date(song.created_at).toLocaleDateString()}</span>
                        </li>
                    `);
                });
            } else {
                latestSongsList.append(
                    `<li class="text-gray-400 text-sm text-center py-5">No latest songs available.</li>`
                    );
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
});
</script>

</body>

</html>