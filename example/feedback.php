<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Pengguna harus login terlebih dahulu
    exit;
}

if (isset($_POST['submit_feedback'])) {
    $user_id = $_SESSION['user']['id_user'];
    $pesan = $_POST['pesan'];
    $rating = $_POST['rating'];

    $query = "INSERT INTO feedback (id_user, pesan, rating) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    if ($stmt->execute([$user_id, $pesan, $rating])) {
        $_SESSION['message'] = "Feedback berhasil dikirim.";
        header("Location: feedback.php");
        exit;
    } else {
        $_SESSION['error'] = "Feedback gagal dikirim.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>

<body>
    <h1>Feedback</h1>
    <form action="" method="POST">
        <textarea name="pesan" placeholder="Tulis feedback Anda" required></textarea><br>
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>
        <button type="submit" name="submit_feedback">Kirim Feedback</button>
    </form>
</body>

</html>