<?php
session_start();
require 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $email = $_POST['email'];

    $query = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 'customer')";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([$username, $password, $email])) {
        $_SESSION['message'] = "Registrasi berhasil, silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Registrasi gagal.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1 class="lo-re">Registrasi</h1>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit" name="register">Daftar</button>
    </form>
</body>

</html>