/**
 * ============================================================
 * script.js — Risol Majesty
 * ============================================================
 * Fitur:
 *  1. Dark Mode      → state tersimpan di localStorage
 *  2. Stok & Beli    → tombol beli mengurangi stok real-time
 *  3. Modal Detail   → membaca data-* dari tombol kartu
 *  4. Wishlist       → item tersimpan di sessionStorage
 *                      + badge counter di navbar
 *                      + hapus item spesifik (bonus)
 * ============================================================
 */


// ============================================================
// MODUL 1 — DARK MODE (localStorage)
// ============================================================

const inisialisasiTema = () => {
  const tombol = document.getElementById('themeToggle');
  if (!tombol) return;

  // Terapkan tema tersimpan saat halaman dimuat
  if (localStorage.getItem('tema') === 'gelap') {
    document.body.classList.add('dark-mode');
    tombol.innerHTML = '<i class="bi bi-sun-fill"></i>';
  }

  tombol.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const sedangGelap = document.body.classList.contains('dark-mode');

    localStorage.setItem('tema', sedangGelap ? 'gelap' : 'terang');
    tombol.innerHTML = sedangGelap
      ? '<i class="bi bi-sun-fill"></i>'
      : '<i class="bi bi-moon-stars"></i>';
  });
};


// ============================================================
// MODUL 2 — STOK & BELI
// ============================================================

const inisialisasiTombolBeli = () => {
  const semuaTombol = document.querySelectorAll('.btn-beli');

  semuaTombol.forEach(tombol => {
    tombol.addEventListener('click', (e) => {
      e.stopPropagation();
      const cardBody = tombol.closest('.product-body');
      if (!cardBody) return;

      const stokEl   = cardBody.querySelector('.stock-number');
      const namaEl   = cardBody.querySelector('.product-title');
      let stokSaat   = parseInt(stokEl.textContent);

      if (stokSaat > 0) {
        stokSaat--;
        stokEl.textContent = stokSaat;
        alert(`Berhasil membeli "${namaEl.textContent}"!`);
        if (stokSaat === 0) nonaktifkanBeli(tombol);
      } else {
        alert('Stok sudah habis!');
        nonaktifkanBeli(tombol);
      }
    });
  });
};

// Ubah tombol beli jadi disabled & teks "Habis"
const nonaktifkanBeli = (tombol) => {
  tombol.disabled        = true;
  tombol.textContent     = 'Habis';
  tombol.style.background   = '#999';
  tombol.style.borderColor  = '#999';
  tombol.style.cursor       = 'not-allowed';
};


// ============================================================
// MODUL 3 — MODAL DETAIL PRODUK
// Data dibaca dari atribut data-* tombol kartu — tanpa onclick
// ============================================================

// Referensi produk & elemen stok kartu yang sedang terbuka
let produkAktif    = null;
let stokElemenAktif = null;

const inisialisasiModalDetail = () => {
  const semuaTombolDetail = document.querySelectorAll('.btn-detail');
  const elModal = document.getElementById('detailModal');
  if (!elModal) return;

  // Saat modal hendak ditampilkan, isi kontennya dari data-* tombol pemicu
  elModal.addEventListener('show.bs.modal', (e) => {
    const pemicu = e.relatedTarget; // tombol yang memicu modal
    if (!pemicu || !pemicu.classList.contains('btn-detail')) return;

    const { nama, harga, stok, varian, deskripsi } = pemicu.dataset;

    // Cari stok live dari kartu (mungkin sudah berkurang sebelumnya)
    stokElemenAktif = null;
    document.querySelectorAll('.product-card').forEach(kartu => {
      const judul = kartu.querySelector('.product-title');
      if (judul && judul.textContent === nama) {
        stokElemenAktif = kartu.querySelector('.stock-number');
      }
    });

    const stokLive = stokElemenAktif
      ? parseInt(stokElemenAktif.textContent)
      : parseInt(stok);

    produkAktif = { nama, harga, stok: stokLive, varian, deskripsi };

    // Isi elemen modal satu per satu (tidak pakai innerHTML massal)
    document.getElementById('modalNamaProduk').textContent  = nama;
    document.getElementById('modalVarian').textContent      = varian;
    document.getElementById('modalHarga').textContent       = harga;
    document.getElementById('modalStok').textContent        = `${stokLive} unit`;
    document.getElementById('modalDeskripsi').textContent   = deskripsi;

    perbaruiStatusBadge(stokLive);
    perbaruiTombolBeliModal(stokLive);
    sinkronTombolWishlist(nama);
  });
};

