# 🧪 Testing E-Commerce Application

Panduan lengkap untuk testing semua fitur aplikasi E-Commerce Laravel.

---

## ✅ Test Checklist

### A. Testing Authentication

#### 1. Register User Baru
```
📍 URL: http://127.0.0.1:8000/register

Test Case:
□ Buka halaman register
□ Lihat form dengan field: Name, Email, Password, Password Confirmation
□ Isi form dengan data valid:
  - Name: "Test User"
  - Email: "testuser@example.com"
  - Password: "password123"
  - Password Confirmation: "password123"
□ Klik tombol "✍️ Daftar Sekarang"
□ Redirect ke halaman login
□ Lihat pesan success "Registrasi berhasil! Silakan login."

Expected Result: ✅ User baru terbuat, bisa login dengan email baru
```

#### 2. Login Admin
```
📍 URL: http://127.0.0.1:8000/login

Test Case:
□ Input Email: admin@example.com
□ Input Password: password123
□ Klik "🔐 Login"
□ Redirect ke: http://127.0.0.1:8000/admin/dashboard
□ Lihat navbar menampilkan:
  - "📊 Dashboard Admin"
  - "📦 Produk"
  - Nama user: "Admin"
  - Tombol "Logout"

Expected Result: ✅ Admin berhasil login dan redirect ke dashboard admin
```

#### 3. Login User Biasa
```
📍 URL: http://127.0.0.1:8000/login

Test Case:
□ Input Email: user@example.com
□ Input Password: password123
□ Klik "🔐 Login"
□ Redirect ke: http://127.0.0.1:8000/ (landing page)
□ Lihat navbar menampilkan:
  - "🏠 Beranda"
  - "🛍️ Keranjang"
  - Nama user: "User Biasa"
  - Tombol "Logout"

Expected Result: ✅ User berhasil login dan redirect ke landing page
```

#### 4. Logout
```
Test Case:
□ Jika sudah login (sebagai admin atau user)
□ Klik tombol "Logout" di navbar
□ Redirect ke halaman beranda
□ Session dihapus

Expected Result: ✅ User berhasil logout, tidak bisa akses route /admin tanpa login ulang
```

#### 5. Try Akses Admin Route Sebagai User
```
Test Case:
□ Login sebagai user biasa
□ Coba akses langsung: http://127.0.0.1:8000/admin/dashboard
□ Akan di-redirect ke halaman beranda
□ Lihat pesan error: "Anda tidak memiliki akses ke halaman ini."

Expected Result: ✅ User tidak bisa akses route admin (middleware protection)
```

---

### B. Testing Admin Features

#### 1. Dashboard Admin
```
📍 URL: http://127.0.0.1:8000/admin/dashboard

Test Case:
□ Login sebagai admin@example.com
□ Lihat statistik kartu:
  - 📦 Total Produk: 15
  - 📂 Total Kategori: 5
  - 👥 Total Pengguna: 2
□ Lihat section "Manajemen Produk"
□ Lihat section "Manajemen Kategori"
□ Lihat section "Akses Cepat" dengan 4 tombol

Expected Result: ✅ Dashboard menampilkan semua informasi dengan benar
```

#### 2. Daftar Produk (Index)
```
📍 URL: http://127.0.0.1:8000/admin/products

Test Case:
□ Klik "📦 Daftar Produk" di dashboard
□ Lihat tabel produk dengan kolom:
  - #, Nama Produk, Harga, Stok, Kategori, Aksi
□ Lihat 15 produk tersedia
□ Produk pertama "Laptop Gaming ASUS ROG":
  - Harga: Rp 15.000.000
  - Stok: 5
  - Kategori: Elektronik, Gaming
□ Ada tombol "✏️ Edit" dan "🗑️ Hapus" untuk setiap produk

Expected Result: ✅ Daftar produk menampilkan semua data dengan pagination
```

#### 3. Tambah Produk
```
📍 URL: http://127.0.0.1:8000/admin/products/create

Test Case:
□ Klik "➕ Tambah Produk Baru" atau akses URL langsung
□ Lihat form dengan field:
  - Nama Produk
  - Deskripsi Produk
  - Harga (Rp)
  - Stok
  - Kategori Produk (checkbox multiple)
□ Isi form:
  - Nama: "Tablet Samsung Galaxy Tab"
  - Deskripsi: "Tablet 10 inch dengan layar AMOLED"
  - Harga: 5000000
  - Stok: 8
  - Kategori: Centang "Elektronik" dan "Gaming"
□ Klik "💾 Simpan Produk"
□ Redirect ke daftar produk
□ Lihat pesan success: "Produk berhasil ditambahkan."
□ Produk baru ada di daftar

Expected Result: ✅ Produk baru berhasil dibuat dengan kategori yang dipilih
```

