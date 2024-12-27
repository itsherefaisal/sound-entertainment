<?php
header("Content-Type: application/json");

include_once("../../config.php");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

$sql = "SELECT user_id, username, email, phone_number, address, role FROM users";
$result = $conn->query($sql);

if ($result) {
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(["success" => true, "data" => $users]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch users."]);
}

$conn->close();
?>
