# E-Commerce Laravel - Dokumentasi Lengkap

## 📋 Daftar Isi
- [Deskripsi Aplikasi](#deskripsi-aplikasi)
- [Fitur Utama](#fitur-utama)
- [Teknologi Yang Digunakan](#teknologi-yang-digunakan)
- [Struktur Database](#struktur-database)
- [Instalasi & Setup](#instalasi--setup)
- [User Akun Test](#user-akun-test)
- [Panduan Penggunaan](#panduan-penggunaan)
- [API Routes](#api-routes)
- [Struktur Folder](#struktur-folder)

---

## 🎯 Deskripsi Aplikasi

**E-Commerce Modern** adalah aplikasi toko online sederhana yang dibangun menggunakan Laravel 11. Aplikasi ini memungkinkan:
- **Admin** untuk mengelola produk dan kategori
- **User** untuk browsing produk dan menggunakan fitur keranjang belanja

Aplikasi menggunakan sistem **role-based authentication** untuk membedakan akses antara admin dan user biasa.

---

## ✨ Fitur Utama

### A. Autentikasi & Akses Pengguna
- ✅ Register akun baru
- ✅ Login dengan email dan password
- ✅ Logout
- ✅ Role-based redirect (Admin → Dashboard Admin, User → Landing Page)
- ✅ Middleware untuk proteksi route admin

### B. Manajemen Produk (Admin Only)
- ✅ Melihat daftar semua produk
- ✅ Menambah produk baru dengan multiple kategori
- ✅ Mengedit data produk (nama, deskripsi, harga, stok, kategori)
- ✅ Menghapus produk
- ✅ Dashboard dengan statistik (total produk, kategori, pengguna)

### C. Fitur User
- ✅ Melihat daftar semua produk dengan kategorinya
- ✅ Melihat detail kategori setiap produk
- ✅ Menambah produk ke keranjang
- ✅ Melihat isi keranjang
- ✅ Update jumlah item di keranjang
- ✅ Menghapus item dari keranjang
- ✅ Mengosongkan seluruh keranjang

### D. Database & Relasi
- ✅ **Many-to-Many Relationship**: Product ↔ Category
- ✅ Tabel pivot `category_product` untuk relasi
- ✅ Cascading delete untuk data consistency

---

## 🛠️ Teknologi Yang Digunakan

| Teknologi | Versi | Keterangan |
|-----------|-------|-----------|
| **Laravel** | 11 | Framework PHP Modern |
| **PHP** | 8.2+ | Programming Language |
| **MySQL** | 5.7+ | Database |
| **Bootstrap** | 5.3 | CSS Framework |
| **Blade** | - | Template Engine Laravel |
| **Eloquent ORM** | - | Database Query Builder |

---

## 📊 Struktur Database

### Tabel: `users`
```sql
- id (Primary Key)
- name (varchar)
- email (varchar, unique)
- password (varchar, hashed)
- role (enum: 'admin', 'user')
- created_at, updated_at
```

### Tabel: `products`
```sql
- id (Primary Key)
- name (varchar)
- description (text)
- price (decimal)
- stock (integer)
- created_at, updated_at
```

### Tabel: `categories`
```sql
- id (Primary Key)
- name (varchar, unique)
- description (text)
- created_at, updated_at
```

### Tabel: `category_product` (Pivot)
```sql
- id (Primary Key)
- product_id (Foreign Key → products)
- category_id (Foreign Key → categories)
- created_at, updated_at
- unique(product_id, category_id)
```

### Entity Relationship Diagram
```
┌─────────┐         ┌──────────────────┐         ┌────────────┐
│ products├────────→│ category_product │←────────┤ categories │
└─────────┘         └──────────────────┘         └────────────┘

Products (1) ─── Many ─── (Many) CategoryProduct ─── (Many) ─── (1) Categories
```

---

## 🚀 Instalasi & Setup

### 1. Clone Repository atau Download Project
```bash
cd c:\laragon\www\ecommerce
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

Perintah ini akan:
- ✅ Drop semua tabel lama
- ✅ Membuat tabel baru
- ✅ Menjalankan seeder untuk data awal:
  - 2 users (1 admin, 1 user biasa)
  - 5 kategori
  - 15 produk dengan kategori yang beragam

### 6. Build Assets (CSS & JS)
```bash
npm run dev
```

Atau untuk production:
```bash
npm run build
```

### 7. Jalankan Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

---

## 👥 User Akun Test

Setelah menjalankan `php artisan migrate:fresh --seed`, ada 2 akun yang tersedia:

### Akun Admin
```
Email: admin@example.com
Password: password123
Role: Admin
```
**Akses ke:**
- Dashboard Admin (`/admin/dashboard`)
- Manajemen Produk (`/admin/products`)

### Akun User Biasa
```
Email: user@example.com
Password: password123
Role: User
```
**Akses ke:**
- Landing Page / Produk (`/`)
- Keranjang (`/cart`)

---

## 📖 Panduan Penggunaan

### Untuk Admin

#### 1. Login Dashboard Admin
```
1. Buka http://127.0.0.1:8000/login
2. Input: admin@example.com / password123
3. Akan redirect ke Dashboard Admin
```

#### 2. Melihat Daftar Produk
```
1. Klik "📦 Daftar Produk" di Dashboard
2. Atau akses: /admin/products
3. Lihat semua produk dalam format tabel
```

#### 3. Menambah Produk Baru
```
1. Klik "➕ Tambah Produk Baru"
2. Isi form:
   - Nama Produk: Contoh "iPhone 15 Pro"
   - Deskripsi: Jelaskan detail produk
   - Harga: Input harga dalam rupiah
   - Stok: Jumlah stok tersedia
   - Kategori: Pilih 1 atau lebih kategori
3. Klik "💾 Simpan Produk"
```

#### 4. Mengedit Produk
```
1. Di halaman daftar produk, cari produk
2. Klik tombol "✏️ Edit"
3. Ubah data yang diperlukan
4. Klik "💾 Perbarui Produk"
```

#### 5. Menghapus Produk
```
1. Di halaman daftar produk, cari produk
2. Klik tombol "🗑️ Hapus"
3. Konfirmasi penghapusan
```

### Untuk User Biasa

#### 1. Login User
```
1. Buka http://127.0.0.1:8000/login
2. Input: user@example.com / password123
3. Akan redirect ke Landing Page
```

#### 2. Melihat Produk
```
1. Di landing page, lihat grid produk
2. Setiap card menampilkan:
   - Nama produk
   - Deskripsi singkat
   - Kategori (badge)
   - Harga
   - Status stok
3. Scroll untuk melihat lebih banyak produk (pagination)
```

#### 3. Menambah ke Keranjang
```
1. Pilih produk yang ingin dibeli
2. Input jumlah di field quantity
3. Klik tombol "🛒 Keranjang"
4. Produk akan ditambahkan (lihat notifikasi sukses)
```

#### 4. Melihat Keranjang
```
1. Klik link "🛍️ Keranjang" di navbar
2. Lihat semua item di keranjang dengan:
   - Nama produk & kategori
   - Harga per item
   - Jumlah yang dibeli
   - Subtotal
3. Lihat ringkasan total pesanan di sisi kanan
```

#### 5. Update Jumlah Item
```
1. Di halaman keranjang, lihat tabel items
2. Ubah angka di kolom "Jumlah"
3. Klik tombol "✓" untuk update
4. Keranjang akan di-refresh
```

#### 6. Menghapus Item dari Keranjang
```
1. Di halaman keranjang, cari item
2. Klik tombol "🗑️ Hapus"
3. Konfirmasi penghapusan
4. Item dihapus dari keranjang
```

#### 7. Mengosongkan Keranjang
```
1. Di halaman keranjang, klik "🗑️ Kosongkan Keranjang"
2. Konfirmasi aksi
3. Semua item dihapus
```

---

## 🌐 API Routes

### Authentication Routes
```
POST   /register              → Register user baru
POST   /login                 → Login
POST   /logout                → Logout (middleware: auth)
```

### Admin Routes (middleware: auth, admin)
```
GET    /admin/dashboard       → Dashboard Admin
GET    /admin/products        → Daftar produk (index)
GET    /admin/products/create → Form tambah produk
POST   /admin/products        → Simpan produk (store)
GET    /admin/products/{id}/edit → Form edit produk
PUT    /admin/products/{id}   → Update produk
DELETE /admin/products/{id}   → Hapus produk
```

### User Routes
```
GET    /                      → Landing page (daftar produk user)
GET    /cart                  → Lihat keranjang (middleware: auth)
POST   /cart/add/{id}         → Tambah ke keranjang (middleware: auth)
DELETE /cart/remove/{id}      → Hapus dari keranjang (middleware: auth)
POST   /cart/clear            → Kosongkan keranjang (middleware: auth)
POST   /cart/update           → Update qty keranjang (middleware: auth)
```

---

## 📁 Struktur Folder

```
ecommerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          ← Handle register, login, logout
│   │   │   ├── ProductController.php       ← CRUD produk
│   │   │   └── CartController.php          ← Cart management
│   │   └── Middleware/
│   │       └── AdminMiddleware.php         ← Role-based access
│   ├── Models/
│   │   ├── User.php                        ← User model dengan role
│   │   ├── Product.php                     ← Product model
│   │   └── Category.php                    ← Category model
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_04_08_000003_create_products_table.php
│   │   ├── 2026_04_08_000004_create_categories_table.php
│   │   └── 2026_04_08_000005_create_category_product_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── ProductSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php               ← Main layout
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   └── products/
│   │   │       ├── index.blade.php
│   │   │       ├── create.blade.php
│   │   │       └── edit.blade.php
│   │   └── user/
│   │       ├── products.blade.php          ← Landing page
│   │       └── cart.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php                             ← Semua routes aplikasi
│   └── console.php
├── bootstrap/
│   └── app.php                             ← Middleware registration
├── composer.json
├── package.json
└── .env                                    ← Konfigurasi database

```

---

## 🔐 Keamanan

### Implementasi Keamanan
✅ **Password Hashing**: Menggunakan bcrypt  
✅ **CSRF Protection**: Semua form pakai @csrf  
✅ **Role-Based Access Control**: Middleware AdminMiddleware  
✅ **SQL Injection Prevention**: Menggunakan Eloquent ORM  
✅ **XSS Prevention**: Blade template auto-escape  
✅ **Session Management**: Session-based authentication  

---

## 🐛 Testing

### Test Fitur Admin
```bash
# Buka browser, akses login
http://127.0.0.1:8000/login

# Login dengan akun admin
Email: admin@example.com
Password: password123

# Test CRUD Produk
1. Lihat daftar produk
2. Tambah produk baru
3. Edit produk
4. Hapus produk
```

### Test Fitur User
```bash
# Login dengan akun user
Email: user@example.com
Password: password123

# Test Fitur
1. Lihat daftar produk di landing page
2. Tambah beberapa produk ke keranjang
3. Lihat keranjang
4. Update jumlah item
5. Hapus item atau kosongkan keranjang
```

---

## 📝 Data Seeder

### Users yang Dibuat
```
1. Admin (id: 1)
   - Email: admin@example.com
   - Password: password123
   - Role: admin

2. User Biasa (id: 2)
   - Email: user@example.com
   - Password: password123
   - Role: user
```

### Categories yang Dibuat
```
1. Elektronik - Produk elektronik dan gadget
2. Gaming - Peralatan gaming dan aksesori
3. Aksesoris - Aksesori dan perlengkapan
4. Fashion - Pakaian dan fashion
5. Olahraga - Peralatan olahraga
```

### Sample Products (15 items)
```
1. Laptop Gaming ASUS ROG
   - Harga: Rp 15.000.000
   - Stok: 5
   - Kategori: Elektronik, Gaming

2. Mouse Gaming Razer DeathAdder
   - Harga: Rp 450.000
   - Stok: 20
   - Kategori: Gaming, Aksesoris

3. Keyboard Mechanical RGB
   - Harga: Rp 800.000
   - Stok: 15
   - Kategori: Gaming, Aksesoris

[... dan 12 produk lainnya ...]
```

---

## ⚙️ Konfigurasi Environment

File `.env` yang penting:
```env
APP_NAME="E-Commerce"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

---

## 🎨 Design & UI

### Design Pattern
- **Gradient Background**: Warna purple (#667eea - #764ba2)
- **Card-Based Layout**: Product cards dengan hover effect
- **Responsive Design**: Mobile-friendly menggunakan Bootstrap
- **Modern Aesthetic**: Clean design dengan spacing yang baik
- **Color Scheme**:
  - Primary: #667eea (Purple)
  - Success: #48bb78 (Green)
  - Danger: #f56565 (Red)
  - Warning: #ed8936 (Orange)

---

## 📞 Support & Troubleshooting

### Issue: Database tidak terkoneksi
```bash
# Pastikan MySQL berjalan
# Check file .env apakah sudah benar
php artisan migrate:fresh --seed
```

### Issue: 404 routes not found
```bash
# Clear route cache
php artisan route:clear
php artisan route:cache
```

### Issue: Permission denied pada folder storage
```bash
# Set permission folder storage
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Issue: Tidak bisa upload gambar
```bash
# Link storage public
php artisan storage:link
```

---

## ✅ Checklist Implementasi

- [x] Database & Migration (Users, Products, Categories, CategoryProduct)
- [x] Eloquent Models dengan relasi Many-to-Many
- [x] Authentication (Register, Login, Logout)
- [x] Role-Based Access Control (Admin vs User)
- [x] Admin CRUD Produk & Kategori
- [x] Product management dengan multiple categories
- [x] User Landing Page dengan daftar produk
- [x] Session-Based Shopping Cart
- [x] Cart: Add, View, Update, Remove, Clear
- [x] Beautiful & Aesthetic UI Design
- [x] Bootstrap 5 responsive layout
- [x] Data Seeder dengan sample data
- [x] Middleware untuk proteksi route admin
- [x] Blade template untuk semua halaman
- [x] Proper error handling & validation

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan studi kasus E-Commerce menggunakan Laravel.

---

## 🎓 Pembelajaran

Melalui project ini, kami mempelajari:

1. **Laravel Basics**: Routing, Controllers, Models, Views
2. **Database Design**: Migrations, Relationships (Many-to-Many)
3. **Eloquent ORM**: Query builder, Relationship methods
4. **Authentication**: User registration, login, role-based access
5. **Session Management**: Shopping cart menggunakan session
6. **Blade Templates**: Template syntax dan data binding
7. **Middleware**: Custom middleware untuk access control
8. **Form Handling**: Validation, error messages
9. **UI/UX**: Responsive design dengan Bootstrap
10. **Best Practices**: MVC pattern, clean code

---

**Selamat! Aplikasi E-Commerce Anda sudah siap digunakan.** 🎉

Untuk pertanyaan atau bantuan, silakan hubungi developer.
