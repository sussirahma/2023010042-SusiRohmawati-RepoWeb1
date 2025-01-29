<?php
require 'db.php';

$query = "SELECT * FROM menu WHERE stok > 0";
$stmt = $pdo->query($query);
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Menu</title>
</head>

<body>
    <h1>Daftar Menu</h1>
    <?php foreach ($menus as $menu): ?>
        <div>
            <h3><?= $menu['nama_menu'] ?></h3>
            <p><?= $menu['deskripsi'] ?></p>
            <p>Harga: Rp <?= number_format($menu['harga'], 0, ',', '.') ?></p>
            <p>Stok: <?= $menu['stok'] ?></p>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="menu_id" value="<?= $menu['id_menu'] ?>">
                <button type="submit" name="add_to_cart">Tambah ke Keranjang</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>