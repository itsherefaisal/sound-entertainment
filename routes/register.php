<?php

define("ROUTE", "register");
include_once("../includes/header.php");

?>
<section id="login-container" class="min-h-[100vh] flex items-center relative px-6 py-8"
    style="background-image: url('../assets/images/music-1.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
    <form id="registerForm"
        class="register-box transform translate-y-[-50%] rounded-xl absolute left-16 top-[50%] flex flex-col justify-center gap-3 min-h-[500px] min-w-[500px] px-8 py-10 pt-8 bg-[#2E236C]">
        <h1 class="mb-4 text-xl text-center">Register with Sound</h1>

        <div class="user-name flex flex-col gap-2">
            <label for="Username"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="Username" name="username"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Username" required />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">Username</span>
            </label>
        </div>
        <div class="user-address flex flex-col gap-2">
            <label for="Address"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="Address" name="address"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Address" required />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">Address</span>
            </label>
        </div>
        <div class="user-phone flex flex-col gap-2">
            <label for="Phone"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="Phone" name="phone"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Phone Number" required />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">Phone
                    Number</span>
            </label>
        </div>
        <div class="user-email flex flex-col gap-2">
            <label for="Email"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="email" id="Email" name="email"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Email" required />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">Email</span>
            </label>
        </div>
        <div class="user-password flex flex-col gap-2">
            <label for="Password"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="password" id="Password" name="password"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Password" required />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">Password</span>
            </label>
        </div>
        <div class="user-confirmPassword flex flex-col gap-2">
            <label for="confirmPassword"
                class="relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="password" id="confirmPassword" name="confirmPassword"
                    class="peer border-none text-sm bg-transparent placeholder-transparent p-3 w-full focus:border-transparent focus:outline-none focus:ring-0"
                    placeholder="Confirm Password" required />
                <span
                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 text-white p-0.5 text-xs transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:bg-[#2E236C] bg-[#2E236C] peer-focus:z-50 peer-focus:text-xs">Confirm
                    Password</span>
            </label>
        </div>
        <button type="button" id="submitBtn" class="ml-auto">
            <span
                class="inline-block rounded border border-[#17153B] px-12 py-3 text-sm font-medium text-[#17153B] bg-[#C8ACD6] hover:text-[#2E236C] focus:outline-none focus:ring active:bg-indigo-500">Create
                an account</span>
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

$('#submitBtn').on('click', function(e) {
    e.preventDefault();

    const formData = {
        username: $('#Username').val(),
        address: $('#Address').val(),
        phone: $('#Phone').val(),
        email: $('#Email').val(),
        password: $('#Password').val(),
        confirmPassword: $('#confirmPassword').val()
    };

    const errorSpans = $('.error-message');
    errorSpans.remove();

    if (formData.password !== formData.confirmPassword) {
        const userPasswordField = $('.user-password');
        const errorSpan = $('<span>').addClass(
            'px-2 text-xs font-bold text-[#FB4141] error-message').text("Password not matched.");
        userPasswordField.prepend(errorSpan);
        return;
    }

    $.ajax({
        url: '../controller/register.controller.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const emailText = $('#Email').val();
                window.location.href =
                    `./login.php?register_success=true&register_email=${encodeURIComponent(emailText)}`;
                $('#registerForm')[0].reset();
            } else {
                const errorCode = response.error_code;
                const errorMessage = response.message;

                switch (errorCode) {
                    case 'ERR_USERNAME_EXISTS':
                        const usernameField = $('.user-name');
                        const usernameErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        usernameField.prepend(usernameErrorSpan);
                        break;

                    case 'ERR_EMAIL_EXISTS':
                        const emailField = $('.user-email');
                        const emailErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        emailField.prepend(emailErrorSpan);
                        break;

                    case 'ERR_INVALID_PHONE':
                        const phoneField = $('.user-phone');
                        const phoneErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        phoneField.prepend(phoneErrorSpan);
                        break;

                    case 'ERR_PASSWORD_LENGTH':
                        const passwordField = $('.user-password');
                        const passwordErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        passwordField.prepend(passwordErrorSpan);
                        break;

                    case 'ERR_REQUIRED_FIELDS':
                        alert(errorMessage);
                        break;

                    case 'ERR_INVALID_EMAIL':
                        const invalidEmailField = $('.user-email');
                        const invalidEmailErrorSpan = $('<span>').addClass(
                            'px-2 text-xs font-bold text-[#FB4141] error-message').text(
                            errorMessage);
                        invalidEmailField.prepend(invalidEmailErrorSpan);
                        break;

                    case 'ERR_SERVER_ERROR':
                        alert(errorMessage);
                        break;

                    default:
                        alert("An unknown error occurred. Please try again.");
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