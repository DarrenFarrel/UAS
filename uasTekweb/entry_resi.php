<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tanggal = $_POST['tanggal'];
$nomor_resi = $_POST['nomor_resi'];

$sql = "INSERT INTO transaksi_resi (tanggal_resi, nomor_resi) VALUES ('$tanggal', '$nomor_resi')";

if ($conn->query($sql) === TRUE) {
    header("Location: detailresi.html"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
