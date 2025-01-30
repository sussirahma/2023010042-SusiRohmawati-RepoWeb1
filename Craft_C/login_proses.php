<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escape user inputs for security
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query untuk mengecek apakah username dan password cocok
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login sukses, set session
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php"); // Halaman setelah login berhasil
        exit();
    } else {
        // Login gagal, set pesan error
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: login.php"); // Redirect kembali ke halaman login
        exit();
    }
} else {
    // Jika bukan POST, redirect kembali ke halaman login
    header("Location: login.php");
    exit();
}
