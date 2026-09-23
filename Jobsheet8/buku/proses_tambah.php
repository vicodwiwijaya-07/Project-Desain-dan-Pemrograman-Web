<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = trim($_POST['tahun'] ?? '');
    $isbn      = trim($_POST['isbn'] ?? '');
    $stok      = trim($_POST['stok'] ?? '');
    $kategori  = trim($_POST['kategori'] ?? '');

    if (empty($judul) || empty($pengarang) || empty($tahun) || !is_numeric($tahun)) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'Data tidak valid. Mohon isi field wajib.'];
        header('Location: tambah.php');
        exit;
    }

    $stmt = $pdo->prepare(
        "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori)
         VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
         RETURNING id"
    );

    $stmt->execute([
        'judul'     => $judul,
        'pengarang' => $pengarang,
        'tahun'     => (int) $tahun,
        'isbn'      => $isbn,
        'stok'      => (int) $stok,
        'kategori'  => $kategori,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
    header('Location: list.php');
    exit;
}
