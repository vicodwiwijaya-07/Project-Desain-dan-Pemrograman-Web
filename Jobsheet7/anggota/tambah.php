<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

// Mengambil flash message jika ada error dari proses_tambah.php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<section>
    <h2>Tambah Anggota</h2>
    
    <!-- Menampilkan pesan error jika validasi gagal -->
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <form id="form-tambah" method="post" action="proses_tambah.php">
        <p>
            <label for="nim">NIM</label><br>
            <input type="text" id="nim" name="nim" required>
        </p>
        <p>
            <label for="nama">Nama Lengkap</label><br>
            <input type="text" id="nama" name="nama" required>
        </p>
        <p>
            <label for="telepon">No. Telepon</label><br>
            <input type="text" id="telepon" name="telepon" required>
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>