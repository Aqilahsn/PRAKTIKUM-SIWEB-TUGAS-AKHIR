# 🚀 Quick Start Guide - E-Commerce Laravel

## ⚡ Mulai Cepat (5 Menit)

### 1️⃣ Pastikan Server Running
```bash
# Terminal 1: Jalankan Laragon (atau MySQL)
# Pastikan Laragon sudah ON

# Terminal 2: Navigate ke project
cd c:\laragon\www\ecommerce

# Terminal 3: Start Laravel Development Server
php artisan serve
```

### 2️⃣ Buka Browser
```
http://127.0.0.1:8000
```

---

## 📝 Akun Test

### Admin Account
```
Email: admin@example.com
Password: password123
Role: Admin
```

### User Account
```
Email: user@example.com
Password: password123
Role: User Biasa
```

---

## 🎯 Fitur Cepat Akses

### Untuk Admin
```
1. Dashboard: http://127.0.0.1:8000/admin/dashboard
2. Kelola Produk: http://127.0.0.1:8000/admin/products
3. Tambah Produk: http://127.0.0.1:8000/admin/products/create
```

### Untuk User
```
1. Beranda/Produk: http://127.0.0.1:8000
2. Keranjang: http://127.0.0.1:8000/cart
```

---

## 🔄 Database Reset

Jika ingin reset database dengan data fresh:
```bash
php artisan migrate:fresh --seed
```

---

## 🐛 Troubleshooting

### Aplikasi Tidak Terbuka?
```bash
# Clear cache
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### Database Error?
```bash
# Check .env apakah sudah benar
# Jalankan migration ulang
php artisan migrate:fresh --seed
```

### Port 8000 Sudah Digunakan?
```bash
php artisan serve --port=8001
# Buka: http://127.0.0.1:8001
```

---

## 📚 Dokumentasi Lengkap

- **Dokumentasi Lengkap**: Baca file `DOKUMENTASI.md`
- **Testing Guide**: Baca file `TESTING.md`
- **Source Code**: Lihat folder `app/` dan `resources/`

---

## ✨ Fitur Utama

✅ User Registration & Login  
✅ Role-Based Access (Admin/User)  
✅ Admin CRUD Produk  
✅ Product-Category Many-to-Many Relation  
✅ User Shopping Cart (Session-Based)  
✅ Responsive Design  
✅ Beautiful Modern UI  

---

## 🎨 Data Included

**2 Users:**
- 1 Admin (admin@example.com)
- 1 User Biasa (user@example.com)

**5 Categories:**
- Elektronik
- Gaming
- Aksesoris
- Fashion
- Olahraga

**15 Products:**
- Laptop Gaming ASUS ROG
- Mouse Gaming Razer
- Keyboard Mechanical RGB
- [... dan 12 produk lainnya]

---

## 🔐 Security Features

✅ Password Hashing (bcrypt)  
✅ CSRF Protection  
✅ SQL Injection Prevention (Eloquent ORM)  
✅ XSS Prevention (Blade Template)  
✅ Role-Based Access Control  
✅ Session Management  

---

## 📞 Getting Help

Jika ada pertanyaan:
1. Baca file `DOKUMENTASI.md` untuk penjelasan detail
2. Baca file `TESTING.md` untuk panduan testing
3. Lihat source code di folder `app/`
4. Check database di HeidiSQL

---

## 🎓 Apa yang Dipelajari

Melalui project ini, Anda sudah belajar:
- Laravel Routing & Controllers
- Eloquent ORM & Database Relations
- Authentication & Authorization
- Session Management
- Blade Templating
- Custom Middleware
- Form Validation
- UI/UX Design dengan Bootstrap

---

**Ready to Use! 🎉**

Aplikasi Anda siap digunakan. Enjoy!