#### 4. Edit Produk
```
📍 URL: http://127.0.0.1:8000/admin/products/{id}/edit

Test Case:
□ Di halaman daftar produk, klik "✏️ Edit" pada salah satu produk
□ Form pre-filled dengan data produk
□ Ubah beberapa field:
  - Nama: Tambah "(UPDATED)" di akhir
  - Harga: Ubah ke 1500000
□ Ubah kategori:
  - Uncheck kategori yang sudah ada
  - Check kategori baru
□ Klik "💾 Perbarui Produk"
□ Redirect ke daftar produk
□ Lihat pesan success: "Produk berhasil diperbarui."
□ Cek perubahan di daftar produk

Expected Result: ✅ Produk berhasil diupdate dengan data baru dan kategori baru
```

#### 5. Hapus Produk
```
Test Case:
□ Di halaman daftar produk, klik "🗑️ Hapus" pada salah satu produk
□ Muncul confirm dialog: "Yakin ingin menghapus produk ini?"
□ Klik OK di dialog
□ Redirect ke daftar produk
□ Lihat pesan success: "Produk berhasil dihapus."
□ Produk tidak ada di daftar lagi
□ Total produk berkurang (di dashboard jadi 16 atau kurang)

Expected Result: ✅ Produk berhasil dihapus dari database dan tampilan
```

#### 6. Validasi Form Produk
```
Test Case:
□ Buka form tambah produk
□ Submit form kosong
□ Lihat error messages:
  - "Nama Produk wajib diisi"
  - "Harga wajib diisi"
  - "Stok wajib diisi"
□ Input harga negatif
□ Lihat error: "Harga minimal 0"
□ Input stok bukan angka
□ Lihat error handling

Expected Result: ✅ Validasi form berfungsi dengan baik
```

---

### C. Testing User Features

#### 1. Landing Page (Daftar Produk)
```
📍 URL: http://127.0.0.1:8000/

Test Case (tanpa login):
□ Buka halaman utama
□ Lihat hero section "🛍️ Toko Online Modern"
□ Lihat grid produk dengan card:
  - Gambar placeholder
  - Nama produk
  - Deskripsi
  - Kategori (badge)
  - Harga (warna purple)
  - Status stok
  - Tombol "🔐 Login untuk Membeli"
□ Scroll dan lihat pagination
□ Klik "🔐 Login untuk Membeli"
□ Redirect ke halaman login

Expected Result: ✅ Landing page menampilkan produk, user belum login harus login dulu
```

#### 2. Landing Page Setelah Login
```
Test Case (setelah login):
□ Login sebagai user@example.com
□ Buka halaman beranda
□ Tombol di card produk berubah:
  - Input field untuk quantity
  - Tombol "🛒 Keranjang"
□ Lihat navbar ada "🛍️ Keranjang" dengan badge angka
□ Klik salah satu tombol "🛒 Keranjang"
□ Lihat notifikasi success

Expected Result: ✅ User bisa menambah produk ke keranjang
```

#### 3. Tambah Produk ke Keranjang
```
Test Case:
□ Di landing page, pilih produk
□ Input quantity: 2
□ Klik "🛒 Keranjang"
□ Lihat notifikasi: "✅ [Nama Produk] ditambahkan ke keranjang."
□ Badge di navbar bertambah
□ Tambah produk lain:
  - Quantity: 3
  - Klik "🛒 Keranjang"
□ Badge sekarang menunjukkan 2 (2 jenis produk)

Expected Result: ✅ Produk berhasil ditambahkan ke session cart
```

#### 4. Lihat Keranjang
```
📍 URL: http://127.0.0.1:8000/cart

Test Case:
□ Klik "🛍️ Keranjang" di navbar
□ Lihat halaman cart dengan tabel:
  - Kolom: Produk, Harga, Jumlah, Subtotal, Aksi
  - Lihat 2 item yang ditambahkan sebelumnya
  - Setiap row menampilkan:
    - Nama produk dan kategorinya
    - Harga per unit
    - Jumlah dengan input field
    - Tombol ✓ untuk update
    - Tombol 🗑️ Hapus
□ Di sisi kanan lihat "Ringkasan Pesanan":
  - Jumlah Item: 2 Produk
  - Total: [Rp total]
  - Tombol "🗑️ Kosongkan Keranjang"
  - Tombol "✅ Lanjut ke Pembayaran"

Expected Result: ✅ Keranjang menampilkan semua item dengan hitung yang benar
```

