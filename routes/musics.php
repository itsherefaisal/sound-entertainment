<?php

define("ROUTE", "musics");
include_once("../includes/header.php");

?>


    <section id="latest-music" class="px-6 py-4 my-4 min-h-[300px]">
        <div class="music-top">
            <h1 class="text-2xl font-bold text-center my-4">Music | Songs</h1>
        </div>

        <div class="music-container my-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Music Card 1 -->
            <div class="music-card w-full ">
                <div class="music-img h-[500px] lg:h-[330px] relative group">
                    <div
                        class="overlay-play  absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                    <img src="../assets/images/music-card-1.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="music-body w-full p-2">
                    <p class="truncate overflow-hidden">Yo Yo Honey Singh 2013 Rap Mix By S&M</p>
                    <p class="song-artist text-xs text-gray-300"><b>Artist:</b> Hirdesh Singh</p>
                </div>
            </div>

            <!-- Music Card 2 -->
            <div class="music-card w-full ">
                <div class="music-img h-[500px] lg:h-[330px] relative group">
                    <div
                        class="overlay-play  absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2019</span>
                    <img src="../assets/images/music-card-2.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="music-body w-full p-2">
                    <p class="truncate overflow-hidden">Arijit Singh - Best Love Songs</p>
                    <p class="song-artist text-xs text-gray-300"><b>Artist:</b> Arijit Singh</p>
                </div>
            </div>

            <!-- Music Card 3 -->
            <div class="music-card w-full ">
                <div class="music-img h-[500px] lg:h-[330px] relative group">
                    <div
                        class="overlay-play  absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z">
                            </path>
                        </svg>
                    </div> <span
                        class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2020</span>
                    <img src="../assets/images/music-card-3.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="music-body w-full p-2">
                    <p class="truncate overflow-hidden">Best of Shreya Ghoshal</p>
                    <p class="song-artist text-xs text-gray-300"><b>Artist:</b> Shreya Ghoshal</p>
                </div>
            </div>

            <!-- Music Card 4 -->
            <div class="music-card w-full ">
                <div class="music-img h-[500px] lg:h-[330px] relative group">
                    <div
                        class="overlay-play  absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z">
                            </path>
                        </svg>
                    </div> <span
                        class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2021</span>
                    <img src="../assets/images/music-card-4.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="music-body w-full p-2">
                    <p class="truncate overflow-hidden">The Weekend Hits - 2021</p>
                    <p class="song-artist text-xs text-gray-300"><b>Artist:</b> The Weeknd</p>
                </div>
            </div>

            <!-- Music Card 5 -->
            <div class="music-card w-full ">
                <div class="music-img h-[500px] lg:h-[330px] relative group">
                    <div
                        class="overlay-play  absolute top-0 left-0 hidden group-hover:flex items-center bg-gray-950/70 justify-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-28 rounded-full transtion duration-300 cursor-pointer hover:text-red-500"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM10.6219 8.41459C10.5562 8.37078 10.479 8.34741 10.4 8.34741C10.1791 8.34741 10 8.52649 10 8.74741V15.2526C10 15.3316 10.0234 15.4088 10.0672 15.4745C10.1897 15.6583 10.4381 15.708 10.6219 15.5854L15.5008 12.3328C15.5447 12.3035 15.5824 12.2658 15.6117 12.2219C15.7343 12.0381 15.6846 11.7897 15.5008 11.6672L10.6219 8.41459Z">
                            </path>
                        </svg>
                    </div> <span
                        class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2022</span>
                    <img src="../assets/images/music-card-5.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="music-body w-full p-2">
                    <p class="truncate overflow-hidden">BTS Dynamite</p>
                    <p class="song-artist text-xs text-gray-300"><b>Artist:</b> BTS</p>
                </div>
            </div>
        </div>
    </section>

    <?php

    include_once('../includes/footer.php');
    
    ?>



    <script>
        $(document).ready(function () {
            $('#dropdown-button').click(function () {
                $('#dropdown').toggleClass('hidden');

            });

        });

    </script>
</body>

</html>