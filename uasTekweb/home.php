<?php
$conn = new mysqli('localhost', 'root', '', 'db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nomor_resi = isset($_GET['nomor_resi']) ? $conn->real_escape_string($_GET['nomor_resi']) : '';
$logs = [];

if ($nomor_resi) {
    $sql = "SELECT tanggal, kota, keterangan FROM detail_log WHERE nomor_resi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $nomor_resi);
} else {
    $sql = "SELECT tanggal, kota, keterangan FROM detail_log";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<thead><tr><th>Tanggal</th><th>Kota</th><th>Keterangan</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['tanggal']) . '</td>';
        echo '<td>' . htmlspecialchars($row['kota']) . '</td>';
        echo '<td>' . htmlspecialchars($row['keterangan']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>Tidak ada data yang ditemukan.</p>';
}

$stmt->close();
$conn->close();
?>
