<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var(trim($_POST['username'] ?? ''), FILTER_SANITIZE_STRING);
    $address = filter_var(trim($_POST['address'] ?? ''), FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST['phone'] ?? ''), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($address) || empty($phone) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'error_code' => 'ERR_REQUIRED_FIELDS', 'message' => 'All fields are required.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error_code' => 'ERR_INVALID_EMAIL', 'message' => 'Invalid email format.']);
        exit;
    }

    if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
        echo json_encode(['success' => false, 'error_code' => 'ERR_INVALID_PHONE', 'message' => 'Invalid phone number format.']);
        exit;
    }

    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'error_code' => 'ERR_PASSWORD_LENGTH', 'message' => 'Password must be at least 8 characters long.']);
        exit;
    }

    include_once('../config.php');

    // Check for duplicate username
    $usernameCheckStmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $usernameCheckStmt->bind_param("s", $username);
    $usernameCheckStmt->execute();
    $usernameCheckStmt->store_result();

    if ($usernameCheckStmt->num_rows > 0) {
        echo json_encode(['success' => false, 'error_code' => 'ERR_USERNAME_EXISTS', 'message' => 'Username is already in use. Please choose a different username.']);
        $usernameCheckStmt->close();
        $conn->close();
        exit;
    }
    $usernameCheckStmt->close();

    // Check for duplicate email
    $emailCheckStmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $emailCheckStmt->bind_param("s", $email);
    $emailCheckStmt->execute();
    $emailCheckStmt->store_result();

    if ($emailCheckStmt->num_rows > 0) {
        echo json_encode(['success' => false, 'error_code' => 'ERR_EMAIL_EXISTS', 'message' => 'Email is already in use.']);
        $emailCheckStmt->close();
        $conn->close();
        exit;
    }
    $emailCheckStmt->close();

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (username, address, phone_number, email, password, role) VALUES (?, ?, ?, ?, ?, 'USER')");
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bind_param("sssss", $username, $address, $phone, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error_code' => 'ERR_SERVER_ERROR', 'message' => 'A server error occurred. Please try again later.']);
    }

    $stmt->close();
    $conn->close();
}
?>
