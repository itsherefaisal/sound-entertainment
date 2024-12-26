<footer class=" rounded-lg shadow bg-[#202040] <?php if (ROUTE === "login" || ROUTE === "register") {
                                                        echo 'mt-0';
                                                    } else {
                                                        echo 'mt-16';
                                                    }
                                                ?>">
    <div class="w-full max-w-screen-xl mx-auto py-6 md:py-12">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="<?= ROUTE === "index" ? './' : '../' ?>"
                class="flex items-center mb-2 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="<?= ROUTE === "index" ? './assets/images/sound.png' : '../assets/images/sound.png' ?>"
                    class="h-8" alt="Sound" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Sound</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-4" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                href="<?= ROUTE === "index" ? './' : '../' ?>" class="hover:underline">Sound™</a>. All Rights
            Reserved.</span>
    </div>
</footer>
<?php 
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
?>
<script>
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
</script>
<?php 
}
?>