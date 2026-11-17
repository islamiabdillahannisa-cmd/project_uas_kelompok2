<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM barang WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>