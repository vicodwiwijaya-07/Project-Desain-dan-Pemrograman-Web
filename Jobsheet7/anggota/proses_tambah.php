<?php
session_start();

// 1. Menerima Data Form
$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');

// 2. Validasi Server-Side
$errors = [];
if ($nim === '') {
    $errors[] = "NIM wajib diisi.";
} elseif (!is_numeric($nim)) {
    $errors[] = "NIM harus berupa angka.";
}
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($telepon === '') {
    $errors[] = "No. Telepon wajib diisi.";
}

// 3. Kalau Ada Error: Simpan Flash Message & Redirect Kembali
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

// 4. Kalau Valid: Simpan ke Session Anggota
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

$_SESSION['anggota'][] = [
    'nim' => $nim,
    'nama' => $nama,
    'telepon' => $telepon
];

// 5. Simpan Flash Message Sukses & Redirect ke Daftar
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
header('Location: list.php');
exit;