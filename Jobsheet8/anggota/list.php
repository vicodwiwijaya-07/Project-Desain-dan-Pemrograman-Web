<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/koneksi.php';

$daftarAnggota = $pdo->query("SELECT * FROM anggota ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Daftar Anggota</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <p class="flash flash-<?php echo $_SESSION['flash']['type']; ?>"><?php echo htmlspecialchars($_SESSION['flash']['pesan']); ?></p>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarAnggota)): ?>
                    <tr>
                        <td colspan="5">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarAnggota as $anggota): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($anggota['no_anggota']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['nama']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['no_hp']); ?></td>
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