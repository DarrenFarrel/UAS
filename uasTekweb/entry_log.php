<?php
header('Content-Type: text/plain');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nomor_resi = $_POST['nomor_resi'];
$tanggal = $_POST['tanggal'];
$kota = $_POST['kota'];
$keterangan = $_POST['keterangan'];

if (empty($nomor_resi) || empty($tanggal) || empty($kota) || empty($keterangan)) {
    echo "Error: All fields are required.";
    exit();
}

$sql = "INSERT INTO detail_log (nomor_resi, tanggal, kota, keterangan) 
        VALUES ('$nomor_resi', '$tanggal', '$kota', '$keterangan')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "\n" . $conn->error;
}

$conn->close();
?>
