<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Penggunaan List dalam HTML</title>
</head>
<!--
Dalam HTML
<body>
    <h2>Daftar Nama barang</h2>
    <ol>
        <li>Barang ke-1</li>
        <li>Barang ke-2</li>
        <li>Barang ke-3</li>
        <li>Barang ke-4</li>
        <li>Barang ke-5</li>
        <li>Barang ke-6</li>
        <li>Barang ke-7</li>
        <li>Barang ke-8</li>
        <li>Barang ke-9</li>
        <li>Barang ke-10</li>
        <li>Dan seterusnya sampai ke-50</li>
    </ol>
</body>
-->

<body>
    <h2>Daftar Nama Barang</h2>
    <ol>
        <?php
        for ($i = 1; $i <= 50; $i++) {
            echo "<li>Barang ke-$i</li>";
        }
        ?>
    </ol>
</body>

</html>