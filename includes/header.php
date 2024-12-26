<?php 
session_start();

if (ROUTE === "index") {
    include_once("./config.php");
} else {
    include_once("../config.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sound Hub | <?= ROUTE?></title>

    <script
        src="<?= (ROUTE === 'index') ? './frameworks/jquery/jquery.min.js' : '../frameworks/jquery/jquery.min.js'?>">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    .dropdown-menu {
        transition: all 0.3s ease-in-out;
    }

    input:-webkit-autofill {
        background-color: transparent !important;
        -webkit-text-fill-color: white !important;
        box-shadow: none !important;
        transition: background-color 5000s ease-in-out 0s, -webkit-text-fill-color 5000s ease-in-out 0s;
    }
    </style>

    <?= (ROUTE === 'index') ? '
    <!-- slider script  -->
    <script>
        var cont = 0;

        function loopSlider() {
            var xx = setInterval(function () {
                switch (cont) {
                    case 0: {
                        $("#slider-1").fadeOut(400);
                        $("#slider-2").delay(200).fadeIn(200);
                        $("#sButton1").removeClass("bg-gray-200");
                        $("#sButton2").addClass("bg-gray-200");
                        cont = 1;
                        break;
                    }
                    case 1:
                        {
                            $("#slider-2").fadeOut(400);
                            $("#slider-1").delay(200).fadeIn(200);
                            $("#sButton2").removeClass("bg-gray-200");
                            $("#sButton1").addClass("bg-gray-200");
                            cont = 0;
                            break;
                        }
                }
            }, 8000);
        }

        function reinitLoop(time) {
            clearInterval(xx);
            setTimeout(loopSlider(), time);
        }

        function sliderButton1() {

            $("#slider-2").fadeOut(300);
            $("#slider-1").delay(300).fadeIn(300);
            $("#sButton2").removeClass("bg-gray-200");
            $("#sButton1").addClass("bg-gray-200");
            reinitLoop(6000);
            cont = 0

        }
        function sliderButton2() {
            $("#slider-1").fadeOut(300);
            $("#slider-2").delay(300).fadeIn(300);
            $("#sButton1").removeClass("bg-gray-200");
            $("#sButton2").addClass("bg-gray-200");
            reinitLoop(6000);
            cont = 1

        }
        $(window).ready(function () {
            $("#slider-2").hide();
            $("#sButton1").addClass("bg-gray-200");
            loopSlider();
        });
    </script>
     ':' ';
    ?>
</head>

<body class="bg-[#160F30] text-white">
    <header>
        <nav class="bg-[#202040] text-white px-6 py-4 flex justify-between items-center">
            <a href="<?= (ROUTE === "index") ? './index.php' : '../index.php'; ?>"
                class="flex items-center gap-3 text-xl font-bold">
                <img src="<?= (ROUTE === "index") ? './assets/images/sound.png': '../assets/images/sound.png'; ?>"
                    alt="Logo" class="fluid-responsive size-8">
                <span>Sound</span>
            </a>

            <div class="hidden md:flex space-x-6 items-center">
                <a href="<?= (ROUTE === "index") ? './index.php' : '../index.php'; ?>"
                    class="text-sm text-gray-300 hover:text-white">Home</a>
                <a href="<?= (ROUTE === "index") ? './routes/musics.php' : './musics.php'; ?>"
                    class="text-sm text-gray-300 hover:text-white">Music</a>
                <a href="<?= (ROUTE === "index") ? './routes/videos.php' : './videos.php'; ?>"
                    class="text-sm text-gray-300 hover:text-white">Videos</a>

                <div class="relative group">
                    <button
                        class="flex items-center text-sm text-gray-300 hover:text-white  group-hover:text-white focus:outline-none">Categories
                        <svg id="cate-dropdown-i" xmlns="http://www.w3.org/2000/svg"
                            class="size-6 transition duration-300 group-hover:rotate-180" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 11.8284L9.17154 14.6569L7.75732 13.2426L12 9L16.2426 13.2426L14.8284 14.6569L12 11.8284Z">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown"
                        class="absolute left-0 p-2 py-2 hidden bg-[#17153B] text-white rounded shadow-lg dropdown-menu group-hover:flex flex-col z-10">
                        <div class="music-cata-container flex flex-col py-2 pt-4 px-4">
                            <h1 class=" border-b py-2">Music</h1>
                            <div class="music-cata flex my-2">
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=Album&type=music' : './categories.php?filter=album'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Album</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=Artist&type=music' : './categories.php?filter=artist'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Artist</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=Year&type=music' : './categories.php?filter=year'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Year</a>
                            </div>
                        </div>
                        <div class="movie-cata-container flex flex-col py-2 px-4">
                            <h1 class=" border-b py-2">Movie</h1>
                            <div class="movie-cata flex my-2">
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=Year&type=video' : './categories.php?filter=year'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Year</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=Genre&type=video' : './categories.php?filter=genre'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Genre</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=Language&type=video' : './categories.php?filter=language'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Language</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <label for="search-bar"
                class="hidden md:flex items-center border border-gray-500 cursor-text pl-3 bg-[#17153B] text-white rounded">
                <input type="text" placeholder="Search music or videos..." id="search-bar"
                    class="text-xs text-gray-300 w-44 bg-transparent outline-none border-none">
                <button class=" text-sm text-gray-400 size-9 p-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z">
                        </path>
                    </svg>
                </button>
            </label>

            <div class="flex space-x-2 items-center">
                <?php 
                if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
                ?>
                <span class="text-sm">Welcome, <?= $_SESSION['user_name']; ?></span>
                <div class="relative group">
                    <button
                        class="flex border border-gray-500 group-hover:border-b-transparent transition duration-400 items-center bg-[#17153B] pt-1 px-1 overflow-hidden size-10 rounded-full group-hover:rounded-b-none hover:text-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-mb-2 text-[#C8ACD6] w-full h-full"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown"
                        class="absolute right-0 p-2 py-2 text-sm hidden bg-[#17153B] text-white rounded rounded-r-none shadow-lg dropdown-menu group-hover:block z-10">
                        <button id="show-profile" class="block truncate px-8 py-2 hover:bg-[#2E236C]">My
                            Account</button>
                        <a href="<?= (ROUTE === "index") ? './routes/logout.php' : '../routes/logout.php' ?>" class="block truncate px-8 py-2 hover:bg-[#2E236C]">Logout</a>
                    </div>
                </div>
                <?php 
                } else {
                ?>
                <a href="<?= (ROUTE === "index") ? './routes/login.php':'./login.php'; ?>"
                    class="border-2 text-sm px-6 py-2 rounded transition duration-300 border-transparent hover:border-[#2E236C] bg-[#2E236C] hover:bg-[#433D8B]">Login</a>
                <a href="<?= (ROUTE === "index") ? './routes/register.php"':'./register.php'; ?>"
                    class="border-2 border-[#433D8B] text-sm px-6 py-2 rounded transition duration-300 hover:border-transparent hover:bg-[#2E236C]">Signup</a>
                <?php 
                }
                ?>
            </div>
            <?php 
                if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
            ?>
            <div id="profile-container"
                class="user-profile absolute hidden z-50 bg-gray-500/30 w-screen h-screen top-0 left-0 flex flex-col items-center justify-center">
                <div
                    class="profile bg-[#17153B] min-w-[450px] flex flex-col relative justify-between py-20 rounded-3xl px-6 min-h-[400px]">
                    <button id="close-profile"
                        class="bg-slate-600 hover:bg-slate-700 rounded-md p-1 absolute right-12 top-8">
                        <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-7"
                                fill="currentColor">
                                <path
                                    d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z">
                                </path>
                            </svg></span>
                    </button>
                    <h2 class="text-center text-xl ">Your Profile</h2>
                    <div class="profile-details">
                        <div class="input-row flex items-center gap-2">
                            <div class="w-full">
                                <label for="username" class="relative text-sm text-gray-300 px-2">
                                    username
                                </label>
                                <input type="text" id="username"
                                    class="block rounded-xl bg-transparent w-full text-xs disabled:opacity-75 p-3 border border-gray-200 shadow-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                    placeholder="username" value="<?= $_SESSION['user_name']; ?>" disabled />
                            </div>
                            <div class="w-full">
                                <label for="username" class="relative text-sm text-gray-300 px-2">
                                    address
                                </label>
                                <input type="text" id="address"
                                    class="block rounded-xl bg-transparent w-full text-xs disabled:opacity-75 p-3 border border-gray-200 shadow-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                    placeholder="address" value="<?= $_SESSION['user_address']; ?>" disabled />
                            </div>
                        </div>
                        <div class="input-row flex items-center my-3 gap-2">
                            <div class="w-full">
                                <label for="phone" class="relative text-sm text-gray-300 px-2">
                                    phone
                                </label>
                                <input type="text" id="phone"
                                    class="block rounded-xl bg-transparent w-full text-xs disabled:opacity-75 p-3 border border-gray-200 shadow-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                    placeholder="phone" value="<?= $_SESSION['user_phone']; ?>" disabled />
                            </div>
                            <div class="w-full">
                                <label for="email" class="relative text-sm text-gray-300 px-2">
                                    email
                                </label>
                                <input type="text" id="email"
                                    class="block rounded-xl bg-transparent w-full text-xs disabled:opacity-75 p-3 border border-gray-200 shadow-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                    placeholder="email" value="<?= $_SESSION['user_email']; ?>" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
                
            ?>
        </nav>
        <?= (ROUTE === "index") ? '
        <div class="sliderAx h-auto w-full max-w-container mx-auto">
            <div id="slider-1">
                <div class="bg-cover bg-center flex items-center h-[540px] text-white py-24 px-10 object-fill"
                    style="background-image: url('.'./assets/images/music-2.jpg'.'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                    <div class="md:w-1/2">
                        <p class="font-bold text-sm uppercase">Music</p>
                        <p class="text-3xl font-bold">Listen your favorite music</p>
                        <p class="text-2xl mb-10 leading-none">Anytime, Anywhere</p>
                    </div>
                </div>
                <br>
            </div>

            <div id="slider-2">
                <div class="bg-cover bg-top  flex items-center h-[540px] text-white py-24 px-10 object-fill"
                    style="background-image: url('.'./assets/images/video-1.jpg'.'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                    <div class="md:w-1/2">
                        <p class="font-bold text-sm uppercase">Movie</p>
                        <p class="text-3xl font-bold">Watch your favorite movie</p>
                        <p class="text-2xl mb-10 leading-none">free time enjoyment</p>
                    </div>
                </div>
                <br>
            </div>
        </div>

        <div class="flex justify-between w-12 mx-auto pb-1">
            <button id="sButton1" onclick="sliderButton1()" class="bg-gray-400 rounded-full w-4 pb-2 "></button>
            <button id="sButton2" onclick="sliderButton2() " class="bg-gray-400 rounded-full w-4 p-2"></button>
        </div>
        ' : ''; ?>
    </header>