// Perbarui badge status stok di modal
const perbaruiStatusBadge = (jumlah) => {
  const badge = document.getElementById('statusBadge');
  if (!badge) return;

  const statusMap = [
    { batas: 50, teks: 'Stok Melimpah', kelas: 'badge bg-success'           },
    { batas: 20, teks: 'Stok Tersedia',  kelas: 'badge bg-info text-dark'    },
    { batas:  0, teks: 'Stok Terbatas', kelas: 'badge bg-warning text-dark'  },
  ];

  const cocok = statusMap.find(s => jumlah > s.batas);
  badge.textContent = cocok ? cocok.teks : 'Habis';
  badge.className   = cocok ? cocok.kelas : 'badge bg-danger';
};

// Perbarui tombol "Beli Sekarang" di footer modal
const perbaruiTombolBeliModal = (stok) => {
  const tombol = document.getElementById('btnBeliModal');
  if (!tombol) return;

  tombol.disabled    = stok <= 0;
  tombol.innerHTML   = stok <= 0
    ? '<i class="bi bi-x-circle me-1"></i> Stok Habis'
    : '<i class="bi bi-bag-plus me-1"></i> Beli Sekarang';
};

// Proses beli dari dalam modal detail
const beliDariModal = () => {
  if (!produkAktif || produkAktif.stok <= 0) {
    alert('Stok sudah habis!');
    return;
  }

  produkAktif.stok--;
  alert(`Berhasil membeli "${produkAktif.nama}"!`);

  // Update tampilan modal
  document.getElementById('modalStok').textContent = `${produkAktif.stok} unit`;
  perbaruiStatusBadge(produkAktif.stok);
  perbaruiTombolBeliModal(produkAktif.stok);

  // Sinkronisasi stok ke kartu produk
  if (stokElemenAktif) {
    stokElemenAktif.textContent = produkAktif.stok;
    if (produkAktif.stok === 0) {
      const kartu       = stokElemenAktif.closest('.product-card');
      const tombolBeli  = kartu?.querySelector('.btn-beli');
      if (tombolBeli) nonaktifkanBeli(tombolBeli);
    }
  }
};


// ============================================================
// MODUL 4 — WISHLIST (sessionStorage)
// ============================================================

// Baca wishlist dari sessionStorage (kembalikan array)
const bacaWishlist = () => {
  const tersimpan = sessionStorage.getItem('wishlist');
  return tersimpan ? JSON.parse(tersimpan) : [];
};

// Tulis array wishlist ke sessionStorage
const tulisWishlist = (data) => {
  sessionStorage.setItem('wishlist', JSON.stringify(data));
};

// Perbarui angka badge di tombol Wishlist navbar
const perbaruiBadge = () => {
  const badge = document.getElementById('wishlistBadge');
  if (!badge) return;

  const jumlah = bacaWishlist().length;
  badge.textContent    = jumlah;
  badge.style.display  = jumlah > 0 ? 'inline-block' : 'none';
};

// Tampilkan/update tombol Tambah & Hapus di modal detail
const sinkronTombolWishlist = (nama) => {
  const daftar   = bacaWishlist();
  const sudahAda = daftar.some(item => item.nama === nama);

  document.getElementById('btnTambahWishlist').style.display  = sudahAda ? 'none'         : 'inline-block';
  document.getElementById('btnHapusWishlist').style.display   = sudahAda ? 'inline-block' : 'none';
};

// Tambah produk aktif ke wishlist
const tambahKeWishlist = () => {
  if (!produkAktif) return;

  const daftar   = bacaWishlist();
  const sudahAda = daftar.some(item => item.nama === produkAktif.nama);

  if (sudahAda) {
    alert('Produk ini sudah ada di wishlist!');
    return;
  }

  daftar.push({ ...produkAktif });
  tulisWishlist(daftar);
  perbaruiBadge();
  sinkronTombolWishlist(produkAktif.nama);
  alert(`"${produkAktif.nama}" berhasil ditambahkan ke wishlist!`);
};

// Hapus produk aktif dari wishlist
const hapusDariWishlist = () => {
  if (!produkAktif) return;

  const daftarBaru = bacaWishlist().filter(item => item.nama !== produkAktif.nama);
  tulisWishlist(daftarBaru);
  perbaruiBadge();
  sinkronTombolWishlist(produkAktif.nama);
  alert(`"${produkAktif.nama}" dihapus dari wishlist.`);
};

// Hapus item tertentu berdasarkan index (dari dalam modal wishlist)
const hapusItemWishlist = (index) => {
  const daftar  = bacaWishlist();
  const nama    = daftar[index]?.nama ?? '';
  daftar.splice(index, 1);
  tulisWishlist(daftar);
  perbaruiBadge();
  tampilkanWishlist();
  if (nama) alert(`"${nama}" dihapus dari wishlist.`);
};

