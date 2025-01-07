<?php

define("ROUTE", "login");
include_once("../includes/header.php");

?>

<section id="login-container" class="min-h-[90vh] flex items-center relative px-6 py-8"
    style="background-image: url('../assets/images/music-1.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
    <form id="loginForm"
        class="login-box rounded-xl absolute left-16 flex flex-col justify-center gap-3 min-h-[300px] min-w-[500px] px-8 py-10 pt-8 bg-[#2E236C]">
        <?php 
        if (isset($_GET['register_email']) && isset($_GET['register_success'])) {
        ?>
        <div class="succes-register flex flex-col gap-2 overflow-hidden bg-[#2A004E] rounded-3xl text-center pt-2 mx-6">
            <span>You Just Created New Account</span>
            <p class="inline created-email rounded-lg px-2 py-1 bg-green-600">
                <?php
             if (isset($_GET['register_email'])) {
                echo $_GET['register_email'];
             }
            ?>
            </p>
        </div>
        <?php 
        }
        ?>
        <h1 class="mb-4 text-xl text-center">Login with sound</h1>

        <div class="user-mail flex flex-col gap-2">
            <label for="EmailorUsername"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="EmailorUsername" name="email_or_username"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Email or Username" />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">
                    Email or username
                </span>
            </label>
        </div>

        <div class="user-pass flex flex-col gap-2">
            <label for="Password"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="password" id="Password" name="password"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Password" />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">
                    Password
                </span>
            </label>
        </div>

        <button type="button" id="loginBtn" class="ml-auto">
            <span
                class="inline-block rounded border border-[#17153B] px-12 py-3 text-sm font-medium text-[#17153B] bg-[#C8ACD6] hover:text-[#2E236C] focus:outline-none focus:ring active:bg-indigo-500">
                Login
            </span>
        </button>
    </form>
</section>

<?php

    include_once('../includes/footer.php');
    
    ?>



<script>
$(document).ready(function() {
    $('#dropdown-button').click(function() {
        $('#dropdown').toggleClass('hidden');

    });

});

$('#loginBtn').on('click', function(e) {
    e.preventDefault();

    const loginData = {
        email_or_username: $('#EmailorUsername').val(),
        password: $('#Password').val()
    };
    const errorSpans = $('.error-message');
    errorSpans.remove();

    $.ajax({
        url: '../controller/login.controller.php',
        type: 'POST',
        data: loginData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                window.location.href = '../index.php';
            } else {
                const errorCode = response.error_code;
                const errorMessage = response.message;

                switch (errorCode) {
                    case 'ERR_REQUIRED_FIELDS':
                        const userUnknowField = $('.user-mail');
                        const userUnknowErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        userUnknowField.prepend(userUnknowErrorSpan);
                        break;
                    case 'ERR_INVALID_PASSWORD':
                        const userPassField = $('.user-pass');
                        const userPassErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        userPassField.prepend(userPassErrorSpan);
                        break;
                    case 'ERR_USER_NOT_FOUND':
                        const userMailField = $('.user-mail');
                        const userMailErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        userMailField.prepend(userMailErrorSpan);
                        break;
                    case 'ERR_INVALID_REQUEST':
                        alert('Invalid request. Please try again later.');
                        break;
                    default:
                        alert('An unexpected error occurred. Please try again.');
                        break;
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            alert("An error occurred. Please try again later.");
        }
    });
});
</script>
</body>

</html>