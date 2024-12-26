<?php

define("ROUTE", "videos");
include_once("../includes/header.php");

?>

    
    <section id="latest-music" class="px-6 py-4 my-4 min-h-[300px]">
        <div class="music-top">
            <h1 class="text-2xl font-bold text-center my-4">Videos | Movies</h1>
        </div>
        
        <div class="video-container my-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- video Card 1 -->
            <div class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
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
            </div>

            <div class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
                <div class="video-img h-[500px] lg:h-[340px] relative">
                    <span class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                    <img src="../assets/images/video-card-2.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="video-body w-full p-2">
                    <p class="truncate overflow-hidden text-lg mt-2">Pathan</p>
                    <p class="overflow-hidden text-gray-200 text-xs mb-2">A Pakistani general hires a private terror outfit to conduct attacks in India while Pathaan, an Indian secret agent, is on a mission to form a special unit.
                    </p>
                    <p class="video-artist text-xs text-gray-300"><b>Genre:</b> Comedy, Action</p>
                    <p class="video-artist text-xs text-gray-300"><b>Language:</b> English, Hindi</p>
                </div>
            </div>

            <div class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
                <div class="video-img h-[500px] lg:h-[340px] relative">
                    <span class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                    <img src="../assets/images/video-card-3.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="video-body w-full p-2">
                    <p class="truncate overflow-hidden text-lg mt-2">Pathan</p>
                    <p class="overflow-hidden text-gray-200 text-xs mb-2">A Pakistani general hires a private terror outfit to conduct attacks in India while Pathaan, an Indian secret agent, is on a mission to form a special unit.
                    </p>
                    <p class="video-artist text-xs text-gray-300"><b>Genre:</b> Comedy, Action</p>
                    <p class="video-artist text-xs text-gray-300"><b>Language:</b> English, Hindi</p>
                </div>
            </div>

            <div class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
                <div class="video-img h-[500px] lg:h-[340px] relative">
                    <span class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                    <img src="../assets/images/video-card-4.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="video-body w-full p-2">
                    <p class="truncate overflow-hidden text-lg mt-2">Pathan</p>
                    <p class="overflow-hidden text-gray-200 text-xs mb-2">A Pakistani general hires a private terror outfit to conduct attacks in India while Pathaan, an Indian secret agent, is on a mission to form a special unit.
                    </p>
                    <p class="video-artist text-xs text-gray-300"><b>Genre:</b> Comedy, Action</p>
                    <p class="video-artist text-xs text-gray-300"><b>Language:</b> English, Hindi</p>
                </div>
            </div>

            <div class="video-card w-full transition duration-200 hover:bg-gray-900 cursor-pointer rounded-md">
                <div class="video-img h-[500px] lg:h-[340px] relative">
                    <span class="release-year absolute top-2 right-2 py-1 px-2 rounded-md bg-black text-white text-xs">2018</span>
                    <img src="../assets/images/video-card-5.jpg" class="w-full h-full object-cover" alt="music-img">
                </div>
                <div class="video-body w-full p-2">
                    <p class="truncate overflow-hidden text-lg mt-2">Pathan</p>
                    <p class="overflow-hidden text-gray-200 text-xs mb-2">A Pakistani general hires a private terror outfit to conduct attacks in India while Pathaan, an Indian secret agent, is on a mission to form a special unit.
                    </p>
                    <p class="video-artist text-xs text-gray-300"><b>Genre:</b> Comedy, Action</p>
                    <p class="video-artist text-xs text-gray-300"><b>Language:</b> English, Hindi</p>
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