# Sistem Penjualan Elektronik (CodeIgniter 3 & PHP 7.4)

![PHP](https://img.shields.io/badge/PHP-7.4-blueviolet) ![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3-red) ![RajaOngkir](https://img.shields.io/badge/Integrasi-RajaOngkir-orange)

Sistem Penjualan Elektronik ini dibangun menggunakan framework **CodeIgniter 3** dan berjalan pada versi **PHP 7.4**. Aplikasi ini dirancang untuk mempermudah proses jual beli produk elektronik secara online. Salah satu fitur utamanya adalah integrasi dengan **RajaOngkir** untuk penghitungan ongkos kirim secara otomatis.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Penggunaan](#penggunaan)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

---

## Fitur Utama ✨

- Manajemen Produk (CRUD)
- Manajemen Kategori Produk
- Keranjang Belanja
- Proses Checkout
- Integrasi RajaOngkir untuk perhitungan ongkos kirim
- Manajemen Pesanan
- Autentikasi Pengguna (Login & Registrasi)
- Panel Admin untuk pengelolaan sistem

---

## Prasyarat ⚙️

Sebelum memulai, pastikan sistem Anda memenuhi prasyarat berikut:

- **PHP 7.4** atau versi lebih baru (disarankan PHP 7.4)
- **Web Server** (Apache, Nginx, atau sejenisnya)
- **Database** (MySQL, MariaDB, atau sejenisnya)
- **Composer** (untuk manajemen dependensi PHP, terutama jika menggunakan library untuk `.env`)
- Akun **RajaOngkir** (untuk mendapatkan API Key)

---

## Instalasi 🚀

Ikuti langkah-langkah berikut untuk menginstal proyek ini:

1.  **Clone repository:**

    ```bash
    git clone [https://github.com/usernameanda/nama-repo.git](https://github.com/usernameanda/nama-repo.git)
    cd nama-repo
    ```

2.  **Install dependensi Composer (jika ada):**
    Jika proyek Anda menggunakan Composer untuk autoloading atau library pihak ketiga (seperti `phpdotenv` untuk file `.env`), jalankan:

    ```bash
    composer install
    ```

3.  **Konfigurasi database secara manual (jika tidak menggunakan `.env` untuk database):**
    Buka file `application/config/database.php` dan sesuaikan dengan konfigurasi database Anda jika Anda tidak mengkonfigurasi database melalui `.env`.

4.  **Import database:**
    Import file `.sql` yang disediakan (jika ada) ke database Anda. Biasanya bernama `database.sql` atau sejenisnya.

---

## Konfigurasi 📝

Aplikasi ini menggunakan file `.env` untuk menyimpan konfigurasi sensitif. **Penting:** CodeIgniter 3 secara default tidak mendukung file `.env`. Anda perlu mengimplementasikan library seperti `vlucas/phpdotenv` melalui Composer dan memuatnya di awal aplikasi Anda (misalnya di `index.php` atau hook) agar variabel di `.env` dapat diakses.

1.  **Pastikan file `.env.example` ada:**
    File `env.example` sudah disediakan di root direktori proyek ini. File ini berisi contoh variabel lingkungan yang dibutuhkan.
    Isi dari `.env.example` kurang lebih akan seperti ini:

    ```env
    # URL Dasar Aplikasi Anda
    BASE_URL="http://localhost/nama-proyek-anda/"

    # Konfigurasi Database
    DB_HOST="localhost"
    DB_USER="root"
    DB_PASS=""
    DB_NAME="nama_database_anda"
    # DB_DRIVER="mysqli" # Opsional, jika Anda ingin menentukannya di sini juga

    # Konfigurasi RajaOngkir
    RAJAONGKIR_API_KEY="MASUKKAN_API_KEY_RAJAONGKIR_ANDA"
    RAJAONGKIR_ACCOUNT_TYPE="starter" # atau basic, pro (sesuaikan dengan tipe akun RajaOngkir Anda)
    ```

2.  **Salin file `.env.example` menjadi `.env`:**
    Dari root direktori proyek Anda, jalankan perintah berikut di terminal:

    ```bash
    cp .env.example .env
    ```

    Ini akan membuat file `.env` baru yang merupakan salinan dari `.env.example`.

3.  **Sesuaikan file `.env`:**
    Buka file `.env` yang baru dibuat dan isi variabel-variabel berikut sesuai dengan kebutuhan spesifik Anda:

    ```env
    BASE_URL="http://localhost/proyek-penjualan-elektronik/" # Ganti dengan URL aplikasi Anda

    DB_HOST="localhost" # atau host database Anda
    DB_USER="user_db_anda"
    DB_PASS="password_db_anda"
    DB_NAME="nama_db_anda"
    # DB_DRIVER="mysqli" # Jika Anda menentukannya di .env

    RAJAONGKIR_API_KEY="API_KEY_RAJAONGKIR_YANG_VALID"
    RAJAONGKIR_ACCOUNT_TYPE="starter" # Sesuaikan dengan tipe akun Anda
    ```

    **Jangan pernah commit file `.env` Anda ke repository Git.** File `.env` berisi informasi sensitif. Pastikan `.env` sudah ada di dalam file `.gitignore` Anda.

4.  **Pastikan CodeIgniter Membaca Variabel `.env`:**

    - Jika Anda menggunakan `vlucas/phpdotenv`, pastikan Anda telah menambahkannya ke `composer.json` dan menginstalnya (`composer install`).
    - Kemudian, di file `index.php` utama proyek CodeIgniter Anda (di root direktori), tambahkan kode berikut di bagian paling atas setelah `<?php`:
      ```php
      require_once __DIR__ . '/vendor/autoload.php';
      $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
      $dotenv->load();
      ```
    - Anda kemudian perlu menyesuaikan file konfigurasi CodeIgniter (misalnya `application/config/config.php` untuk `base_url` dan `application/config/database.php` untuk koneksi database) agar membaca nilai dari `getenv('NAMA_VARIABEL')` atau `$_ENV['NAMA_VARIABEL']`.
      Contoh untuk `application/config/config.php`:

      ```php
      $config['base_url'] = getenv('BASE_URL') ?: 'http://localhost/'; // Fallback jika tidak ada di .env
      ```

      Contoh untuk `application/config/database.php`:

      ```php
      $active_group = 'default';
      $query_builder = TRUE;

      $db['default'] = array(
          'dsn'      => '',
          'hostname' => getenv('DB_HOST') ?: 'localhost',
          'username' => getenv('DB_USER') ?: '',
          'password' => getenv('DB_PASS') ?: '',
          'database' => getenv('DB_NAME') ?: '',
          'dbdriver' => getenv('DB_DRIVER') ?: 'mysqli', // Atau driver default Anda
          'dbprefix' => '',
          'pconnect' => FALSE,
          'db_debug' => (ENVIRONMENT !== 'production'),
          'cache_on' => FALSE,
          'cachedir' => '',
          'char_set' => 'utf8',
          'dbcollat' => 'utf8_general_ci',
          'swap_pre' => '',
          'encrypt'  => FALSE,
          'compress' => FALSE,
          'stricton' => FALSE,
          'failover' => array(),
          'save_queries' => TRUE
      );
      ```

5.  **Konfigurasi RajaOngkir:**
    - Pastikan Anda telah mendaftar di [RajaOngkir](https://rajaongkir.com/) dan mendapatkan API Key.
    - Masukkan API Key Anda pada variabel `RAJAONGKIR_API_KEY` di file `.env`.
    - Sesuaikan `RAJAONGKIR_ACCOUNT_TYPE` dengan tipe akun RajaOngkir Anda.

---

## Penggunaan 🛠️

1.  Akses aplikasi melalui browser dengan URL yang telah Anda konfigurasi (misalnya, `http://localhost/proyek-penjualan-elektronik/`).
2.  **Halaman Pengguna:**
    - Pengguna dapat melakukan registrasi dan login.
    - Melihat daftar produk, menambahkan ke keranjang, dan melakukan checkout.
    - Ongkos kirim akan dihitung secara otomatis saat proses checkout menggunakan data dari RajaOngkir.
3.  **Halaman Admin:**
    - Akses panel admin (biasanya melalui rute seperti `/admin` atau `/auth`).
    - Login dengan kredensial admin.
    - Kelola produk, kategori, pesanan, dan pengguna.

---

## Kontribusi 🤝

Kontribusi sangat kami harapkan! Jika Anda ingin berkontribusi, silakan lakukan langkah-langkah berikut:

1.  Fork repository ini.
2.  Buat branch baru (`git checkout -b fitur/NamaFitur`).
3.  Commit perubahan Anda (`git commit -m 'Menambahkan Fitur X'`).
4.  Push ke branch Anda (`git push origin fitur/NamaFitur`).
5.  Buat Pull Request baru.

---

Selamat menggunakan sistem penjualan elektronik ini! Jika ada pertanyaan atau masalah, jangan ragu untuk membuat _issue_ di repository ini.
