<?php
// 1. Panggil koneksi database
require_once __DIR__ . '/includes/koneksi.php';

echo "<h2>Memulai Migrasi Data JSON ke PostgreSQL...</h2>";

// 2. Baca isi file JSON
$file_json = __DIR__ . '/data/buku.json';

if (!file_exists($file_json)) {
    die("<p style='color:red;'>Error: File data/buku.json tidak ditemukan!</p>");
}

$json_data = file_get_contents($file_json);

// 3. Ubah teks JSON menjadi Array PHP agar bisa di-looping
// (Parameter true berarti kita mengubahnya menjadi Associative Array)
$buku_array = json_decode($json_data, true);

if ($buku_array === null) {
    die("<p style='color:red;'>Error: Format JSON tidak valid!</p>");
}

try {
    // TIPS PRO: Gunakan Transaction untuk proses migrasi/insert masal.
    // Ini membuat proses jauh lebih cepat dan aman (kalau 1 gagal, batal semua).
    $pdo->beginTransaction();

    // 4. Siapkan Query SQL
    $stmt = $pdo->prepare(
        "INSERT INTO buku (judul, pengarang, tahun, stok) 
         VALUES (:judul, :pengarang, :tahun, :stok)"
    );

    $jumlah_berhasil = 0;

    // 5. Looping data array, lalu masukkan ke database satu per satu
    foreach ($buku_array as $buku) {
        $stmt->execute([
            'judul'     => $buku['judul'],
            'pengarang' => $buku['pengarang'],
            'tahun'     => $buku['tahun'],
            'stok'      => $buku['stok']
        ]);
        
        echo "⏳ Berhasil menginput: <b>" . htmlspecialchars($buku['judul']) . "</b><br>";
        $jumlah_berhasil++;
    }

    // 6. Simpan semua perubahan ke dalam database secara permanen
    $pdo->commit();

    echo "<h3 style='color: green;'>✅ Migrasi Selesai! Total $jumlah_berhasil buku berhasil dipindahkan ke database.</h3>";
    echo "<a href='buku/list.php'><button>Lihat Hasil di Daftar Buku</button></a>";

} catch (PDOException $e) {
    // Jika ada error di tengah jalan, batalkan semua insert yang barusan terjadi!
    $pdo->rollBack();
    echo "<h3 style='color: red;'>❌ Migrasi Gagal: " . $e->getMessage() . "</h3>";
}
?>