// Kosongkan seluruh wishlist
const kosongkanWishlist = () => {
  if (!confirm('Yakin ingin mengosongkan semua wishlist?')) return;
  sessionStorage.removeItem('wishlist');
  perbaruiBadge();
  tampilkanWishlist();
};

// Render daftar wishlist ke dalam modal (menggunakan DOM API, bukan innerHTML)
const tampilkanWishlist = () => {
  const daftar   = bacaWishlist();
  const kontainer = document.getElementById('daftar-wishlist');
  if (!kontainer) return;

  // Bersihkan isi lama
  while (kontainer.firstChild) kontainer.removeChild(kontainer.firstChild);

  if (daftar.length === 0) {
    const liKosong = document.createElement('li');
    liKosong.className   = 'list-group-item text-muted fst-italic';
    liKosong.textContent = 'Belum ada produk di wishlist.';
    kontainer.appendChild(liKosong);
    return;
  }

  // Bangun setiap baris item dari DOM — tidak ada string concatenation
  daftar.forEach((item, index) => {
    const li      = document.createElement('li');
    li.className  = 'list-group-item d-flex justify-content-between align-items-center';

    const infoDiv = document.createElement('div');

    const namaEl      = document.createElement('strong');
    namaEl.style.fontFamily = "'Playfair Display', serif";
    namaEl.textContent      = item.nama;

    const subEl       = document.createElement('small');
    subEl.className   = 'text-muted d-block mt-1';
    subEl.textContent = `Varian: ${item.varian} · ${item.harga}`;

    infoDiv.appendChild(namaEl);
    infoDiv.appendChild(subEl);

    // Tombol hapus per item (bonus)
    const tombolHapus       = document.createElement('button');
    tombolHapus.className   = 'btn btn-sm btn-danger ms-2';
    tombolHapus.style.borderRadius = '99px';
    tombolHapus.title       = 'Hapus item ini';
    tombolHapus.innerHTML   = '<i class="bi bi-trash"></i>';
    tombolHapus.addEventListener('click', () => hapusItemWishlist(index));

    li.appendChild(infoDiv);
    li.appendChild(tombolHapus);
    kontainer.appendChild(li);
  });
};


// ============================================================
// MODUL 5 — STATUS LOGIN (sessionStorage)
// ============================================================

const inisialisasiStatusLogin = () => {
  const navBelumLogin = document.getElementById('navBelumLogin');
  const navSudahLogin = document.getElementById('navSudahLogin');
  const navTeksUser   = document.getElementById('navTeksUser');
  const btnLogout     = document.getElementById('btnLogoutNav');

  if (!navBelumLogin || !navSudahLogin) return;

  if (sessionStorage.getItem('loginStatus') === 'true') {
    navBelumLogin.style.display = 'none';
    navSudahLogin.style.display = 'flex';
    if (navTeksUser) navTeksUser.textContent = sessionStorage.getItem('loginUser') || 'admin';
  } else {
    navBelumLogin.style.display = 'flex';
    navSudahLogin.style.display = 'none';
  }

  // Pasang event listener langsung ke elemen, bukan via optional chaining
  if (btnLogout) {
    btnLogout.onclick = (e) => {
      e.preventDefault();
      sessionStorage.removeItem('loginStatus');
      sessionStorage.removeItem('loginUser');
      window.location.href = 'login.html';
    };
  }
};


// ============================================================
// INISIALISASI — Jalankan semua modul setelah DOM siap
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

  // 1. Tema gelap/terang
  inisialisasiTema();

  // 2. Tombol Beli di setiap kartu produk
  inisialisasiTombolBeli();

  // 3. Modal detail produk (membaca data-* dari tombol)
  inisialisasiModalDetail();

  // 4. Badge wishlist (dari sessionStorage yang mungkin masih ada)
  perbaruiBadge();

  // 5. Status login di navbar
  inisialisasiStatusLogin();

  // Event tombol di modal detail
  document.getElementById('btnTambahWishlist')?.addEventListener('click', tambahKeWishlist);
  document.getElementById('btnHapusWishlist')?.addEventListener('click', hapusDariWishlist);
  document.getElementById('btnBeliModal')?.addEventListener('click', beliDariModal);

  // Event modal wishlist — refresh daftar saat dibuka
  document.getElementById('wishlistModal')
    ?.addEventListener('show.bs.modal', tampilkanWishlist);

  // Event tombol kosongkan wishlist
  document.getElementById('btnKosongkanWishlist')
    ?.addEventListener('click', kosongkanWishlist);

});