<?php
include 'db.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Ambil data gambar dari form
    $image = $_FILES['images']['name']; // Ambil nama gambar yang diupload
    $image_tmp_name = $_FILES['images']['tmp_name']; // Ambil nama sementara gambar
    $image_folder = 'assets/img/produk/' . $image; // folder penyimpanan gambar

    // Proses upload gambar
    if (move_uploaded_file($image_tmp_name, $image_folder)) {
        $sql = "INSERT INTO products (name, price, stock, images) VALUES ('$name', '$price', '$stock', '$image')";
        
        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            $message = "Produk berhasil ditambahkan!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Gagal mengunggah gambar.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="assets/img/logo-2.png" alt="Logo Admin" class="logo">
            </div>
            <ul class="sidebar-menu">
                <li><a href="admin.php?page=dashboard" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li><a href="admin.php?page=produk"><i class="bi bi-box"></i> Produk</a></li>
                <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content">
                <h3>Tambah Produk Baru</h3>

                <!-- Menampilkan pesan setelah submit -->
                <?php if ($message): ?>
                    <p><?php echo $message; ?></p>
                <?php endif; ?>

                <!-- Form untuk menambah produk -->
                <form method="post" action="create.php" enctype="multipart/form-data">
                    <label for="name">Nama Produk:</label>
                    <input type="text" id="name" name="name" required><br>

                    <label for="price">Harga:</label>
                    <input type="number" id="price" name="price" required><br>

                    <label for="stock">Stok:</label>
                    <input type="number" id="stock" name="stock" required><br>

                    <label for="images">Gambar:</label>
                    <input type="file" id="images" name="images" accept="assets/img/*" required><br>

                    <input type="submit" name="submit" value="Tambah Produk">
                </form>
            </div>
        </main>
    </div>
</body>

</html>
