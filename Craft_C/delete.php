<?php
include("db.php");

// Periksa apakah parameter id tersedia
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM products WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah penghapusan
        $redirect = $_GET['redirect'] ?? 'manage_produk.php';
        header("Location: $redirect");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
