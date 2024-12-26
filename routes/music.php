<?php

define("ROUTE", "music");
include_once("../includes/header.php");

if (isset($_GET['music_id']) && is_numeric($_GET['music_id'])) {
    $music_id = $_GET['music_id'];

// Query to fetch music details, album details, and artist details
$query = "
    SELECT m.music_id, m.title, m.year, m.language, m.cover_image AS music_cover, 
           a.name AS artist_name, a.image_url AS artist_image, al.name AS album_name, 
           al.cover_image AS album_cover, m.file_path,
           al.album_id
    FROM music m
    JOIN albums al ON m.album_id = al.album_id
    JOIN artists a ON m.artist_id = a.artist_id
    WHERE m.music_id = $music_id
";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $music = mysqli_fetch_assoc($result);
    $title = $music['title'];
    $year = $music['year'];
    $language = $music['language'];
    $album_id = $music['album_id'];
    $artist_name = $music['artist_name'];
    $artist_image = $music['artist_image'];
    $album_name = $music['album_name'];
    $album_cover = $music['album_cover'];
    $music_cover = $music['music_cover'];
    $file_path = $music['file_path'];
} else {
    echo "Music not found.";
    exit;
}

} else {
    echo "Invalid music ID.";
    exit;
}
?>


<section class="min-h-[90vh] flex flex-col items-center ">

    <div class="relative w-full h-36 bg-white rounded-lg shadow-lg overflow-hidde mb-12">
        <div class="absolute inset-0 rounded-lg overflow-hidden bg-red-200">
            <img src="..<?= $music_cover?>" 
                alt="banner" class="w-full">
            <div class="absolute inset-0 backdrop backdrop-blur-10 bg-gradient-to-b from-transparent to-black">

            </div>
        </div>
        <div class="absolute flex space-x-6 transform translate-x-6 translate-y-8">
            <div class="w-36 h-36 rounded-lg shadow-lg overflow-hidden">
                <img src="..<?= $artist_image?>" class="w-full h-full object-cover" alt="Artist">
            </div>
            <div class="text-white pt-12">
                <h3 class="font-bold"><?= $album_name?></h3>
                <div class="text-sm opacity-60"><?= $artist_name?></div>
                <div class="mt-8 text-gray-400">
                    <div class="flex items-center space-x-2 text-xs">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path
                                d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z">
                            </path>
                        </svg>
                        <span>Easy listening</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="music-container w-full flex px-8">
        <div id="audio-player" class="w-full bg-[#17153B] rounded-lg shadow-lg overflow-hidden">
            <div class="relative">
                <img src="..<?= $music_cover?>" class="object-cover w-full h-[300px]">
                <div
                    class="absolute p-4 inset-0 flex flex-col justify-end bg-gradient-to-b from-transparent to-gray-900 text-white">
                    <h3 class="font-bold text-lg">Song: <?= $title?></h3>
                    <span class="opacity-70">Artist: <?= $artist_name?></span>
                </div>
            </div>
            <div id="seek-bar" class="relative h-1 bg-[#C8ACD6] cursor-pointer">
                <div id="progress-bar" class="absolute h-full w-0 bg-[#433D8B] flex items-center justify-end">
                    <div class="rounded-full w-3 h-3 border border-white bg-[#2E236C] shadow"></div>
                </div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-[#C8ACD6] px-4 py-3">
                <div id="current-time">0:00</div>
                <div class="flex space-x-3 p-2">
                    <button id="play-btn"
                        class="rounded-full w-8 h-8 flex items-center justify-center focus:outline-none">
                        <svg id="play-icon" class="w-5 h-5 text-[#C8ACD6]" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <svg id="pause-icon" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="6" y="4" width="4" height="16"></rect>
                            <rect x="14" y="4" width="4" height="16"></rect>
                        </svg>
                    </button>
                </div>
                <div id="total-duration">0:00</div>
            </div>
            <div class="flex items-center space-x-2 px-4 w-2/4 pb-4">
                <div id="volume-icon" class="w-6 h-6 text-[#C8ACD6]">
                </div>
                <div id="volume-bar" class="relative h-1 bg-[#C8ACD6] flex-grow cursor-pointer">
                    <div id="volume-progress" class="absolute h-full w-1/2 bg-[#433D8B] flex items-center justify-end">
                        <div class="rounded-full w-3 h-3 border border-white bg-[#2E236C] shadow"></div>
                    </div>
                </div>
            </div>

            <audio id="audio" src="..<?= $file_path?>"></audio>
        </div>

        <?php
$current_title = $title;

$related_songs_query = "
    SELECT m.music_id, m.title, m.year, m.language,
           a.name AS artist_name
    FROM music m
    JOIN artists a ON m.artist_id = a.artist_id
    WHERE (m.album_id = $album_id OR m.title LIKE '%$current_title%') 
      AND m.music_id != $music_id
    LIMIT 10
";

$related_songs_result = mysqli_query($conn, $related_songs_query);
if ($related_songs_result && mysqli_num_rows($related_songs_result) > 0) {
?>
    <ul class="related-songs w-full text-xs sm:text-base px-8 divide-y space-y-3 cursor-default">
    <h3 class="px-3">More related songs.</h3>
<?php 

while ($song = mysqli_fetch_assoc($related_songs_result)) {
$song_id = $song['music_id'];
$title = $song['title'];
$artist_name = $song['artist_name'];

?>
<li class="flex w-full bg-slate-200 px-2 py-2 rounded-xl text-black justify-between items-center space-x-3">
    <button class="p-2 transition duration-300 rounded-xl hover:bg-[#17153B] group focus:outline-none">
        <svg class="size-6 transition duration-300 group-hover:text-slate-200" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <polygon points="5 3 19 12 5 21 5 3"></polygon>
        </svg>
    </button>
    <div class="flex-1 text-gray-600">
        <?= $artist_name ?> - <?= $title ?>
    </div>
    <div class="text-xs text-gray-400">
        Duration
    </div>
</li>
<?php
}
    echo '</ul>';
} else {
?>
    <ul
        class="related-songs w-full flex items-center justify-center text-xs sm:text-base px-8 divide-y space-y-3 cursor-default">
        <h3 class="px-3 text-gray-400">No related songs found.</h3>
    </ul>
<?php
}
?>

            <!-- <ul class="related songs w-full text-xs sm:text-base px-8 divide-y space-y-3 cursor-default">
            <h3 class="px-3">More</h3>
            <li class="flex w-full bg-slate-200 px-2 py-2 rounded-xl text-black justify-between items-center space-x-3">
                <button class="p-2 transtion duration-300 rounded-xl hover:bg-[#17153B] group focus:outline-none">
                    <svg class="size-6 transtion duration-300 group-hover:text-slate-200" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                </button>
                <div class="flex-1 text-gray-600">
                    Artist - Title
                </div>
                <div class="text-xs text-gray-400">
                    2:58
                </div>
            </li>
        </ul> -->
    </div>


</section>

<?php

        include_once('../includes/footer.php');
      
      ?>



<script>
$(document).ready(function() {

    // code for profile show hide 
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
    const audio = $('#audio')[0];
    const playBtn = $('#play-btn');
    const playIcon = $('#play-icon');
    const pauseIcon = $('#pause-icon');
    const progressBar = $('#progress-bar');
    const currentTimeDisplay = $('#current-time');
    const totalDurationDisplay = $('#total-duration');
    const volumeBar = $('#volume-bar');
    const volumeProgress = $('#volume-progress');
    const volumeIcon = $('#volume-icon');
    const muteBtn = $('#mute-btn');

    let isMuted = false;
    let lastVolume = 0.5;

    const svgHigh = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
    <path d="M6.60282 10.0001L10 7.22056V16.7796L6.60282 14.0001H3V10.0001H6.60282ZM2 16.0001H5.88889L11.1834 20.3319C11.2727 20.405 11.3846 20.4449 11.5 20.4449C11.7761 20.4449 12 20.2211 12 19.9449V4.05519C12 3.93977 11.9601 3.8279 11.887 3.73857C11.7121 3.52485 11.3971 3.49335 11.1834 3.66821L5.88889 8.00007H2C1.44772 8.00007 1 8.44778 1 9.00007V15.0001C1 15.5524 1.44772 16.0001 2 16.0001ZM23 12C23 15.292 21.5539 18.2463 19.2622 20.2622L17.8445 18.8444C19.7758 17.1937 21 14.7398 21 12C21 9.26016 19.7758 6.80629 17.8445 5.15557L19.2622 3.73779C21.5539 5.75368 23 8.70795 23 12ZM18 12C18 10.0883 17.106 8.38548 15.7133 7.28673L14.2842 8.71584C15.3213 9.43855 16 10.64 16 12C16 13.36 15.3213 14.5614 14.2842 15.2841L15.7133 16.7132C17.106 15.6145 18 13.9116 18 12Z"></path>
</svg>`;
    const svgMedium = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
    <path d="M13 7.22056L9.60282 10.0001H6V14.0001H9.60282L13 16.7796V7.22056ZM8.88889 16.0001H5C4.44772 16.0001 4 15.5524 4 15.0001V9.00007C4 8.44778 4.44772 8.00007 5 8.00007H8.88889L14.1834 3.66821C14.3971 3.49335 14.7121 3.52485 14.887 3.73857C14.9601 3.8279 15 3.93977 15 4.05519V19.9449C15 20.2211 14.7761 20.4449 14.5 20.4449C14.3846 20.4449 14.2727 20.405 14.1834 20.3319L8.88889 16.0001ZM18.8631 16.5911L17.4411 15.1691C18.3892 14.4376 19 13.2902 19 12.0001C19 10.5697 18.2493 9.31476 17.1203 8.60766L18.5589 7.16906C20.0396 8.26166 21 10.0187 21 12.0001C21 13.8422 20.1698 15.4905 18.8631 16.5911Z"></path>
</svg>`;
    const svgMuted = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
    <path d="M10 7.22056L6.60282 10.0001H3V14.0001H6.60282L10 16.7796V7.22056ZM5.88889 16.0001H2C1.44772 16.0001 1 15.5524 1 15.0001V9.00007C1 8.44778 1.44772 8.00007 2 8.00007H5.88889L11.1834 3.66821C11.3971 3.49335 11.7121 3.52485 11.887 3.73857C11.9601 3.8279 12 3.93977 12 4.05519V19.9449C12 20.2211 11.7761 20.4449 11.5 20.4449C11.3846 20.4449 11.2727 20.405 11.1834 20.3319L5.88889 16.0001ZM20.4142 12.0001L23.9497 15.5356L22.5355 16.9498L19 13.4143L15.4645 16.9498L14.0503 15.5356L17.5858 12.0001L14.0503 8.46454L15.4645 7.05032L19 10.5859L22.5355 7.05032L23.9497 8.46454L20.4142 12.0001Z"></path>
</svg>`;

    function updateVolumeIcon(volume) {
        if (isMuted || volume === 0) {
            volumeIcon.html(svgMuted);
        } else if (volume > 0.7) {
            volumeIcon.html(svgHigh);
        } else {
            volumeIcon.html(svgMedium);
        }
    }
    // set 50% volume at start 
    audio.volume = 0.5;
    updateVolumeIcon(0.5);

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' + secs : secs}`;
    }

    // Load metadata and set total duration
    audio.addEventListener('loadedmetadata', () => {
        totalDurationDisplay.text(formatTime(audio.duration));
    });

    // Play/Pause toggle
    playBtn.on('click', () => {
        if (audio.paused) {
            audio.play();
            playIcon.addClass('hidden');
            pauseIcon.removeClass('hidden');
        } else {
            audio.pause();
            playIcon.removeClass('hidden');
            pauseIcon.addClass('hidden');
        }
    });

    // Update progress bar and current time
    audio.addEventListener('timeupdate', () => {
        const progress = (audio.currentTime / audio.duration) * 100;
        progressBar.css('width', `${progress}%`);
        currentTimeDisplay.text(formatTime(audio.currentTime));
    });

    // Seek functionality
    $('#seek-bar').on('click', function(e) {
        const offsetX = e.offsetX;
        const totalWidth = $(this).width();
        const seekTime = (offsetX / totalWidth) * audio.duration;
        audio.currentTime = seekTime;
    });

    // Handle volume changes
    volumeBar.on('mousedown', (e) => {
        const updateVolume = (e) => {
            const offsetX = e.pageX - volumeBar.offset().left;
            const totalWidth = volumeBar.width();
            const volume = Math.min(Math.max(offsetX / totalWidth, 0), 1);
            audio.volume = volume;
            volumeProgress.css('width', `${volume * 100}%`);
            updateVolumeIcon(volume);
            isMuted = false;
        };

        $(document).on('mousemove', updateVolume);
        $(document).on('mouseup', () => {
            $(document).off('mousemove', updateVolume);
        });

        updateVolume(e);
    });

});
</script>
</body>

</html>