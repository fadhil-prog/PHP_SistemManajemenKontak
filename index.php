<?php
session_start();

/* ----------------------------------------------------
   SESSION TIMEOUT 30 MENIT
---------------------------------------------------- */
$timeout_duration = 1800; // 30 menit = 1800 detik

// Jika user sedang login
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    // Jika sebelumnya tercatat aktivitas terakhir
    if (isset($_SESSION['last_activity'])) {

        // Jika lebih dari 30 menit tidak aktif → logout
        if (time() - $_SESSION['last_activity'] > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
    }

    // Perbarui waktu aktivitas terakhir
    $_SESSION['last_activity'] = time();
}


/* ----------------------------------------------------
   INISIALISASI KONTAK
---------------------------------------------------- */
if (!isset($_SESSION['kontak'])) {
    $_SESSION['kontak'] = [];
}


/* ----------------------------------------------------
   PROSES LOGIN
---------------------------------------------------- */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "123456") {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Set waktu aktivitas awal
        $_SESSION['last_activity'] = time();

    } else {
        $login_error = "Username atau password salah!";
    }
}


/* ----------------------------------------------------
   LOGOUT
---------------------------------------------------- */
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="text-center mb-4 fw-bold">Sistem Manajemen Kontak</h2>

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>

        <div class="alert alert-primary d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</h5>
            </div>
            <a href="index.php?action=logout" class="btn btn-danger btn-sm">Logout</a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-semibold">Daftar Kontak</h4>
            <a href="tambah.php" class="btn btn-success">+ Tambah Kontak Baru</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($_SESSION['kontak'])): ?>
                            <tr>
                                <td colspan="4" class="text-center py-3">Belum ada data kontak.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($_SESSION['kontak'] as $index => $kontak): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($kontak['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($kontak['email']); ?></td>
                                    <td><?php echo htmlspecialchars($kontak['telepon']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $index; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="hapus.php?id=<?php echo $index; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kontak ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php else: ?>

        <div class="card shadow-sm mx-auto" style="max-width: 450px;">
            <div class="card-body">
                <h4 class="text-center mb-3">Login</h4>

                <?php if (isset($login_error)): ?>
                    <div class="alert alert-danger"> <?php echo $login_error; ?> </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="admin" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="123456" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-muted mt-3 text-center small">Hint: admin / 123456</p>
            </div>
        </div>

    <?php endif; ?>
</div>

</body>
</html>
