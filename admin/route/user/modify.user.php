<?php 
define("ROUTE", "modify.user");
include_once("../../includes/header.admin.php");
include_once("../../../config.php");

$user_id = $_GET['user_id'] ?? ($_POST['user_id'] ?? null);

if (!$user_id) {
    echo '
        <main class="w-full h-full bg-[#160F30] p-8 text-white">
            <h1 class="text-xl font-bold mb-4">Modify User</h1>
            <form method="POST" action="" class="space-y-4">
                <label for="user_id" class="block text-sm font-bold">Please provide user ID to modify their details</label>
                <input type="number" id="user_id" name="user_id" class="text-sm px-5 py-2  transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold" placeholder="Enter User ID" required>
                <button type="submit" class="text-sm px-5 py-2 transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">Load User</button>
            </form>
        </main>
    ';
    exit;
}

$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo '
        <main class="w-full h-full flex items-center justify-center flex-col bg-[#160F30] p-8 h-screen text-white">
            <h1 class="text-xl font-medium mb-4">User not found with provided id</h1>
            <a href="./modify.user.php" class="text-sm font-medium transition duration-200 bg-[#FF2929] hover:bg-[#C62E2E] py-2 px-5 rounded-3xl">Try Again</a>
        </main>
    ';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);
    $role = $_POST['role'];

    if (empty($username) || empty($email) || empty($phone_number) || empty($address)) {
        echo "All fields are required.";
        exit;
    }

    $update_query = "UPDATE users SET username = ?, email = ?, phone_number = ?, address = ?, role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssi", $username, $email, $phone_number, $address, $role, $user_id);

    if ($stmt->execute()) {
        echo "<script>window.location.href = './view.user.php';</script>";
        exit;
    } else {
        echo "Error updating user.";
    }
}

$stmt->close();
$conn->close();
?>

<main class="w-full h-full bg-[#160F30] p-8 text-white">
    <h1 class="text-2xl font-bold mb-4 p-4">All Users</h1>
    <form method="POST" action="" class="space-y-4">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <div>
            <label for="username" class="block text-xs font-bold pl-2">Username</label>
            <input type="text" id="username" name="username"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white"
                value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div>
            <label for="email" class="block text-xs font-bold pl-2">Email</label>
            <input type="email" id="email" name="email"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white"
                value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div>
            <label for="phone_number" class="block text-xs font-bold pl-2">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white"
                value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
        </div>
        <div>
            <label for="address" class="block text-xs font-bold pl-2">Address</label>
            <textarea id="address" name="address"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-md bg-transparent border-2 border-gray-400 text-white"
                required><?php echo htmlspecialchars($user['address']); ?></textarea>
        </div>
        <div>
            <label for="role" class="block text-xs font-bold pl-2">Role</label>
            <select id="role" name="role"
                class="w-full my-1 py-2 px-3 text-sm outline-none rounded-3xl bg-transparent border-2 border-gray-400 text-white"
                required>
                <option value="USER" class="text-black" <?php echo $user['role'] === 'USER' ? 'selected' : ''; ?>>USER
                </option>
                <option value="ADMIN" class="text-black" <?php echo $user['role'] === 'ADMIN' ? 'selected' : ''; ?>>
                    ADMIN</option>
            </select>
        </div>
        <button type="submit" name="update_user"
            class="text-sm px-5 py-2  transition duration-300 bg-[#4E31AA] hover:bg-[#3A1078] rounded-3xl font-bold">UPDATE</button>
    </form>
</main>
</section>

</body>

</html>