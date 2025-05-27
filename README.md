Berikut adalah contoh **`README.md`** untuk GitHub repository kamu.  
Ini akan menjelaskan struktur proyek, fitur yang tersedia, dan cara menjalankan aplikasi.

---

# 📚 LIBRAIN - Aplikasi Manajemen Perpustakaan

> Sistem manajemen perpustakaan sederhana dengan Laravel 10 + Tailwind CSS

## 📌 Deskripsi Proyek

Aplikasi ini adalah sistem manajemen perpustakaan bernama **LIBRAIN**, dibangun menggunakan:
- **Laravel 10**
- **Tailwind CSS**
- **PHP 8.2+**
- **MySQL / PostgreSQL**

Fitur utama:
- ✅ Manajemen Anggota
- ✅ Peminjaman Buku
- ✅ Pengembalian Buku
- ✅ Denda Keterlambatan
- ✅ Dashboard Statistik
- ✅ Upload Foto Profil Anggota
- ✅ Pagination, Search, Modal Interaktif

---

## 🧩 Fitur Saat Ini

| Modul | Fitur |
|-------|-------|
| **Anggota** | Tambah, Edit, Hapus, Upload Foto, Status (Active/Inactive) |
| **Buku** | Belum tersedia (akan ditambahkan) |
| **Peminjaman** | Belum tersedia |
| **Pengembalian** | Belum tersedia |
| **Denda** | Belum tersedia |

➡️ Saat ini fokus pada: `User Management`

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi |
|-----------|-------|
| PHP       | ^8.2 |
| Laravel   | ^10.0 |
| TailwindCSS | CDN atau PostCSS |
| MySQL / SQLite | Any |
| JavaScript Vanilla | Untuk modal interaktif |

---

## 📁 Struktur Folder

```
project-librain/
├── app/
│   └── Models/
│       └── Anggota.php
│
├── routes/
│   └── web.php
│
├── resources/
│   ├── views/
│   │   └── pages/
│   │       └── user-management/
│   │           ├── index.blade.php
│   │           └── create.blade.php
│   │           └── edit.blade.php
│   │
│   └── layouts/
│       └── app.blade.php
│
├── public/
│   └── storage/ ← tempat foto anggota diupload
│
└── database/
    └── migrations/
        └── Anggota
```

---

## 🧪 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM (untuk Tailwind CSS)
- MySQL / SQLite
- Laravel 10.x

---

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/namauser/project-librain.git
cd project-librain
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Buat `.env` file

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Jalankan Migrasi

```bash
php artisan migrate
```

Kalau pakai seeder:

```bash
php artisan db:seed --class=AnggotaSeeder
```

### 5. Jalankan Laravel

```bash
php artisan serve
```

### 6. Jalankan npm dev server (kalau pakai Tailwind CSS)

```bash
npm run dev
```

---

## 📄 Contoh Route

| URI | Deskripsi |
|-----|-----------|
| `/login` | Halaman login pengguna |
| `/dashboard` | Dashboard utama |
| `/anggota` | Daftar anggota |
| `/anggota/create` | Form tambah anggota |
| `/anggota/{id}/edit` | Form edit anggota |
| `/denda` | Manajemen denda (belum tersedia) |
| `/peminjaman` | Manajemen peminjaman (akan ditambahkan) |
| `/pengembalian` | Manajemen pengembalian (akan ditambahkan) |

---

## 💡 Fungsi Utama

### Validasi Dinamis
- Update data hanya field yang berubah (`filled()` + `sometimes`)
- Validasi email unik → gunakan `Rule::unique('anggota')->ignore($anggota->id)`

### Upload Foto
- Upload foto saat tambah/edit anggota
- Hapus foto lama saat update

### Modal Interaktif
- Add anggota via modal tanpa reload halaman
- Preview foto saat upload

---

## 📋 Model Anggota

```php
protected $fillable = ['nama', 'email', 'telepon', 'foto', 'status'];
```

Status bisa bernilai:
- `active`
- `inactive`

---

## 🧰 Controller Anggota

```bash
php artisan make:controller AnggotaController --resource
```

Fungsi utama:
- `index()` → tampilkan list anggota
- `create()` → form tambah anggota
- `store()` → simpan data baru
- `edit($id)` → cari data anggota
- `update(Request $request, Anggota $anggota)` → update data dinamis
- `destroy(Anggota $anggota)` → hapus anggota beserta foto

---

## 🧪 Blade View

- `pages.user-management.index` → daftar anggota
- `pages.user-management.create` → form tambah
- `pages.user-management.edit` → form edit

✔️ Semua view sudah responsive  
✔️ Gunakan Tailwind CSS  
✔️ Upload foto + preview  
✔️ Alert error/sukses  
✔️ Modal interaktif  

---

## 📝 License

MIT License

---

## 📬 Kontak

Jika ada pertanyaan atau ingin bantuan fix bug, hubungi saya di:

- Email: [shevia@gmail.com](mailto:shevia@gmail.com)
- GitHub: [https://github.com/namauser/project-librain](https://github.com/namauser/project-librain)

---

## 🚀 Contribusi

Kamu bisa fork repo ini dan kirim pull request untuk:
- Menambahkan modul buku/peminjaman
- Memperbaiki validasi input
- Menambahkan export ke CSV/PDF
- Mengintegrasikan dengan dashboard

---

## 🔚 Catatan Akhir

Proyek ini masih dalam tahap awal pengembangan.  
Saat ini fokus pada **manajemen anggota** dan UI dasar.

Modul lain seperti **buku**, **peminjaman**, **pengembalian**, dan **denda** akan segera ditambahkan.

---

## 🙏 Terima Kasih!

Terima kasih telah menggunakan LIBRAIN!  
Semoga membantu kamu belajar Laravel, Tailwind CSS, dan sistem manajemen perpustakaan.

---

Ingin saya tambahkan README untuk modul lain?
- 📘 Buku
- 📙 Peminjaman
- 📗 Pengembalian
- 📕 Denda
- 📊 Dashboard Lengkap

Cukup kirim:
- Apakah kamu ingin README versi bahasa Indonesia atau Inggris?
- Sudah ada tabel database?
- Ingin tambah screenshot?

Saya siap bantu lengkapi total! 😊
