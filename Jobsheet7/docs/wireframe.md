Aktor
●	Tamu: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
●	Petugas: login untuk mengakses seluruh fitur CRUD dan transaksi peminjaman.


User Flow — Peminjaman Buku

[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman Baru"]
        -> [Pilih Anggota] -> [Pilih Buku (stok > 0)]
        -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]


User Flow — Pengembalian Buku

[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (anggota/buku)]
        -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
        -> [Kembali ke Dashboard]


+--------------------------------------+
|              SIMPUS-Mini             |
|--------------------------------------|
|                                      |
|        [ Login Petugas ]             |
|                                      |
|   Username : [______________]        |
|   Password : [______________]        |
|                                      |
|          [   Masuk   ]               |
|                                      |
|   Belum punya akun? Daftar di sini   |
+--------------------------------------+


+-------------------------------------------------------+
| SIMPUS-Mini      Beranda | Buku | Anggota | Peminjaman | (Nama
Petugas) Logout |
|-------------------------------------------------------|
|  [Total Buku]   [Total Anggota]   [Sedang Dipinjam]   |
|                                                       |
|  Aksi Cepat:                                          |
|  [ + Peminjaman Baru ]   [ + Pengembalian ]           |
|                                                       |
|  Transaksi Terbaru                                    |
|  --------------------------------------------------   |
|  Anggota | Buku | Tgl Pinjam | Status                 |
+-------------------------------------------------------+



Wireframe: Form Peminjaman
+--------------------------------------+
|  Form Peminjaman Buku                |
|--------------------------------------|
|  Anggota : [ dropdown pilih anggota ]|
|  Buku    : [ dropdown, hanya stok>0 ]|
|  Tanggal Pinjam : [ auto: hari ini ] |
|                                      |
|          [  Simpan Peminjaman  ]     |
+--------------------------------------+


Wireframe: Form Pengembalian
+--------------------------------------+
|  Pengembalian Buku                   |
|--------------------------------------|
|  Cari transaksi aktif:               |
|  [ nama anggota / judul buku ______ ]|
|                                      |
|  Anggota | Buku | Tgl Pinjam | [Kembalikan] |
+--------------------------------------+


Wireframe: Riwayat Peminjaman per Anggota
+--------------------------------------+
|  Riwayat Peminjaman — Siti Aminah    |
|--------------------------------------|
|  Buku            | Pinjam   | Kembali | Status      |
|  Laskar Pelangi   | 01/07    | 10/07   | Selesai     |
|  Bumi Manusia      | 15/07    | -       | Dipinjam    |
+--------------------------------------+


+----------------------------------------------------------------------------------+
| SIMPUS-Mini                  Beranda | Daftar Buku | Daftar Anggota | Masuk      |
|----------------------------------------------------------------------------------|
|                                                                                  |
|  [ Registrasi Anggota Baru ]                                                     |
|  Silakan isi formulir di bawah ini untuk mendaftar sebagai anggota.              |
|                                                                                  |
|  Nama Lengkap     : [__________________________________________________________] |
|                                                                                  |
|  Nomor Identitas: [__________________________________________________________] |
|  (NIS / NIM / NIK)                                                               |
|                                                                                  |
|  Alamat Lengkap   : [__________________________________________________________] |
|                     [__________________________________________________________] |
|                                                                                  |
|  Nomor Telepon    : [__________________________________________________________] |
|                                                                                  |
|  Email            : [__________________________________________________________] |
|                                                                                  |
|  Kata Sandi       : [__________________________________________________________] |
|                                                                                  |
|  Konfirmasi Sandi: [__________________________________________________________] |
|                                                                                  |
|                             [ Daftar Menjadi Anggota ]                           |
|                                                                                  |
|  Sudah punya akun anggota? [ Masuk di sini ]                                     |
|                                                                                  |
+----------------------------------------------------------------------------------+


+-------------------------------------------------------------+
| SIMPUS-Mini                     Beranda | Buku | Login/Daftar |
|-------------------------------------------------------------|
|                                                             |
|  [ Registrasi Anggota Baru ]                                |
|  Silakan lengkapi form di bawah ini untuk menjadi anggota.  |
|                                                             |
|  Nama Lengkap     : [__________________________________]    |
|  Nomor Identitas  : [__________________________________]    |
|  (NIS/NIM/NIK)                                              |
|                                                             |
|  Alamat Lengkap   : [__________________________________]    |
|                     [__________________________________]    |
|                                                             |
|  No. Telepon      : [__________________________________]    |
|  Email            : [__________________________________]    |
|  Password         : [__________________________________]    |
|                                                             |
|                   [ Daftar Menjadi Anggota ]                |
|                                                             |
|  Sudah punya akun? [ Masuk di sini ]                        |
+-------------------------------------------------------------+

8. Buku stok habis tidak boleh dipilih di form Peminjaman — ini sudah muncul juga di user flow (bab 3 §3.2,catatan (stok > 0)). Data stok ini sudah ada sejak jobsheet-01: lihat kolom "Stok" di tabel Daftar Buku — nantinya tinggal ditambah logika pengecekan stok > 0 saat menampilkan pilihan buku di form Peminjaman. 
9. Anggota dengan tunggakan terlambat — kasus ini ditandai untuk ditangani di "Jobsheet 12 (tugas mandiri)", menunjukkan bahwa tidak semua detail perlu diselesaikan sekaligus; mencatatnya di tahap rancangan memastikan kasus ini tidak terlupakan meski implementasinya ditunda ke jobsheet lain.