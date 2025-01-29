<?php
include("db.php");
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
