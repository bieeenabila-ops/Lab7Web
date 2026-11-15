<?php
$data = null;
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email = trim($_POST["email"] ?? "");

    if ($nama === "") $error[] = "Nama wajib diisi.";
    
    // Poin 4: Validasi NIM hanya berisi angka dan panjangnya 10 digit
    if ($nim === "") {
        $error[] = "NIM wajib diisi.";
    } elseif (!ctype_digit($nim) || strlen($nim) !== 10) {
        $error[] = "NIM harus berupa angka dan tepat 10 digit.";
    }

    if ($prodi === "") $error[] = "Program studi wajib diisi.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }
    if (!ctype_digit((string)$semesterInput) || (int)$semesterInput < 1 || (int)$semesterInput > 14) {
        $error[] = "Semester harus berupa angka 1-14.";
    }

    if (!$error) {
        $data = compact("nama", "nim", "prodi", "email");
        $data["semester"] = (int)$semesterInput;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Mahasiswa</title>
</head>
<body>
    <h2>Form Input Data Mahasiswa</h2>
    <form method="POST" action="">
        Nama: <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"><br><br>
        NIM (10 digit): <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>"><br><br>
        Prodi: <input type="text" name="prodi" value="<?= htmlspecialchars($_POST['prodi'] ?? '') ?>"><br><br>
        Semester: <input type="number" name="semester" value="<?= htmlspecialchars($_POST['semester'] ?? '') ?>"><br><br>
        Email: <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"><br><br>
        
        <button type="submit">Kirim</button>
        <!-- Poin 5: Tombol Reset -->
        <button type="reset">Reset</button>
    </form>

    <?php if ($error): ?>
        <ul style="color: red;">
            <?php foreach ($error as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($data): ?>
        <h3>Ringkasan Data Mahasiswa:</h3>
        <p>Nama: <?= htmlspecialchars($data['nama']) ?></p>
        <p>NIM: <?= htmlspecialchars($data['nim']) ?></p>
        <p>Prodi: <?= htmlspecialchars($data['prodi']) ?></p>
        <p>Semester: <?= $data['semester'] ?></p>
        <p>Email: <?= htmlspecialchars($data['email']) ?></p>
    <?php endif; ?>
</body>
</html>
php -S localhost:8000