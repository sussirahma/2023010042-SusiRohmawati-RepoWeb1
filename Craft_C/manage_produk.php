<?php
include("db.php");
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Manage Produk</title>
    <link href="assets/css/admin.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="assets/img/logo-2.png" rel="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">

</head>


<body>
    <div class="container">
        <h3 class="mt-4">Manage Produk</h3>
        <a href="create.php" class="btn btn-primary mb-3">Tambah Produk Baru</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Pastikan $result sudah didefinisikan dan berisi hasil query dari database
                if ($result->num_rows > 0) {
                    // Loop melalui data hasil query
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['stock']}</td>";

                        $image_path = !empty($row['images']) ? $row['images'] : 'assets/img/produk/';
                        echo "<td><img src='assets/img/produk/{$image_path}' alt='Gambar Produk' width='100'></td>";

                        // Tombol operasi dengan desain baru
                        echo "<td class='text-center'>
                        <a href='read.php?id={$row['id']}' class='btn btn-primary'>
                        <i class='bi bi-eye'></i> View
                        </a>
                        <a href='update.php?id={$row['id']}' class='btn btn-secondary'>
                        <i class='bi bi-pencil'></i> Edit
                        </a>
                        <a href='delete.php?id={$row['id']}&redirect=manage_produk.php' 
                        onclick='return confirm(\"Yakin ingin menghapus data ini?\")' 
                        class='btn btn-danger'>
                        <i class='bi bi-trash'></i> Delete
                        </a>
                        </td>";
                    }
                } else {
                    // Jika tidak ada produk ditemukan
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada produk ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
</body>

</table>
</div>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
