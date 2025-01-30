<?php
// Include koneksi ke database
include("db.php");

// Cek apakah parameter ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data produk berdasarkan ID
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = $conn->query($sql);

    // Jika data produk ditemukan, ambil data dari hasil query
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak ditemukan.";
    exit();
}

// Proses update data produk setelah form disubmit
if (isset($_POST['update'])) {
    // Ambil data dari form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Sanitasi input untuk mencegah SQL Injection
    $id = $conn->real_escape_string($id);
    $name = $conn->real_escape_string($name);
    $price = $conn->real_escape_string($price);
    $stock = $conn->real_escape_string($stock);

    // Proses gambar baru (jika ada)
    $image = '';
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageError = $_FILES['image']['error'];

        // Validasi ukuran dan ekstensi file
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExt, $allowedExt) && $imageSize <= 5000000) { // 5MB max size
            $newImageName = uniqid('', true) . '.' . $imageExt;
            $imageUploadPath = 'assets/img/' . $newImageName;

            if (move_uploaded_file($imageTmpName, $imageUploadPath)) {
                $image = $newImageName; // Set the image name for the database
            } else {
                echo "Gagal mengunggah gambar.";
                exit();
            }
        } else {
            echo "Tipe file tidak didukung atau file terlalu besar.";
            exit();
        }
    }

    // Update query (gunakan gambar baru jika ada)
    if ($image) {
        $sql = "UPDATE products SET name='$name', price='$price', stock='$stock', image='$image' WHERE id='$id'";
    } else {
        $sql = "UPDATE products SET name='$name', price='$price', stock='$stock' WHERE id='$id'";
    }

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil diupdate!";
        header("Location: admin.php"); // Redirect setelah update
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

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

    <!-- Sidebar -->
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

        <!-- Main Content -->
        <div class="main-content">
            <div class="content">
                <h3>Edit Produk</h3>
                <!-- Form untuk mengedit produk -->
                <form action="update.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- ID produk disembunyikan -->

                    <div class="form-group mb-3">
                        <label for="name">Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Harga</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="stock">Stok</label>
                        <input type="number" class="form-control" name="stock" value="<?php echo $row['stock']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Gambar Produk</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>

                    <?php if (!empty($row['image'])): ?>
                        <div class="mb-3">
                            <img src="assets/img/<?php echo $row['image']; ?>" alt="Gambar Produk" width="150">
                        </div>
                    <?php endif; ?>

                    <button type="submit" name="update" class="btn btn-primary w-100">Simpan Perubahan</button>
                    <a href="admin.php" class="btn btn-secondary w-100 mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan Bootstrap JS jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
