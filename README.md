Berikut adalah **versi terbaru dari `README.md`** untuk aplikasi **LIBRAIN**, yang sudah diperbarui dengan:

- ✅ Semua fitur CRUD (Create, Read, Update, Delete) tersedia
- 📄 Halaman Denda bisa melakukan export ke CSV/PDF
- 🖼 Tampilan demo web lengkap dengan placeholder gambar untuk halaman Login, Dashboard, Anggota, Buku, Peminjaman, Pengembalian, dan Denda
- 🧩 Fitur tambahan seperti export data, filter, dan lainnya

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
- ✅ Manajemen Anggota (CRUD)
- ✅ Manajemen Buku (CRUD)
- ✅ Manajemen Peminjaman (CRUD)
- ✅ Manajemen Pengembalian (CRUD)
- ✅ Manajemen Denda (CRUD + Export ke CSV/PDF)
- ✅ Dashboard Statistik
- ✅ Upload Foto Profil Anggota
- ✅ Pagination, Search, Modal Interaktif
- ✅ Validasi Form Dinamis

---

## 🧩 Fitur Saat Ini

| Modul | Fitur |
|-------|-------|
| **Anggota** | Tambah, Edit, Hapus, Upload Foto, Status (Active/Inactive), Cari & Pagination |
| **Buku** | Tambah, Edit, Hapus, Kategori, Pagination, Cari |
| **Peminjaman** | Tambah, Edit, Hapus, Riwayat Peminjaman, Filter |
| **Pengembalian** | Tambah, Edit, Hapus, Hitung Denda Otomatis |
| **Denda** | Lihat, Bayar, Ekspor ke CSV/PDF, Filter Berdasarkan Anggota/Tanggal |

➡️ Semua modul sudah selesai dan siap digunakan!

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi |
|-----------|-------|
| PHP       | ^8.2 |
| Laravel   | ^10.0 |
| TailwindCSS | CDN atau PostCSS |
| MySQL / SQLite | Any |
| JavaScript Vanilla | Untuk modal interaktif dan preview foto |

---

## 📁 Struktur Folder

```
project-librain/
├── app/
│   └── Models/
│       ├── Anggota.php
│       ├── Buku.php
│       ├── Peminjaman.php
│       ├── Pengembalian.php
│       └── Denda.php
│
├── routes/
│   └── web.php
│
├── resources/
│   ├── views/
│   │   ├── pages/
│   │   │   ├── anggota/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── buku/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── peminjaman/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── pengembalian/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── denda/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── export.blade.php
│   │   │
│   │   └── layouts/
│   │       └── app.blade.php
│   │
│   └── css/
│       └── app.css
│
├── public/
│   └── storage/ ← tempat foto anggota diupload
│
└── database/
    └── migrations/
        ├── Anggota
        ├── Buku
        ├── Peminjaman
        ├── Pengembalian
        └── Denda
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
php artisan migrate --seed
```

Seeder akan mengisi data dummy untuk semua tabel.

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
| `/buku` | Daftar buku |
| `/peminjaman` | Daftar peminjaman |
| `/pengembalian` | Daftar pengembalian |
| `/denda` | Daftar denda |
| `/denda/export` | Export data denda ke CSV/PDF |

---

## 💡 Fungsi Utama

### Validasi Dinamis
- Update hanya field yang berubah (`filled()` + `sometimes`)
- Validasi email unik → gunakan `Rule::unique('anggota')->ignore($anggota->id)`

### Upload Foto
- Upload foto saat tambah/edit anggota
- Hapus foto lama saat update

### Modal Interaktif
- Add anggota/buku/peminjaman via modal tanpa reload halaman
- Preview foto saat upload

### Export Data
- Di halaman `/denda`, kamu bisa ekspor data dalam format:
  - 📄 CSV
  - 📄 PDF (via DomPDF)

---

## 🖼 Tampilan Demo Web

Berikut adalah tampilan awal dari aplikasi LIBRAIN. Kamu bisa mengganti placeholder gambar dengan screenshot asli setelah menjalankan aplikasi.

### 1. 🔐 Halaman Login  
*URI: `/login`*

![Login Page](https://via.placeholder.com/800x400?text=Login+Page+-+LIBRAIN)

Form login minimalis dengan validasi:
- Input email dan password
- Tombol login
- Link registrasi (opsional)

---

### 2. 📊 Dashboard Utama  
*URI: `/dashboard`*

![Dashboard](https://via.placeholder.com/800x400?text=Dashboard+-+LIBRAIN)

Komponen:
- Sidebar navigasi
- Statistik jumlah anggota, buku, dll
- Menu cepat akses

---

### 3. 👤 Manajemen Anggota  
*URI: `/anggota`*

![Daftar Anggota](https://via.placeholder.com/800x400?text=Daftar+Anggota)

Fitur:
- Tabel daftar anggota
- Pagination dan pencarian
- Tombol tambah/edit/hapus
- Upload foto profil

---

### 4. 📚 Manajemen Buku  
*URI: `/buku`*

![Manajemen Buku](https://via.placeholder.com/800x400?text=Manajemen+Buku)

Fitur:
- Tambah/Edit/Hapus buku
- Pagination
- Filter kategori

---

### 5. 📤 Peminjaman  
*URI: `/peminjaman`*

![Peminjaman](https://via.placeholder.com/800x400?text=Peminjaman+Buku)

Fitur:
- Tambah/Edit/Hapus peminjaman
- Riwayat peminjaman
- Filter tanggal

---

### 6. 📥 Pengembalian  
*URI: `/pengembalian`*

![Pengembalian](https://via.placeholder.com/800x400?text=Pengembalian+Buku)

Fitur:
- Tambah/Edit/Hapus pengembalian
- Hitung otomatis denda jika telat

---

### 7. 💰 Denda  
*URI: `/denda`*

![Denda](https://via.placeholder.com/800x400?text=Data+Denda)

Fitur:
- Lihat daftar denda
- Bayar denda
- Export ke CSV/PDF

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
- Menambahkan fitur baru
- Memperbaiki UI/UX
- Mengintegrasikan dengan API eksternal
- Menulis dokumentasi lebih lengkap

---

## 🔚 Catatan Akhir

Proyek ini sudah selesai dikembangkan secara keseluruhan.
Modul-modul sudah bisa digunakan untuk simulasi maupun produksi sederhana.

---

## 🙏 Terima Kasih!

Terima kasih telah menggunakan LIBRAIN!  
Semoga membantu kamu belajar Laravel, Tailwind CSS, dan sistem manajemen perpustakaan.

---

Jika kamu ingin saya bantu buatkan versi HTML/CSS statis dari semua halaman, atau ingin saya tambahkan **mockup desain Figma**, cukup beri tahu ya 😊
