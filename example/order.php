<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Pengguna harus login terlebih dahulu
    exit;
}

if (isset($_POST['place_order'])) {
    $user_id = $_SESSION['user']['id_user'];
    $total_harga = 0;

    foreach ($_SESSION['cart'] as $menu_id => $quantity) {
        // Ambil harga menu
        $query = "SELECT harga FROM menu WHERE id_menu = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$menu_id]);
        $menu = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_harga += $menu['harga'] * $quantity;
    }

    // Simpan pesanan
    $query = "INSERT INTO orders (id_user, total_harga) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $total_harga]);
    $order_id = $pdo->lastInsertId(); // ID pesanan yang baru

    // Simpan detail pesanan
    foreach ($_SESSION['cart'] as $menu_id => $quantity) {
        $query = "SELECT harga FROM menu WHERE id_menu = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$menu_id]);
        $menu = $stmt->fetch(PDO::FETCH_ASSOC);
        $harga_subtotal = $menu['harga'] * $quantity;

        $query = "INSERT INTO order_details (id_order, id_menu, jumlah, harga_subtotal) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$order_id, $menu_id, $quantity, $harga_subtotal]);
    }

    // Kosongkan keranjang
    unset($_SESSION['cart']);
    header("Location: orders.php"); // Redirect ke halaman pesanan
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Buat Pesanan</title>
</head>

<body>
    <h1>Buat Pesanan</h1>
    <form action="" method="POST">
        <button type="submit" name="place_order">Pesan Sekarang</button>
    </form>
</body>

</html>