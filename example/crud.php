<?php
require 'db.php';

// Tambah Menu
if (isset($_POST['add_menu'])) {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_POST['gambar'] ?? NULL;  // Gambar bisa kosong jika tidak ada

    // Pastikan harga sesuai dengan format yang benar
    // Menggunakan fungsi format angka dengan dua angka desimal
    $harga = number_format($harga, 2, '.', '');

    $stmt = $pdo->prepare("INSERT INTO menu (nama_menu, harga, stok, gambar) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama_menu, $harga, $stok, $gambar]);
}

// Edit Menu
if (isset($_POST['edit_menu'])) {
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_POST['gambar'] ?? NULL;  // Gambar bisa kosong jika tidak ada

    // Pastikan harga sesuai dengan format yang benar
    // Menggunakan fungsi format angka dengan dua angka desimal
    $harga = number_format($harga, 2, '.', '');

    $stmt = $pdo->prepare("UPDATE menu SET nama_menu = ?, harga = ?, stok = ?, gambar = ? WHERE id_menu = ?");
    $stmt->execute([$nama_menu, $harga, $stok, $gambar, $id_menu]);

    header("Location: admin.php");
    exit;
}

// Hapus Menu
if (isset($_GET['delete'])) {
    $id_menu = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM menu WHERE id_menu = ?");
    $stmt->execute([$id_menu]);
}

// Ambil Semua Menu
$stmt = $pdo->query("SELECT * FROM menu");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - CRUD Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Admin - Manajemen Menu</h1>
            <a href="logout.php" class="btn-login">Logout</a>
            <!-- Tombol Export ke PDF -->
            <a href="export_pdf.php" class="btn">Export Data ke PDF</a>
        </header>

        <!-- Form Tambah Menu -->
        <section class="menu-form">
            <h2>Tambah Menu</h2>
            <form method="POST">
                <input type="text" name="nama_menu" placeholder="Nama Menu" required>
                <input type="number" step="0.01" name="harga" placeholder="Harga" required>
                <input type="number" name="stok" placeholder="Stok" required>
                <input type="text" name="gambar" placeholder="URL Gambar (opsional)">
                <button type="submit" name="add_menu">Tambah Menu</button>
            </form>
        </section>

        <!-- Daftar Menu -->
        <section class="menu-list">
            <h2>Daftar Menu</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?= $menu['id_menu'] ?></td>
                        <td><?= $menu['nama_menu'] ?></td>
                        <td>Rp <?= number_format($menu['harga'], 0, ',', '.') ?></td>
                        <td><?= $menu['stok'] ?></td>
                        <td>
                            <!-- Menampilkan gambar jika ada -->
                            <?php if ($menu['gambar']): ?>
                                <img src="<?= $menu['gambar'] ?>" alt="<?= $menu['nama_menu'] ?>" width="50">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?edit=<?= $menu['id_menu'] ?>">Edit</a>
                            <a href="?delete=<?= $menu['id_menu'] ?>"
                                onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <!-- Form Edit Menu -->
        <?php if (isset($_GET['edit'])): ?>
            <?php
            $id_menu = $_GET['edit'];
            $stmt = $pdo->prepare("SELECT * FROM menu WHERE id_menu = ?");
            $stmt->execute([$id_menu]);
            $menu = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <?php if ($menu): ?>
                <section class="menu-edit-form">
                    <h2>Edit Menu</h2>
                    <form method="POST">
                        <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
                        <input type="text" name="nama_menu" value="<?= $menu['nama_menu'] ?>" required>
                        <input type="number" step="0.01" name="harga" value="<?= $menu['harga'] ?>" required>
                        <input type="number" name="stok" value="<?= $menu['stok'] ?>" required>
                        <input type="text" name="gambar" value="<?= $menu['gambar'] ?>" placeholder="URL Gambar (opsional)">
                        <button type="submit" name="edit_menu">Simpan Perubahan</button>
                    </form>
                </section>
            <?php else: ?>
                <p>Menu tidak ditemukan.</p>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</body>

</html>