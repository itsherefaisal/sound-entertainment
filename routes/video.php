<?php

define("ROUTE", "video");
include_once("../includes/header.php");

?>


    <section class="min-h-screen flex flex-col items-center text-white w-full py-6">
        <div class="video-container w-full p-4 px-8">
            <!-- Video Player -->
            <div id="videoPlayerContainer"
                class="relative bg-black flex items-center justify-center pt-14 rounded-lg overflow-hidden shadow-lg group">
                <!-- Video -->
                <video id="video-player" class="w-full h-auto max-h-[650px] object-contain">
                    <source src="../assets/media/videos/sample.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

                <!-- Title Overlay -->
                <div id="title-overlay"
                    class="absolute top-0 left-0 w-full bg-gradient-to-b from-black to-transparent p-4 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    <h1 id="video-title" class="text-lg font-bold truncate">Awesome Video Title</h1>
                </div>

                <div id="video-controls"
                    class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-4 flex justify-between items-center opacity-0 translate-y-8 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                    <button id="custom-play-btn" class="text-white">
                        <svg id="play-icon" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <svg id="pause-icon" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="6" y="4" width="4" height="16"></rect>
                            <rect x="14" y="4" width="4" height="16"></rect>
                        </svg>
                    </button>

                    <div class="seek flex items-center w-full justify-center gap-2 mx-8">
                        <span id="current-time" class="text-sm">00:00</span>
                        <div id="seek-bar" class="relative flex items-center w-full h-1 bg-gray-700 cursor-pointer">
                            <div id="progress-bar" class="absolute h-full bg-gray-400"></div>
                        </div>
                        <span id="total-duration" class="text-sm">00:00</span>
                    </div>


                    <div class="volume-bar flex items-center w-[200px] gap-1">
                        <span id="volume-icon" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M6.60282 10.0001L10 7.22056V16.7796L6.60282 14.0001H3V10.0001H6.60282ZM2 16.0001H5.88889L11.1834 20.3319C11.2727 20.405 11.3846 20.4449 11.5 20.4449C11.7761 20.4449 12 20.2211 12 19.9449V4.05519C12 3.93977 11.9601 3.8279 11.887 3.73857C11.7121 3.52485 11.3971 3.49335 11.1834 3.66821L5.88889 8.00007H2C1.44772 8.00007 1 8.44778 1 9.00007V15.0001C1 15.5524 1.44772 16.0001 2 16.0001ZM23 12C23 15.292 21.5539 18.2463 19.2622 20.2622L17.8445 18.8444C19.7758 17.1937 21 14.7398 21 12C21 9.26016 19.7758 6.80629 17.8445 5.15557L19.2622 3.73779C21.5539 5.75368 23 8.70795 23 12ZM18 12C18 10.0883 17.106 8.38548 15.7133 7.28673L14.2842 8.71584C15.3213 9.43855 16 10.64 16 12C16 13.36 15.3213 14.5614 14.2842 15.2841L15.7133 16.7132C17.106 15.6145 18 13.9116 18 12Z">
                                </path>
                            </svg>
                        </span>
                        <div id="volume-control"
                            class="relative w-full h-1 flex items-center bg-gray-700 cursor-pointer">
                            <div id="volume-bar" class="absolute h-full w-full bg-gray-400"></div>
                            <div id="volume-dot" class="absolute w-2 h-2 bg-white rounded-full" style="left: 0;"></div>
                        </div>
                    </div>
                    <div class="maximize-screen flex items-center px-4">
                        <button id="maximize-btn">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 hover:text-gray-200"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 3V5H4V9H2V3H8ZM2 21V15H4V19H8V21H2ZM22 21H16V19H20V15H22V21ZM22 9H20V5H16V3H22V9Z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>

                </div>
            </div>


            <div class="mt-4 px-4">
                <h2 id="video-details-title" class="text-2xl font-semibold">Awesome Video Title</h2>
                <p id="upload-date" class="text-gray-400 text-sm mt-2">
                    Release date: <span class="font-medium text-gray-200">December 25, 2024</span>
                </p>
                <p id="video-description" class="mt-2 min-h-[200px]">
                    <span class="font-bold">Description:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus repellat voluptate velit asperiores omnis tempora veniam perspiciatis esse ad ducimus.
                </p>
            </div>
        </div>
        <!-- Related Videos -->
        <div class="related-videos px-14 w-full mt-6">
            <h3 class="text-xl font-bold mb-4">More movies.</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="related-card bg-gray-800 rounded-lg overflow-hidden hover:bg-gray-700 cursor-pointer transition">
                    <img src="../assets/images/video-card-2.jpg" class="w-full h-[200px] object-cover" alt="Thumbnail">
                    <div class="p-3">
                        <h3 class="truncate font-semibold text-lg">Matrix</h3>
                        <h4 class="truncate text-sm my-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. A, quia!</h4>
                        <p class="text-gray-400 text-xs">Genre: <span class="text-gray-400 ">Action, Sci-fi</span></p>
                        <p class="text-gray-400 text-xs">Time: 2:40:23</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    include_once('../includes/footer.php');
    
    ?>



    <script>
        $(document).ready(function () {

            // code for profile show hide 
            $('#show-profile').on('click', function () {
                $('#profile-container')
                    .fadeIn(300)
                    .css('display', 'flex');
                $('body').css('overflow', 'hidden');
            });

            $('#close-profile').on('click', function () {
                $('#profile-container').fadeOut(300);
                $('body').css('overflow', 'auto');
            });

            const videoPlayer = document.getElementById('video-player');
            const playButton = document.getElementById('custom-play-btn');
            const playIcon = document.getElementById('play-icon');
            const pauseIcon = document.getElementById('pause-icon');
            const seekBar = document.getElementById('seek-bar');
            const progressBar = document.getElementById('progress-bar');
            const volumeControl = document.getElementById('volume-control');
            const volumeBar = document.getElementById('volume-bar');
            const volumeDot = document.getElementById('volume-dot');
            const currentTimeDisplay = document.getElementById('current-time');
            const totalDurationDisplay = document.getElementById('total-duration');
            const volumeIcon = document.getElementById('volume-icon');
            const maximizeBtn = document.getElementById('maximize-btn');
            const videoPlayerContainer = document.getElementById('videoPlayerContainer');
            const body = document.body;

            function toggleFullScreen() {
                if (!document.fullscreenElement) {
                    if (videoPlayerContainer.requestFullscreen) {
                        videoPlayerContainer.requestFullscreen();
                    } else if (videoPlayerContainer.mozRequestFullScreen) {
                        videoPlayerContainer.mozRequestFullScreen();
                    } else if (videoPlayerContainer.webkitRequestFullscreen) {
                        videoPlayerContainer.webkitRequestFullscreen();
                    } else if (videoPlayerContainer.msRequestFullscreen) {
                        videoPlayerContainer.msRequestFullscreen();
                    }

                    body.style.overflow = 'hidden';
                    maximizeBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 hover:text-gray-200" viewBox="0 0 24 24" fill="currentColor"><path d="M18 7H22V9H16V3H18V7ZM8 9H2V7H6V3H8V9ZM18 17V21H16V15H22V17H18ZM8 15V21H6V17H2V15H8Z"></path></svg>
        `;

                    videoPlayer.classList.add('w-screen', 'h-screen');
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    }

                    body.style.overflow = '';
                    maximizeBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 hover:text-gray-200" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 3V5H4V9H2V3H8ZM2 21V15H4V19H8V21H2ZM22 21H16V19H20V15H22V21ZM22 9H20V5H16V3H22V9Z"></path>
            </svg>
        `;

                    videoPlayer.classList.remove('w-screen', 'h-screen');
                }
            }

            // Add event listener to the maximize button
            maximizeBtn.addEventListener('click', toggleFullScreen);



            // SVG Icons for volume levels
            const svgHigh = `
<svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="currentColor">
    <path d="M6.60282 10.0001L10 7.22056V16.7796L6.60282 14.0001H3V10.0001H6.60282ZM2 16.0001H5.88889L11.1834 20.3319C11.2727 20.405 11.3846 20.4449 11.5 20.4449C11.7761 20.4449 12 20.2211 12 19.9449V4.05519C12 3.93977 11.9601 3.8279 11.887 3.73857C11.7121 3.52485 11.3971 3.49335 11.1834 3.66821L5.88889 8.00007H2C1.44772 8.00007 1 8.44778 1 9.00007V15.0001C1 15.5524 1.44772 16.0001 2 16.0001ZM23 12C23 15.292 21.5539 18.2463 19.2622 20.2622L17.8445 18.8444C19.7758 17.1937 21 14.7398 21 12C21 9.26016 19.7758 6.80629 17.8445 5.15557L19.2622 3.73779C21.5539 5.75368 23 8.70795 23 12ZM18 12C18 10.0883 17.106 8.38548 15.7133 7.28673L14.2842 8.71584C15.3213 9.43855 16 10.64 16 12C16 13.36 15.3213 14.5614 14.2842 15.2841L15.7133 16.7132C17.106 15.6145 18 13.9116 18 12Z"></path>
</svg>`;

            const svgMedium = `
<svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="currentColor">
    <path d="M13 7.22056L9.60282 10.0001H6V14.0001H9.60282L13 16.7796V7.22056ZM8.88889 16.0001H5C4.44772 16.0001 4 15.5524 4 15.0001V9.00007C4 8.44778 4.44772 8.00007 5 8.00007H8.88889L14.1834 3.66821C14.3971 3.49335 14.7121 3.52485 14.887 3.73857C14.9601 3.8279 15 3.93977 15 4.05519V19.9449C15 20.2211 14.7761 20.4449 14.5 20.4449C14.3846 20.4449 14.2727 20.405 14.1834 20.3319L8.88889 16.0001ZM18.8631 16.5911L17.4411 15.1691C18.3892 14.4376 19 13.2902 19 12.0001C19 10.5697 18.2493 9.31476 17.1203 8.60766L18.5589 7.16906C20.0396 8.26166 21 10.0187 21 12.0001C21 13.8422 20.1698 15.4905 18.8631 16.5911Z"></path>
</svg>`;

            const svgMuted = `
<svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="currentColor">
    <path d="M10 7.22056L6.60282 10.0001H3V14.0001H6.60282L10 16.7796V7.22056ZM5.88889 16.0001H2C1.44772 16.0001 1 15.5524 1 15.0001V9.00007C1 8.44778 1.44772 8.00007 2 8.00007H5.88889L11.1834 3.66821C11.3971 3.49335 11.7121 3.52485 11.887 3.73857C11.9601 3.8279 12 3.93977 12 4.05519V19.9449C12 20.2211 11.7761 20.4449 11.5 20.4449C11.3846 20.4449 11.2727 20.405 11.1834 20.3319L5.88889 16.0001ZM20.4142 12.0001L23.9497 15.5356L22.5355 16.9498L19 13.4143L15.4645 16.9498L14.0503 15.5356L17.5858 12.0001L14.0503 8.46454L15.4645 7.05032L19 10.5859L22.5355 7.05032L23.9497 8.46454L20.4142 12.0001Z"></path>
</svg>`;

            function updateVolumeIcon(volume) {
                if (volume === 0) {
                    volumeIcon.innerHTML = svgMuted;
                } else if (volume > 0.7) {
                    volumeIcon.innerHTML = svgHigh;
                } else {
                    volumeIcon.innerHTML = svgMedium;
                }
            }

            // Initial volume set to 50%
            videoPlayer.volume = 0.5;


            // Play/Pause functionality
            playButton.addEventListener('click', () => {
                if (videoPlayer.paused) {
                    videoPlayer.play();
                    playIcon.classList.add('hidden');
                    pauseIcon.classList.remove('hidden');
                } else {
                    videoPlayer.pause();
                    playIcon.classList.remove('hidden');
                    pauseIcon.classList.add('hidden');
                }
            });

            // Function to format time (mm:ss)
            function formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${mins < 10 ? '0' + mins : mins}:${secs < 10 ? '0' + secs : secs}`;
            }

            // Update progress bar and current time display
            function updateSeekBar() {
                const progress = (videoPlayer.currentTime / videoPlayer.duration) * 100;
                progressBar.style.width = `${progress}%`;

                // Update current time display
                currentTimeDisplay.textContent = formatTime(videoPlayer.currentTime);
            }
            videoPlayer.addEventListener('timeupdate', updateSeekBar);

            // Display total duration when the video is loaded
            videoPlayer.addEventListener('loadedmetadata', () => {
                totalDurationDisplay.textContent = formatTime(videoPlayer.duration);
            });

            // Seek functionality
            seekBar.addEventListener('click', (event) => {
                const rect = seekBar.getBoundingClientRect();
                const clickX = event.clientX - rect.left;
                const newTime = (clickX / seekBar.offsetWidth) * videoPlayer.duration;
                videoPlayer.currentTime = newTime;
                updateSeekBar();
            });

            // Volume control functionality
            function updateVolumeBar() {
                const volumeProgress = videoPlayer.volume * 100;
                volumeBar.style.width = `${volumeProgress}%`;
                volumeDot.style.left = `${volumeProgress}%`;
                updateVolumeIcon(videoPlayer.volume);

            }
            updateVolumeBar();

            // Update volume on click
            volumeControl.addEventListener('click', (event) => {
                const rect = volumeControl.getBoundingClientRect();
                const clickX = event.clientX - rect.left;
                const newVolume = clickX / volumeControl.offsetWidth;
                videoPlayer.volume = newVolume;
                updateVolumeBar();
            });

            // Volume drag functionality
            let isDragging = false;

            // Start dragging
            volumeDot.addEventListener('mousedown', () => {
                isDragging = true;
            });

            // Stop dragging
            document.addEventListener('mouseup', () => {
                isDragging = false;
            });

            // Dragging functionality
            document.addEventListener('mousemove', (event) => {
                if (isDragging) {
                    const rect = volumeControl.getBoundingClientRect();
                    const clickX = event.clientX - rect.left;
                    const newVolume = Math.min(Math.max(clickX / volumeControl.offsetWidth, 0), 1);
                    videoPlayer.volume = newVolume;
                    updateVolumeBar();
                }
            });

            // Initialize volume bar on page load
            videoPlayer.addEventListener('volumechange', updateVolumeBar);

        });

    </script>
</body>

</html>