# Aplikasi Rental Mobil (CodeIgniter 4)

Aplikasi sederhana untuk manajemen rental mobil, dibangun menggunakan framework CodeIgniter 4.

## Fitur Utama

*   **Autentikasi User**: Login dan Logout dengan keamanan password hashing.
*   **Manajemen Mobil**: CRUD data mobil (Tambah, Edit, Hapus, List).
*   **Manajemen Pelanggan**: CRUD data pelanggan dan cetak data pelanggan.
*   **Transaksi Sewa**:
    *   Mencatat penyewaan mobil.
    *   Otomatis menghitung total biaya berdasarkan lama sewa.
    *   Cetak Kwitansi Sewa.
    *   Update status mobil menjadi "sedang disewa".
*   **Pengembalian Mobil**:
    *   Mencatat pengembalian mobil.
    *   **Fitur Denda Otomatis**: Menghitung denda jika terjadi keterlambatan (Trigger Database).
    *   Update status mobil kembali menjadi "tersedia" setelah dikembalikan.
    *   Cetak Bukti Pengembalian.
*   **Laporan**: Filter laporan penyewaan berdasarkan rentang tanggal dan cetak laporan.

## Persyaratan Sistem

*   PHP version 8.1 atau lebih baru.
*   Composer.
*   Database MySQL/MariaDB.
*   Web Server (Apache/Nginx) atau menggunakan `php spark serve`.

## Instalasi

1.  **Clone / Ekstrak Project**
    Pastikan file project berada di direktori web server Anda (misal: `c:\laragon\www\rental-mobil`).

2.  **Konfigurasi Database**
    *   Buat database baru di MySQL, misalnya bernama `rental_mobil`.
    *   Copy file `env` menjadi `.env`:
        ```bash
        cp env .env
        ```
    *   Edit file `.env` dan sesuaikan konfigurasi database:
        ```ini
        CI_ENVIRONMENT = development

        database.default.hostname = localhost
        database.default.database = rental_mobil
        database.default.username = root
        database.default.password =
        database.default.DBDriver = MySQLi
        ```

3.  **Jalankan Migrasi**
    Buat tabel-tabel database dengan perintah:
    ```bash
    php spark migrate
    ```

4.  **Isi Data Awal (Seeder)**
    Isi database dengan data user admin, mobil dummy, dan pelanggan dummy:
    ```bash
    php spark db:seed UserSeeder
    php spark db:seed PelangganSeeder
    php spark db:seed MobilSeeder
    ```

## Penggunaan

1.  **Jalankan Aplikasi** 
    ```bash
    php spark serve
    ```
    Lalu akses `http://localhost:8080`.

2.  **Login**
    Gunakan akun default berikut untuk masuk:
    *   **Username**: `admin`
    *   **Password**: `admin123`

3.  **Halaman Dashboard**
    Setelah login, Anda akan diarahkan ke dashboard dengan akses cepat ke menu Pelanggan, Mobil, Sewa, Pengembalian, dan Laporan.

## Struktur Database

*   `users`: Menyimpan data admin.
*   `mobils`: Menyimpan data armada mobil.
*   `pelanggans`: Menyimpan data pelanggan.
*   `sewas`: Menyimpan transaksi penyewaan (Foreign Key ke `mobils` dan `pelanggans`).
*   `pengembalians`: Menyimpan data pengembalian (Foreign Key ke `sewas`).
*   **Trigger**: `before_insert_pengembalians` (Menghitung denda otomatis jika `tgl_kembali` > `tgl_sewa` + `lama_sewa`).

## Troubleshooting Umum

*   **Error 404 pada Login**: Pastikan konfigurasi Routes sudah benar dan `CI_ENVIRONMENT` di set ke `development`.
*   **Gagal Hapus Data**: Jika muncul pesan error saat menghapus mobil/pelanggan, itu karena data tersebut sedang digunakan di transaksi sewa (Foreign Key Constraint). Hapus data transaksinya terlebih dahulu.

---
Dibuat untuk keperluan studi kasus implementasi CodeIgniter 4.