#### 5. Update Jumlah Item di Keranjang
```
Test Case:
□ Di halaman cart, ubah quantity salah satu item:
  - Dari 2 menjadi 5
□ Klik tombol "✓"
□ Halaman refresh
□ Lihat quantity berubah jadi 5
□ Subtotal dan total berubah sesuai perhitungan
□ Lihat notifikasi: "✅ Keranjang berhasil diperbarui."

Expected Result: ✅ Quantity update berfungsi dengan benar
```

#### 6. Hapus Item dari Keranjang
```
Test Case:
□ Di halaman cart, klik "🗑️ Hapus" pada salah satu item
□ Confirm dialog: "Yakin ingin menghapus?"
□ Klik OK
□ Item dihapus dari tabel
□ Total dan badge navbar berkurang
□ Lihat notifikasi success

Expected Result: ✅ Item berhasil dihapus dari keranjang
```

#### 7. Kosongkan Keranjang
```
Test Case:
□ Pastikan ada item di keranjang
□ Klik "🗑️ Kosongkan Keranjang"
□ Confirm dialog: "Yakin ingin mengosongkan keranjang?"
□ Klik OK
□ Tabel kosong
□ Badge navbar hilang
□ Lihat empty state message

Expected Result: ✅ Semua item dihapus, keranjang kosong
```

#### 8. Keranjang Kosong State
```
Test Case:
□ Kosongkan keranjang
□ Lihat halaman cart
□ Tampil empty state:
  - Icon 🛍️
  - Title: "Keranjang Kosong"
  - Pesan: "Belum ada produk..."
  - Tombol: "Mulai Berbelanja"
□ Klik "Mulai Berbelanja"
□ Redirect ke landing page

Expected Result: ✅ Empty state menampilkan dengan baik
```

#### 9. Kategori Tampil di Produk
```
Test Case:
□ Di landing page atau cart, lihat produk
□ Lihat kategori dengan badge (contoh: "Elektronik", "Gaming")
□ Badge menampilkan dengan benar sesuai relasi many-to-many
□ Produk bisa punya 1+ kategori

Expected Result: ✅ Relasi many-to-many bekerja dengan baik
```

---

### D. Testing Navigation & UI

#### 1. Navbar User
```
Test Case (user login):
□ Lihat navbar gradient purple
□ Logo: "🛒 E-Commerce"
□ Menu: "🏠 Beranda", "🛍️ Keranjang"
□ User info: "👤 User Biasa"
□ Tombol "Logout"
□ Klik logo redirect ke beranda
□ Klik "Beranda" tetap di halaman atau refresh

Expected Result: ✅ Navbar responsive dan fungsional
```

#### 2. Navbar Admin
```
Test Case (admin login):
□ Lihat navbar gradient purple
□ Menu: "📊 Dashboard Admin", "📦 Produk"
□ User info: "👤 Admin"
□ Tombol "Logout"
□ Klik setiap menu berfungsi dengan baik

Expected Result: ✅ Navbar admin menampilkan menu yang sesuai
```

#### 3. Footer
```
Test Case:
□ Scroll ke bawah halaman manapun
□ Lihat footer dengan 4 kolom:
  - Tentang Kami
  - Kategori
  - Bantuan
  - Sosial Media
□ Ada copyright text

Expected Result: ✅ Footer menampilkan di semua halaman
```

#### 4. Responsive Design (Mobile)
```
Test Case:
□ Buka aplikasi di mobile browser (bisa pake browser dev tools)
□ Lihat navbar collapse menjadi hamburger menu
□ Klik hamburger buka menu
□ Layout produk jadi single column
□ Form dan table responsive
□ Button tetap clickable

Expected Result: ✅ Design responsive dan mobile-friendly
```

---

### E. Testing Database Integrity

#### 1. Foreign Key Constraint
```
Test Case:
□ Di admin, hapus kategori yang punya relation dengan product
□ Akan error atau cascade delete berfungsi
□ Produk yang pakai kategori akan dihapus categorynya

Expected Result: ✅ Constraint integrity terjaga
```

#### 2. Unique Constraint Category Product
```
Test Case:
□ Coba tambah produk dengan kategori yang sama 2x
□ System tidak boleh allow duplicate relationship
□ Akan error di database

Expected Result: ✅ Tidak bisa tambah kategori yang sama untuk 1 produk
```

