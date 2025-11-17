
---

# Sistem Antrian Klinik

Sistem Antrian Klinik adalah aplikasi berbasis web yang dirancang untuk mengelola alur pendaftaran pasien, antrian poli, jadwal dokter, hingga pencatatan pemeriksaan di klinik. Proyek ini dibuat sebagai tugas UAS dan mendukung proses pelayanan klinik agar lebih terstruktur dan efisien.

## Fitur Utama

### 1. Manajemen Pengguna

* Registrasi dan login pasien.
* Login untuk admin dan dokter.
* Role pengguna terbagi menjadi: pasien, admin, dan dokter.

### 2. Sistem Antrian

* Pasien dapat mengambil nomor antrian berdasarkan poli dan dokter.
* Menampilkan estimasi waktu antrian dan status (menunggu, diperiksa, selesai, atau batal).
* Nomor antrian dibuat otomatis berdasarkan tanggal kunjungan.

### 3. Data Dokter dan Poli

* Data dokter terhubung dengan poli masing-masing.
* Tersedia manajemen jadwal praktik per dokter.

### 4. Pemeriksaan dan Riwayat Medis

* Dokter dapat mengisi hasil diagnosa dan resep obat.
* Data pemeriksaan otomatis tersimpan ke tabel pemeriksaan.
* Riwayat kunjungan pasien tersimpan untuk kebutuhan laporan.

### 5. Sistem Notifikasi

* Mengirimkan notifikasi kepada pasien terkait antrian atau informasi tertentu.

### 6. Verifikasi OTP

* Sistem OTP berbasis nomor HP untuk proses verifikasi.

## Teknologi yang Digunakan

* PHP 8.0
* MySQL / MariaDB
* phpMyAdmin
* HTML, CSS, JavaScript
* XAMPP (untuk pengembangan lokal)

## Struktur Database

Database yang digunakan bernama `antrian_klinik` dan mencakup tabel berikut:

* admin
* users
* pasien
* dokter
* poli
* antrian
* jadwal_dokter
* pemeriksaan
* riwayat_kunjungan
* otp_verifikasi
* notifikasi

Setiap tabel sudah dilengkapi dengan primary key, foreign key, dan relasi antar tabel untuk menjaga konsistensi data.

Struktur lengkap database terdapat pada berkas SQL dump yang berisi:

* Pembuatan tabel
* Penambahan index
* Penambahan foreign key
* Data awal untuk tabel poli
* Aturan AUTO_INCREMENT

## Cara Menjalankan Proyek

1. Clone repository:

   ```
   git clone https://github.com/Musyaaan/Antrian-Klinik.git
   ```

2. Letakkan folder proyek ke dalam direktori:

   ```
   C:\xampp\htdocs\
   ```

3. Import database:

   * Buka phpMyAdmin
   * Buat database baru dengan nama `antrian_klinik`
   * Import file SQL yang tersedia

4. Jalankan Apache dan MySQL melalui XAMPP.

5. Akses aplikasi melalui browser:

   ```
   http://localhost/Klinik/
   ```

## Lisensi

Proyek ini dibuat untuk tujuan pembelajaran dan pengembangan akademik.

---
