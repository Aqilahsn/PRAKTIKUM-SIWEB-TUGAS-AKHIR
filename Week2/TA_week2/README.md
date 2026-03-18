## Sistem Manajemen Stok Risol Majesty
Deskripsi Project

Project ini merupakan aplikasi web sederhana yang dibuat untuk membantu mengelola stok dan data produk risol dengan brand Risol Majesty. Website ini dibangun menggunakan HTML5, Bootstrap 5, dan CSS3 agar tampilannya rapi, modern, serta tetap responsif ketika dibuka di berbagai perangkat.

Aplikasi ini masih bersifat statis dan belum terhubung dengan database, sehingga fokus utamanya ada pada tampilan antarmuka dan validasi form.

## Fitur Utama

Dashboard yang menampilkan ringkasan jumlah varian, stok, dan total penjualan

Daftar 6 varian produk lengkap dengan harga dan stok

Form untuk menambahkan produk baru dengan validasi

Tampilan responsif untuk desktop, tablet, dan mobile

Desain dengan tema warna hangat yang sesuai dengan konsep produk makanan

## Varian Produk

Risol Matcha Premium – Rp 12.000

Risol Coklat Lezat – Rp 12.000

Risol Bolognese Istimewa – Rp 14.000

Risol Mozzarella Keju – Rp 15.000

Risol Beef Premium – Rp 16.000

Risol Tiramisu Manis – Rp 13.000

## Struktur Folder
TA_week1/
├── index.html       (Dashboard & daftar produk)
├── manage.html      (Form tambah produk)
├── css/
│   └── style.css    (File styling eksternal)
└── README.md        (Dokumentasi project)
Teknologi yang Digunakan

HTML5 untuk struktur halaman

Bootstrap 5 (via CDN) untuk layout dan responsivitas

Bootstrap Icons (via CDN) untuk penggunaan ikon

CSS3 untuk penyesuaian tampilan sesuai tema Risol Majesty

## Cara Menjalankan
Membuka Project

Ekstrak folder TA_week1, lalu buka file index.html dengan cara:

Klik dua kali file tersebut

Drag ke browser

Atau gunakan Live Server di VS Code

Navigasi Halaman

index.html digunakan sebagai halaman utama (dashboard dan daftar produk)

manage.html digunakan untuk menambahkan produk baru

Gunakan navbar untuk berpindah antar halaman

Menggunakan Form Input

## Pada halaman "Kelola Produk":

Isi nama risol

Pilih varian dari dropdown

Masukkan harga satuan (minimal Rp 1.000)

Masukkan jumlah stok (minimal 1)

Klik tombol Simpan Produk

Semua field wajib diisi agar proses validasi berhasil.

## Fitur Tambahan

Card produk memiliki efek hover agar tampil lebih interaktif

Tampilan sudah responsif untuk berbagai ukuran layar

Validasi form menggunakan fitur bawaan Bootstrap dan HTML5

Library eksternal menggunakan CDN agar loading lebih ringan

Konsep Warna

Primary – #D2691E

Dark – #8B4513

Light – #FFD4A3

Accent – #FF9800

Catatan Pengembangan

Data yang disimpan belum terhubung ke database

Notifikasi muncul setelah form berhasil dikirim

Gambar produk masih menggunakan placeholder

Author

Tugas Akhir Praktikum Sistem Informasi Berbasis Web
162023031 – Aqila Hasna N.G