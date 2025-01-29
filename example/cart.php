<?php
session_start();

if (isset($_POST['cart'])) {
    $menu_id = $_POST['menu_id'];

    // Jika item sudah ada di keranjang, jumlahnya ditambah 1
    $_SESSION['cart'][$menu_id] = ($_SESSION['cart'][$menu_id] ?? 0) + 1;
    
    // Menyimpan pesan untuk pemberitahuan sukses
    $_SESSION['message'] = "Item berhasil ditambahkan ke keranjang!";
    
    // Redirect kembali ke halaman menu setelah menambahkan ke keranjang
    header("Location: menu.php");
    exit;
}
