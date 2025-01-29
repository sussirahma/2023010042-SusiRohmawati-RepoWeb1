<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'craft_c';

try {
    // Koneksi ke database menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Menangani error jika gagal koneksi
    die("Database connection failed: " . $e->getMessage());
}
?>