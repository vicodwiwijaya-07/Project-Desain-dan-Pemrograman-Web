<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/koneksi.php';

$daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Daftar Buku</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <p class="flash flash-<?php echo $_SESSION['flash']['type']; ?>"><?php echo htmlspecialchars($_SESSION['flash']['pesan']); ?></p>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="search-box">
        <label for="search-input">Cari Judul Buku</label>
        <input type="text" id="search-input" placeholder="Ketik judul buku...">
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Tanggal Ditambahkan</th> <!-- Kolom Baru -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarBuku)): ?>
                    <tr>
                        <!-- Ubah colspan jadi 6 karena sekarang ada 6 kolom -->
                        <td colspan="6">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarBuku as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                            <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($buku['tahun']); ?></td>
                            <td><?php echo htmlspecialchars($buku['stok']); ?></td>
                            
                            <!-- <Menampilkan kolom tanggal dengan format (Tanggal-Bulan-Tahun Jam:Menit)  -->
                            <td>
                                <?php 
                                // Jika tanggalnya kosong/null, tampilkan '-', jika ada tampilkan format tanggal
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