<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_admin WHERE username = ? AND status_aktif = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            header("Location: detailresi.html");
            exit();
        } else {
            header("Location: login.html?error=Invalid+password");
            exit();
        }
    } else {
        header("Location: login.html?error=User+not+found+or+inactive");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
