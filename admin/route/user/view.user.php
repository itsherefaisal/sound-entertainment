<?php 

define("ROUTE", "view.user");
include_once("../../includes/header.admin.php");

?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Users</h1>
    <table class="w-full table-auto border-collapse border border-gray-600">
        <thead>
            <tr class="bg-[#1B1833] text-white text-xs">
                <th class="border border-gray-600 px-4 py-2">User ID</th>
                <th class="border border-gray-600 px-4 py-2">Username</th>
                <th class="border border-gray-600 px-4 py-2">Email</th>
                <th class="border border-gray-600 px-4 py-2">Phone Number</th>
                <th class="border border-gray-600 px-4 py-2">Address</th>
                <th class="border border-gray-600 px-4 py-2">Role</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody id="user-table-body">
        </tbody>
    </table>
</main>
<script>
$(document).ready(function() {
    function fetchUsers() {
        $.ajax({
            url: "../../controller/view_user.controller.php",
            method: "GET",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    const users = response.data;
                    let rows = "";

                    if (users.length < 1) {
                        rows = `
                            <tr>
                                <td colspan="7" class="text-center border border-gray-600 px-4 py-2 text-sm text-gray-300">
                                    No users found.
                                </td>
                            </tr>
                        `;
                    } else {
                        users.forEach(user => {
                            rows += `
                                <tr class="hover:bg-[#4B4376] text-sm">
                                    <td class="border border-gray-600 px-4 py-2">${user.user_id}</td>
                                    <td class="border border-gray-600 px-4 py-2">${user.username}</td>
                                    <td class="border border-gray-600 px-4 py-2">${user.email}</td>
                                    <td class="border border-gray-600 px-4 py-2">${user.phone_number}</td>
                                    <td class="border border-gray-600 px-4 py-2">${user.address}</td>
                                    <td class="border border-gray-600 px-4 py-2">${user.role}</td>
                                    <td class="border border-gray-600 px-4 py-2 text-center">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 min-w-16 rounded">Edit</button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white py-1 min-w-16 rounded">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                    }

                    $("#user-table-body").html(rows);
                } else {
                    alert(response.message || "Failed to fetch users.");
                }
            },
            error: function() {
                alert("An error occurred while fetching users.");
            }
        });
    }

    fetchUsers();
});
</script>

</section>

</body>

</html>