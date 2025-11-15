<?php
session_start();

// Pastikan ada array kontak
if (!isset($_SESSION['kontak'])) {
    $_SESSION['kontak'] = [];
}

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: index.php");
    exit();
}

$errors = [];
$data = [
    'nama' => '',
    'email' => '',
    'telepon' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil & trim input
    $data['nama'] = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $data['email'] = isset($_POST['email']) ? trim($_POST['email']) : '';
    $data['telepon'] = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';

    // Validasi Nama
    if ($data['nama'] === '') {
        $errors[] = "Nama harus diisi";
    } elseif (!preg_match("/^[a-zA-Z\\s]+$/", $data['nama'])) {
        $errors[] = "Nama hanya boleh mengandung huruf dan spasi";
    }

    // Validasi Email
    if ($data['email'] === '') {
        $errors[] = "Email harus diisi";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    // Validasi Telepon
    if ($data['telepon'] === '') {
        $errors[] = "Nomor telepon harus diisi";
    } elseif (!preg_match("/^[0-9+\\-\\s()]+$/", $data['telepon'])) {
        $errors[] = "Format nomor telepon tidak valid";
    }

    // Jika validasi sukses, simpan ke session & redirect
    if (empty($errors)) {
        // Simpan
        $_SESSION['kontak'][] = $data;

        // Redirect ke index agar data langsung terlihat
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background: #f5f7fa; }
        .card-custom { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .btn-primary { padding: 10px 24px; border-radius: 10px; font-weight: 600; height:44px; display:flex; align-items:center; justify-content:center; }
        .btn-secondary { padding: 10px 24px; border-radius: 10px; font-weight: 600; height:44px; display:flex; align-items:center; justify-content:center; }
        @media (max-width:420px) { .btn-primary, .btn-secondary { padding:8px 16px; height:40px; } }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h3 class="text-center mb-4 fw-bold">Tambah Kontak Baru</h3>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <h5 class="mb-2">Terjadi Kesalahan:</h5>
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="<?php echo htmlspecialchars($data['telepon']); ?>">
                    </div>

                    <!-- Tombol di Tengah, teks "Kembali" ter-center di dalam tombol -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-primary px-4 py-2 rounded-3">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">Simpan Perubahan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
