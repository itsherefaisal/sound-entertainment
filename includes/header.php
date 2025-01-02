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

    .search-overlay {
        overflow: hidden;
    }

    #searchBox {
        width: 90%;
        max-width: 500px;
        border-radius: 0.5rem;
        transform: translateY(50%);
        opacity: 0;
        transition: transform 100ms ease-out, opacity 300ms ease-out;
    }

    #searchBox.show {
        transform: translateY(0);
        opacity: 1;
    }

    @media (max-width: 500px) {
        #searchBox {
            width: 100%;
            height: 100vh;
            margin: 0;
            border-radius: 0;
        }
    }
    </style>
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
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=album&type=music' : './categories.php?filter=album&type=music'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Album</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=artist&type=music' : './categories.php?filter=artist&type=music'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Artist</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=year&type=music' : './categories.php?filter=year&type=music'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Year</a>
                            </div>
                        </div>
                        <div class="movie-cata-container flex flex-col py-2 px-4">
                            <h1 class=" border-b py-2">Video</h1>
                            <div class="movie-cata flex my-2">
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=year&type=video' : './categories.php?filter=year&type=video'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Year</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=genre&type=video' : './categories.php?filter=genre&type=video'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Genre</a>
                                <a href="<?= (ROUTE === "index") ? './routes/categories.php?filter=language&type=video' : './categories.php?filter=language&type=video'; ?>"
                                    class="text-sm flex py-2 px-4 mx-1 min-w-28 truncate rounded-md bg-[#2E236C] transition duration-300 hover:bg-[#17153B] border border-transparent hover:border-gray-200">Language</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button id="searchBtn" class="bg-[#687EFF] transition duration-200 hover:bg-[#80B3FF] text-white p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 stroke-2" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z">
                    </path>
                </svg>
            </button>
            <div id="searchContainer"
                class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div id="searchBox"
                    class="bg-[#1A1A2E] rounded-lg pb-6 shadow-lg overflow-hidden text-[#ffff] h-[400px]">
                    <label for="searchInput"
                        class="relative flex justify-between items-center mb-2 pl-6 pr-20 px-2 group">
                        <input type="text" id="searchInput" name="searchInput" placeholder="Type here to Search..."
                            class="placeholder:text-[#BCCCDC] pt-5 pb-4 pl-4 w-full border-b border-gray-600 transition-focus duration-300 focus:border-gray-200 bg-transparent outline-none"
                            autocomplete="off" />
                        <button id="closeBtn"
                            class="absolute right-5 top-4 my-auto p-1 border-2 border-transparent rounded-full transition duration-200 text-gray-400 hover:border-[#C62300] hover:text-[#D9EAFD] hover:bg-[#C62300]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </label>
                    <div class="search_result_container w-full py-4 px-6 flex flex-col gap-2 overflow-y-auto  flex-grow max-h-[calc(100%-43px)]">
                    </div>
                </div>
            </div>


            <div class="flex space-x-2 items-center">
                <?php 
                    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_address']) && isset($_SESSION['user_phone']) && isset($_SESSION['user_role'])) {
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

                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "ADMIN"): ?>
                        <a href="<?= (ROUTE === "index") ? './admin/' : '../admin/' ?>"
                            class="block truncate px-8 py-2 hover:bg-[#2E236C]">Admin Panel</a>
                        <?php endif; ?>
                        <button id="show-profile" class="block truncate px-8 py-2 hover:bg-[#2E236C]">My
                            Account</button>
                        <a href="<?= (ROUTE === "index") ? './routes/logout.php' : './logout.php' ?>"
                            class="block truncate px-8 py-2 hover:bg-[#2E236C]">Logout</a>
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
                if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_address']) && isset($_SESSION['user_phone']) && isset($_SESSION['user_role'])) {
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
            <div class="relative w-full mx-auto overflow-hidden rounded-lg shadow-lg slider-container">
        <div id="contentSlider" class="flex transition-transform duration-500 ease-in-out">
            <div id="slideMusic"
                class="slide flex-none w-full bg-cover bg-center flex items-center h-[540px] text-white py-24 px-10 relative"
                style="background-image: url('.'./assets/images/music-2.jpg'.'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                        
                <div class="content-wrapper md:w-1/2 z-30">
                    <p class="slide-title font-bold text-sm uppercase">Music</p>
                    <p class="slide-heading text-3xl font-bold">Your Gateway to a World of Music</p>
                    <p class="slide-subheading text-sm mb-10 leading-none">
                        Explore millions of tracks from your favorite artists. Let the rhythm set the tone for your day—anytime,
                        anywhere.
                    </p>
                </div>
            </div>
                        
            <div id="slideVideos"
                class="slide flex-none w-full bg-cover bg-center flex items-center h-[540px] text-white py-24 px-10 relative"
                style="background-image: url('.'./assets/images/video-1.jpg'.'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                        
                <div class="content-wrapper md:w-1/2 z-30">
                    <p class="slide-title font-bold text-sm uppercase">Videos</p>
                    <p class="slide-heading text-3xl font-bold">Unlimited Video Entertainment</p>
                    <p class="slide-subheading text-sm mb-10 leading-none">
                        Discover exclusive videos, trending clips, and cinematic experiences that redefine your leisure time.
                    </p>
                </div>
            </div>
                        
            <div id="slidePodcasts"
                class="slide flex-none w-full bg-cover bg-center flex items-center h-[540px] text-white py-24 px-10 relative"
                style="background-image: url('.'./assets/images/podcast.jpg'.'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                        
                <div class="content-wrapper md:w-1/2 z-30">
                    <p class="slide-title font-bold text-sm uppercase">Podcasts</p>
                    <p class="slide-heading text-3xl font-bold">Inspiring Stories and Conversations</p>
                    <p class="slide-subheading text-sm mb-10 leading-none">
                        Tune into thought-provoking podcasts and enriching stories that spark your curiosity and elevate your
                        moments.
                    </p>
                </div>
            </div>

        </div>

        <div
            class="indicator-wrapper absolute w-full max-w-xl bottom-4 left-1/2 transform -translate-x-1/2 flex items-center justify-center space-x-2 py-2">
            <button id="prevButton"
                class="absolute top-1/2 left-2 -translate-y-1/2 bg-[#85A947] transition-bg duration-300 focus:bg-[#3E7B27] text-white rounded-full flex items-center justify-center shadow-md hover:bg-[#123524]">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M11.8284 12.0005L14.6569 14.8289L13.2426 16.2431L9 12.0005L13.2426 7.75781L14.6569 9.17203L11.8284 12.0005Z">
                    </path>
                </svg>
            </button>
            <button id="nextButton"
                class="absolute top-1/2 right-2 -translate-y-1/2 bg-[#85A947] transition-bg duration-300 focus:bg-[#3E7B27] text-white rounded-full flex items-center justify-center shadow-md hover:bg-[#123524]">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12.1717 12.0005L9.34326 9.17203L10.7575 7.75781L15.0001 12.0005L10.7575 16.2431L9.34326 14.8289L12.1717 12.0005Z">
                    </path>
                </svg>
            </button>
            <div data-slide="0"
                class="indicator-dot size-3 rounded-full bg-[#85A947] hover:bg-[#85A947] transition-all duration-300 cursor-pointer">
            </div>
            <div data-slide="1"
                class="indicator-dot size-3 rounded-full bg-[#85A947] hover:bg-[#85A947] transition-all duration-300 cursor-pointer">
            </div>
            <div data-slide="2"
                class="indicator-dot size-3 rounded-full bg-[#85A947] hover:bg-[#85A947] transition-all duration-300 cursor-pointer">
            </div>
        </div>
    </div>
        ' : ''; ?>
    </header>