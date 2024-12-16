<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $conn->real_escape_string($_POST['username']);
    $new_nama_admin = $conn->real_escape_string($_POST['nama_admin']);
    $new_password = $_POST['password'];
    $user_id = $_SESSION['user_id'];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "UPDATE user_admin SET username = ?, nama_admin = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $new_username, $new_nama_admin, $hashed_password, $user_id);

    if ($stmt->execute()) {
        session_destroy();
        header("Location: login.html?success=Account+updated+successfully,+please+login+again");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
