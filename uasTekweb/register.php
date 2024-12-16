<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $nama_admin = trim($_POST['nama_admin']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($nama_admin) || empty($password)) {
        header("Location: register.html?error=All+fields+are+required");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user_admin (username, password, nama_admin) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $nama_admin);

    if ($stmt->execute()) {
        header("Location: login.html?success=Registration+successful");
    } else {
        header("Location: register.html?error=Failed+to+register");
    }

    $stmt->close();
    $conn->close();
}
?>
