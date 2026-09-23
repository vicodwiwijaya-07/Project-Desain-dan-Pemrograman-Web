<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/koneksi.php';

// 1. Ambil keyword dari URL (jika ada form pencarian yang disubmit)
$keyword = trim($_GET['q'] ?? '');

// 2. Modifikasi Query
if ($keyword !== '') {
     $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :keyword ORDER BY id DESC");
    // Tambahkan wildcard '%' di awal dan akhir keyword agar bisa mencari kata di tengah kalimat
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    $daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Jika tidak ada pencarian, tampilkan semua buku seperti biasa
    $daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Daftar Buku</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <p class="flash flash-<?php echo $_SESSION['flash']['type']; ?>"><?php echo htmlspecialchars($_SESSION['flash']['pesan']); ?></p>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- 3. Ubah div menjadi form method GET -->
    <form method="GET" action="" class="search-box">
        <label for="search-input">Cari Judul Buku</label>
        <!-- Tambahkan name="q" dan value agar keyword tidak hilang setelah disubmit -->
        <input type="text" id="search-input" name="q" placeholder="Ketik judul buku..." value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit">Cari</button>
        
        <?php if ($keyword !== ''): ?>
            <!-- Tombol reset untuk kembali melihat semua buku -->
            <a href="list.php"><button type="button">Reset</button></a>
        <?php endif; ?>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarBuku)): ?>
                    <tr>
                        <td colspan="6">
                            <?php echo ($keyword !== '') ? 'Buku dengan judul tersebut tidak ditemukan.' : 'Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".'; ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarBuku as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                            <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($buku['tahun']); ?></td>
                            <td><?php echo htmlspecialchars($buku['stok']); ?></td>
                            <td>
                                <?php 
                                echo !empty($buku['tanggal_ditambahkan']) 
                                    ? date('d-m-Y H:i', strtotime($buku['tanggal_ditambahkan'])) 
                                    : '-'; 
                                ?>
                            </td>
                            <td>
                                <button type="button">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>