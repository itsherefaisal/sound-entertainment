<?php

define("ROUTE", "categories");
include_once("../includes/header.php");
include_once("../config.php");

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$data = [];

switch ($type) {
    case 'music':
        switch ($filter) {
            case 'album':
                $query = "SELECT a.album_id, a.name AS album_name, a.cover_image AS album_cover, 
                                 m.music_id as music_id, m.title AS music_title, m.cover_image as music_cover, m.year
                          FROM albums a
                          INNER JOIN music m ON m.album_id = a.album_id
                          ORDER BY a.name, m.title";
                break;
            case 'artist':
                $query = "SELECT ar.artist_id, ar.name AS artist_name, ar.image_url AS artist_photo,
                                 m.music_id as music_id, m.title AS music_title, m.cover_image as music_cover, m.year
                          FROM artists ar
                          INNER JOIN music m ON m.artist_id = ar.artist_id
                          ORDER BY ar.name, m.title";
                break;
            case 'year':
                $query = "SELECT m.year, m.music_id as music_id, m.title AS music_title, m.cover_image as music_cover, a.name AS album_name, 
                                 a.cover_image AS album_cover
                          FROM music m
                          INNER JOIN albums a ON m.album_id = a.album_id
                          ORDER BY m.year, m.title";
                break;
            default:
                $query = '';
        }
        break;

    case 'video':
        switch ($filter) {
            case 'year':
                $query = "SELECT v.year, v.video_id as video_id, v.title AS video_title, v.cover_image AS video_cover
                          FROM videos v
                          ORDER BY v.year, v.title";
                break;
            case 'genre':
                $query = "SELECT g.genre_id, g.name AS genre_name, v.video_id as video_id, v.title AS video_title, 
                                 v.cover_image AS video_cover, v.year
                          FROM genres g
                          INNER JOIN videos v ON v.genre_id = g.genre_id
                          ORDER BY g.name, v.title";
                break;
            case 'language':
                $query = "SELECT v.language, v.video_id as video_id, v.title AS video_title, 
                                 v.cover_image AS video_cover, v.year
                          FROM videos v
                          ORDER BY v.language, v.title";
                break;
            default:
                $query = '';
        }
        break;

    default:
        $query = '';
}

if (!empty($query)) {
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

// Group data by the chosen filter
$groupedData = [];
if (!empty($data)) {
    foreach ($data as $item) {
        switch ($filter) {
            case 'album':
                $groupedData[$item['album_name']][] = $item;
                break;
            case 'artist':
                $groupedData[$item['artist_name']][] = $item;
                break;
            case 'year':
                $groupedData[$item['year']][] = $item;
                break;
            case 'genre':
                $groupedData[$item['genre_name']][] = $item;
                break;
            case 'language':
                $groupedData[$item['language']][] = $item;
                break;
        }
    }
}

?>

<section id="filtered-content" class="px-6 py-4 my-4 min-h-[300px]">
    <div class="content-top">
        <h1 class="text-2xl font-bold text-center my-4">
            <?= ucfirst($type) . " Categorized by " . ucfirst($filter); ?>
        </h1>
    </div>
    <div class="content-container">
        <?php if (!empty($groupedData)) : ?>
        <?php foreach ($groupedData as $groupName => $items) : ?>
        <div class="group-container my-10">
            <h1 class="text-xl px-8 border-b py-4"><?= $groupName; ?></h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 my-4">
                <?php foreach ($items as $item) : ?>
                <div class="content-card w-full"
                    onclick="window.location.href ='<?= $type == 'music' ? './music.php?music_id='.$item['music_id'] : './video.php?video_id='.$item['video_id'] ?>'">
                    <div class="content-img h-[300px] relative group">
                        <?php 
                        if ($filter == "artist"){
                        ?>
                        <div class="content-artist-img w-full h-full relative group">
                            <div
                                class='overlay-play absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full'>
                                <button onclick="window.location.href = './routes/music.php?music_id=$music_id'"
                                    class='bg-transparent outline-none'>
                                    <svg xmlns='http://www.w3.org/2000/svg'
                                        class='size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500'
                                        viewBox='0 0 24 24' fill='currentColor'>
                                        <path
                                            d='M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z'>
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <img src="../assets/media/images/<?= $item['album_cover'] ?? $item['video_cover'] ?? $item['artist_photo'] ?? 'placeholder.jpg'; ?>"
                                class="absolute right-0 bottom-0 w-[100px] h-[100px] rounded-l-xl rounded-t-xl object-cover"
                                alt="content-img">
                            <img src="../assets/media/images/<?= $item['music_cover'] ?>"
                                class="w-full h-full object-cover" alt="content-img">
                        </div>
                        <?php } else { ?>
                        <div class="content-img w-full h-full relative group">
                            <div
                                class='overlay-play absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full'>
                                <button onclick="window.location.href = './routes/music.php?music_id=$music_id'"
                                    class='bg-transparent outline-none'>
                                    <svg xmlns='http://www.w3.org/2000/svg'
                                        class='size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500'
                                        viewBox='0 0 24 24' fill='currentColor'>
                                        <path
                                            d='M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z'>
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <img src="../assets/media/images/<?= $type == "music" ? $item['music_cover']: $item['video_cover'] ?>"
                                class="w-full h-full object-cover" alt="content-img">
                        </div>

                        <?php }?>
                        <span
                            class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">
                            <?= $item['year'] ?? ''; ?>
                        </span>
                    </div>
                    <div class="content-body w-full p-2">
                        <p class="truncate overflow-hidden"><?= $item['music_title'] ?? $item['video_title']; ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <p class="text-center text-gray-500 min-h-screen py-32">No data found for the selected filter.</p>
        <?php endif; ?>
    </div>
</section>

<?php
include_once('../includes/footer.php');
?>


</body>

</html>