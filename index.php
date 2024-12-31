<?php

define("ROUTE", "index");
include_once("./includes/header.php");

?>

<section id="latest-music" class="px-6 py-4 my-4 min-h-[300px]">
    <div class="music-top">
        <h1 class="text-xl font-bold">Latest Musics</h1>
    </div>

    <div class="music-bottom my-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 lg:grid-cols-5 gap-6">

        <?php
    $query = "SELECT music_id, title, year, cover_image, is_new, artist_id FROM music ORDER BY created_at DESC LIMIT 5";
    
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $music_id = $row['music_id'];
            $title = $row['title'];
            $year = $row['year'];
            $is_new = $row['is_new'];
            $cover_image = $row['cover_image'];
            $artist_id = $row['artist_id'];
        
            $artist_query = "SELECT name FROM artists WHERE artist_id = $artist_id";
            $artist_result = mysqli_query($conn, $artist_query);
            $artist = mysqli_fetch_assoc($artist_result)['name'];
        
            echo "
            <div class='music-card w-full'>
                <div class='music-img h-[500px] lg:h-[250px] relative group rounded-xl overflow-hidden '>
                    <div class='overlay-play absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full'>
                        <button onclick=\"window.location.href = './routes/music.php?music_id=$music_id'\" class='bg-transparent outline-none'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500' viewBox='0 0 24 24' fill='currentColor'>
                                <path d='M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z'></path>
                            </svg>
                        </button>
                    </div>
                    ". ($is_new ? "<span class='release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-green-700 text-white text-xs'>NEW</span>" : "") ."
                    <span class='release-year absolute top-2 left-2 py-1 px-2 rounded-md bg-black text-white text-xs'>$year</span>
                    <img src='./assets/media/images/$cover_image' class='w-full h-full object-cover' alt='music-img'>
                </div>
                <div class='music-body w-full p-2'>
                    <p class='truncate overflow-hidden'>$title</p>
                    <p class='song-artist text-xs text-gray-300'><b>Artist:</b> $artist</p>
                </div>
            </div>";
        }
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
    ?>

        <!-- Music Card 1 -->
        <!-- <div class="music-card w-full ">
            <div class="music-img h-[500px] lg:h-[250px] relative group">
                <div
                    class="overlay-play  absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                    <button onclick="window.location.href = './routes/music.php'"
                        class="bg-transparent outline-none"><svg xmlns="http://www.w3.org/2000/svg"
                            class="size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z">
                            </path>
                        </svg>
                    </button>
                </div>
                <span
                    class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                <img src="./assets/images/music-card-1.jpg" class="w-full h-full object-cover" alt="music-img">
            </div>
            <div class="music-body w-full p-2">
                <p class="truncate overflow-hidden">Yo Yo Honey Singh 2013 Rap Mix By S&M</p>
                <p class="song-artist text-xs text-gray-300"><b>Artist:</b> Hirdesh Singh</p>
            </div>
        </div> -->

    </div>
</section>
<section id="latest-video" class="px-6 py-8 my-4 min-h-[300px]">
    <div class="video-top">
        <h1 class="text-xl font-bold">Latest Movies</h1>
    </div>

    <div class="video-bottom my-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 lg:grid-cols-5 gap-6">
        <?php
            $query = "
                SELECT 
                    v.video_id, 
                    v.title, 
                    v.year, 
                    v.cover_image, 
                    v.language, 
                    v.description, 
                    g.name AS genre 
                FROM videos v
                JOIN genres g ON v.genre_id = g.genre_id
                ORDER BY v.created_at DESC 
                LIMIT 5
            ";

            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $video_id = $row['video_id'];
                    $title = $row['title'];
                    $year = $row['year'];
                    $cover_image = $row['cover_image'];
                    $language = $row['language'];
                    $description = $row['description'];
                    $genre = $row['genre'];
                
                    echo "
                    <div onclick=\"window.location.href = './routes/video.php?video_id=$video_id'\" class='video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md'>
                        <div class='video-img h-[500px] lg:h-[300px] relative'>
                            <span class='release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs'>$year</span>
                            <img src='./assets/media/images/$cover_image' class='w-full h-full object-cover' alt='video-img'>
                        </div>
                        <div class='video-body w-full p-2'>
                            <p class='truncate overflow-hidden text-lg mt-2'>$title</p>
                            <p class='overflow-hidden text-gray-200 text-xs mb-2'>$description</p>
                            <p class='video-artist text-xs text-gray-300'><b>Genre:</b> $genre</p>
                            <p class='video-artist text-xs text-gray-300'><b>Language:</b> $language</p>
                        </div>
                    </div>";
                }
            } else {
                echo "Error fetching data: " . mysqli_error($conn);
            }
        ?>

        <!-- Video Card 1 -->
        <!-- <div onclick="window.location.href = './routes/video.php'"
            class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
            <div class="video-img h-[500px] lg:h-[300px] relative">
                <span
                    class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                <img src="./assets/images/video-card-1.jpg" class="w-full h-full object-cover" alt="music-img">
            </div>
            <div class="video-body w-full p-2">
                <p class="truncate overflow-hidden text-lg mt-2">Pathan</p>
                <p class="overflow-hidden text-gray-200 text-xs mb-2">A Pakistani general hires a private terror
                    outfit to conduct attacks in India while Pathaan, an Indian secret agent, is on a mission to
                    form a special unit.
                </p>
                <p class="video-artist text-xs text-gray-300"><b>Genre:</b> Comedy, Action</p>
                <p class="video-artist text-xs text-gray-300"><b>Language:</b> English, Hindi</p>
            </div>
        </div> -->
    </div>

</section>
<?php 

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_address']) && isset($_SESSION['user_phone']) && isset($_SESSION['user_role'])) {
    echo " ";
} else {

?>
<section class="overflow-hidden mx-8 bg-cover bg-bottom bg-no-repeat"
    style="background-image: url('./assets/images/music-stage-2.jpg');">
    <div class="bg-black/50 p-8 md:p-12 lg:px-16 lg:py-28">
        <div class="text-center sm:text-left">
            <h2 class="text-2xl font-bold text-white sm:text-2xl md:text-4xl">
                Discover the Latest Songs and Blockbuster Movies
            </h2>

            <p class="hidden max-w-xl text-white/90 md:mt-6 md:block md:text-md">
                Stay in the loop with our collection of newly released songs and movies. Sign up today to get
                notified about the hottest trends in entertainment and be the first to enjoy the latest hits!
            </p>

            <div class="mt-4 sm:mt-6">
                <a href="./routes/register.php"
                    class="inline-block rounded-full bg-[#202040] px-10 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-yellow-400">
                    Sign Up Now
                </a>
            </div>
        </div>
    </div>
</section>
<?php 
}
?>


<?php

    include_once('./includes/footer.php');
    
?>


<script>
$(document).ready(function() {
    $('#dropdown-button').click(function() {
        $('#dropdown').toggleClass('hidden');
    });
});
</script>
</body>

</html>