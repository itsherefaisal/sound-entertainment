<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrUsername = filter_var(trim($_POST['email_or_username'] ?? ''), FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';

    if (empty($emailOrUsername) || empty($password)) {
        echo json_encode([
            'success' => false,
            'error_code' => 'ERR_REQUIRED_FIELDS',
            'message' => 'Email/Username and Password are required.'
        ]);
        exit;
    }

    include_once('../config.php');

    if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT user_id, username, email, address, phone_number, role, password FROM users WHERE email = ?";
    } else {
        $query = "SELECT user_id, username, email, address, phone_number, role, password FROM users WHERE username = ?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emailOrUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_address'] = $user['address'];
            $_SESSION['user_phone'] = $user['phone_number'];
            $_SESSION['user_role'] = $user['role'];

            echo json_encode(['success' => true]);
        } else {
            echo json_encode([
                'success' => false,
                'error_code' => 'ERR_INVALID_PASSWORD',
                'message' => 'Invalid password.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error_code' => 'ERR_USER_NOT_FOUND',
            'message' => 'No user found with that email/username.'
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode([
        'success' => false,
        'error_code' => 'ERR_INVALID_REQUEST',
        'message' => 'Invalid request method.'
    ]);
}
?>
