<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    if (ROUTE === "index") {
        header("Location: ../routes/login.php");
    } else {
        header("Location: ../../../routes/login.php");
    }
    exit();
}

if ($_SESSION['user_role'] !== 'ADMIN') {
    header("Location: ../index.php");
    
    if (ROUTE === "index") {
        header("Location: ../index.php");
    } else {
        header("Location: ../../../index.php");
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sound Hub | <?= ROUTE?></title>

    <script src="<?= ROUTE === "index" ? '../' : '../../../'?>/frameworks/jquery/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#160F30] text-white">
    <header class="admin-header">
        <nav class="bg-[#202040] text-white px-16 py-4 flex items-center">
            <a href="<?= ROUTE === "index" ? '../' : '../../../'?>index.php"
                class="flex items-center gap-3 text-xl font-bold">
                <img src="<?= ROUTE === "index" ? '../' : '../../../'?>assets/images/sound.png" alt="Logo"
                    class="fluid-responsive size-8">
                <span>Sound <span class="text-red-500 text-xs">ADMIN</span></span>
            </a>
        </nav>
    </header>
    <section id="main-body" class="h-[100vh] flex">
        <aside
            class="h-full w-[380px] max-w-[380px] bg-[#1B1833] border-r px-4 py-4 flex flex-col gap-2 overflow-y-auto">
            <?php 
                if (ROUTE != "index") {
                    echo '<button class="bg-blue-600 py-2 rounded-3xl transition duration-200 hover:bg-blue-500" onclick="window.location.href = \'../../index.php\'">Back to Admin Panel</button>';
                }
            ?>
            <ul class="text-[#D4EBF8] tracking-wider font-medium rounded-3xl  p-2 flex flex-col text-sm ">
                <h1 class="border-b mx-2 my-2 py-2 text-md border-gray-400">User</h1>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/user/view.user.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">View
                    all
                    users</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/user/modify.user.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Modify
                    user by id, name</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/user/delete.user.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Deleted
                    user account</a>
            </ul>
            <ul class="text-[#D4EBF8] tracking-wider font-medium rounded-3xl  p-2 flex flex-col text-sm ">
                <h1 class="border-b mx-2 my-2 py-2 text-md border-gray-400">Video</h1>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/video/add.video.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Add
                    new video</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/video/modify.video.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Modify
                    video</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/video/remove.video.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Remove
                    video</a>
            </ul>
            <ul class="text-[#D4EBF8] tracking-wider font-medium rounded-3xl  p-2 flex flex-col text-sm ">
                <h1 class="border-b mx-2 my-2 py-2 text-md border-gray-400">Genre</h1>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/genre/add.genre.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Add
                    new genre</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/genre/modify.genre.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Modify
                    genre by id, name</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/genre/remove.genre.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Remove
                    genre</a>
            </ul>
            <ul class="text-[#D4EBF8] tracking-wider font-medium rounded-3xl  p-2 flex flex-col text-sm ">
                <h1 class="border-b mx-2 my-2 py-2 text-md border-gray-400">Music</h1>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/music/add.music.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Add
                    new music</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/music/modify.music.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Modify
                    music by id, name</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/music/remove.music.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Remove
                    music</a>
            </ul>
            <ul class="text-[#D4EBF8] tracking-wider font-medium rounded-3xl  p-2 flex flex-col text-sm ">
                <h1 class="border-b mx-2 my-2 py-2 text-md border-gray-400">Album</h1>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/album/add.album.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Add
                    new album</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/album/modify.album.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Modify
                    album by id, name</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/album/remove.album.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Remove
                    album</a>
            </ul>
            <ul class="text-[#D4EBF8] tracking-wider font-medium rounded-3xl  p-2 flex flex-col text-sm ">
                <h1 class="border-b mx-2 my-2 py-2 text-md border-gray-400">Artist</h1>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/artist/add.artist.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Add
                    new artist</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/artist/modify.artist.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Modify
                    artist by id, name</a>
                <a href="<?= ROUTE === "index" ? './route' : '..' ?>/artist/remove.artist.php"
                    class="text-xs rounded-md mx-4 px-3 py-2 my-1 transition-all duration-200 hover:bg-[#4B4376]">Remove
                    artist</a>
            </ul>
        </aside>