#### 3. Pivot Table Data
```
Test Case:
□ Query database (HeidiSQL):
  SELECT * FROM category_product;
□ Lihat relasi produk dan kategori
□ Lihat contoh:
  - Product ID 1 (Laptop) punya 2 kategori
  - Product ID 2 (Mouse) punya 2 kategori

Expected Result: ✅ Pivot table berisi data relasi dengan benar
```

---

### F. Testing Session Cart

#### 1. Session Persist
```
Test Case:
□ Tambah produk ke keranjang
□ Refresh halaman (F5)
□ Keranjang masih ada
□ Close browser
□ Buka ulang aplikasi
□ Jika sudah logout, keranjang hilang (session baru)
□ Jika masih login, keranjang masih ada

Expected Result: ✅ Session cart persist selama session aktif
```

#### 2. Quantity Persistence
```
Test Case:
□ Ubah quantity item
□ Refresh halaman
□ Quantity masih sesuai yang diubah
□ Logout & login ulang
□ Keranjang kosong (session baru)

Expected Result: ✅ Quantity update persisten di session
```

---

### G. Testing Error Handling

#### 1. Login dengan Email Salah
```
Test Case:
□ Buka login page
□ Input email salah: wrongemail@example.com
□ Input password: password123
□ Klik login
□ Lihat error: "Email atau password salah."
□ Tetap di halaman login

Expected Result: ✅ Error handling menampilkan pesan yang jelas
```

#### 2. Login dengan Password Salah
```
Test Case:
□ Input email: admin@example.com
□ Input password: wrongpassword
□ Klik login
□ Lihat error: "Email atau password salah."

Expected Result: ✅ Password validation bekerja
```

#### 3. Register Email Sudah Ada
```
Test Case:
□ Buka register
□ Input email: admin@example.com (yang sudah ada)
□ Isi field lain dengan valid
□ Klik register
□ Lihat error: "Email sudah terdaftar"

Expected Result: ✅ Unique email constraint diterapkan
```

#### 4. Akses Route yang Tidak Ada
```
Test Case:
□ Akses: http://127.0.0.1:8000/tidak-ada
□ Lihat halaman 404 atau error page

Expected Result: ✅ 404 page menampilkan
```

---

### H. Testing Permission & Access Control

#### 1. Try Edit Product Sebagai User
```
Test Case:
□ Login sebagai user
□ Coba akses: http://127.0.0.1:8000/admin/products/1/edit
□ Akan redirect ke beranda dengan error message

Expected Result: ✅ User tidak bisa akses edit produk
```

#### 2. Direct Database Access Prevention
```
Test Case:
□ User tidak bisa edit/delete produk via form
□ Admin bisa edit/delete produk

Expected Result: ✅ Role-based access berfungsi
```

---

## 🧮 Data Verification

### Check Database
```sql
-- Check Users
SELECT * FROM users;
-- Should return 2 users (admin dan user)

-- Check Products
SELECT * FROM products;
-- Should return 15 products

-- Check Categories
SELECT * FROM categories;
-- Should return 5 categories

-- Check Relations
SELECT p.name, c.name FROM products p
JOIN category_product cp ON p.id = cp.product_id
JOIN categories c ON cp.category_id = c.id
ORDER BY p.id;
-- Should show product-category relationships
```

---

## 📊 Test Summary Template

```
TEST REPORT - E-Commerce Application
=====================================

Date: [Date]
Tester: [Name]
Build: [Version]

PASSED TESTS:
- Authentication: ✅ 5/5
- Admin Features: ✅ 6/6
- User Features: ✅ 9/9
- Navigation: ✅ 4/4
- Database: ✅ 3/3
- Error Handling: ✅ 4/4
- Access Control: ✅ 2/2

Total: ✅ 33/33 PASSED

ISSUES FOUND:
- None

RECOMMENDATIONS:
- Application is ready for production
- All features are working as expected
```

---

## 🎯 Testing Best Practices

✅ Test dengan user berbeda (admin & user)  
✅ Test CRUD operations secara lengkap (Create, Read, Update, Delete)  
✅ Test validation dan error handling  
✅ Test dengan data edge case (nilai limit, string panjang, dll)  
✅ Test session dan cookie persistence  
✅ Test responsive design di berbagai ukuran layar  
✅ Test dengan browser berbeda jika memungkinkan  
✅ Test security (XSS, SQL Injection, CSRF)  
✅ Check database integrity setelah operasi  
✅ Verifikasi notifikasi dan feedback ke user  

---

**Happy Testing! 🚀**

Semua test sudah selesai dijalankan? Dokumentasikan hasilnya dan lapor jika ada issues.
