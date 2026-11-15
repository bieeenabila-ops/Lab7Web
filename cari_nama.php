<?php
$daftarMahasiswa = ["Andi", "Budi", "Citra", "Dewi", "Eka"];
$keyword = trim($_GET["cari"] ?? "");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Nama Mahasiswa</title>
</head>
<body>
    <h2>Pencarian Nama (Metode GET)</h2>
    <form method="GET" action="">
        <input type="text" name="cari" placeholder="Ketik nama..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
    </form>
    <br>

    <?php if ($keyword !== ""): ?>
        <?php 
        $ditemukan = false;
        foreach ($daftarMahasiswa as $nama) {
            if (stripos($nama, $keyword) !== false) {
                echo "Nama ditemukan: <b>" . htmlspecialchars($nama) . "</b><br>";
                $ditemukan = true;
            }
        }
        if (!$ditemukan) {
            echo "Nama '" . htmlspecialchars($keyword) . "' tidak ditemukan dalam array.";
        }
        ?>
    <?php endif; ?>
</body>
</html>