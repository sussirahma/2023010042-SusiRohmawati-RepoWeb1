<?php
session_start();
require 'db.php'; // Pastikan file db.php ada untuk koneksi ke database

// Memeriksa apakah ada pesan sukses atau error di session
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['message'], $_SESSION['error']);

// Ambil data menu dari database
$stmt = $pdo->query("SELECT * FROM menu WHERE stok > 0");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fungsi untuk menghitung jumlah barang di keranjang
function getCartCount()
{
    return isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Craft Circle - Menu</title>

    <!-- Menambahkan link ke file CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Selamat datang di Craft Circle</h1>

        <!-- Tampilkan pesan sukses atau error jika ada -->
        <?php if ($message): ?>
            <p style="color: green;"><?= $message ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <!-- Tampilkan jumlah keranjang -->
        <div>
            <a href="cart.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <?= getCartCount() ?>
            </a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> | <a href="register.php">Daftar</a>
            <?php endif; ?>
        </div>


    </header>

    <h2>Daftar Menu</h2>

    <div class="menu">
        <?php foreach ($menus as $menu): ?>
            <div class="menu-item">
                <img src="<?= $menu['gambar'] ?>" alt="<?= $menu['nama_menu'] ?>" width="200">
                <h3><?= $menu['nama_menu'] ?></h3>
                <p><?= $menu['deskripsi'] ?></p>
                <p>Harga: Rp <?= number_format($menu['harga'], 0, ',', '.') ?></p>
                <p>Stok: <?= $menu['stok'] ?></p>

                <!-- Form untuk menambah ke keranjang -->
                <form action="cart.php" method="POST">
                    <input type="hidden" name="menu_id" value="<?= $menu['id_menu'] ?>">
                    <button type="submit" name="cart">Tambah ke Keranjang</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <footer>
        <p>&copy; 2025 Craft Circle. All rights reserved.</p>
    </footer>
</body>

</html>