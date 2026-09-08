# Rencana Implementasi Sistem Terpadu Jessa Kost

Permintaan ini mencakup 6 fitur besar yang membutuhkan perubahan pada arsitektur database, pembuatan antarmuka (UI) baru, dan penulisan logika controller yang kompleks. Untuk memastikan semuanya aman dan berjalan tanpa bug, kita akan mengerjakannya secara terstruktur.

## Open Questions
- **Untuk OTP Email:** Apakah Anda sudah memiliki konfigurasi SMTP (seperti Gmail/Mailtrap/Brevo) di `.env` untuk mengirim email? Jika belum, saya akan memandu cara setup-nya nanti.
- **Untuk Manajemen WiFi:** Apakah WiFi menggunakan sistem Voucher (setiap anak kost beda kode), atau sistem SSID & Password biasa yang dibagikan (misal per lantai/gedung)? Saya akan asumsikan sistem SSID & Password biasa jika tidak ada konfirmasi.

## Proposed Changes

### 1. Pelaporan Keluhan (Sarpras & Lainnya)
Fitur ini akan menggunakan tabel `tickets` yang sudah ada, namun belum memiliki antarmuka (UI) fungsional.
#### [NEW] `resources/views/tenant/tickets/index.blade.php` & `create.blade.php` (Penyewa dapat membuat tiket pelaporan dengan foto bukti).
#### [NEW] `resources/views/admin/tickets/index.blade.php` (Admin dapat melihat, mengubah status ke 'Diproses', dan menyelesaikan).
#### [MODIFY] `app/Http/Controllers/TenantController.php` & `AdminController.php` (Menambahkan logika CRUD untuk Tiket).

### 2. Sistem Registrasi dengan OTP Email
Mengganti sistem pendaftaran bawaan (Breeze) menjadi sistem verifikasi OTP 6 digit.
#### [NEW] Migration: `add_otp_fields_to_users_table.php` (menambahkan `otp_code`, `otp_expires_at`, `email_verified_at` jika belum ada).
#### [NEW] `resources/views/auth/verify-otp.blade.php` (Halaman untuk memasukkan 6 digit OTP).
#### [MODIFY] `app/Http/Controllers/Auth/RegisteredUserController.php` (Hentikan login otomatis setelah register, kirim email OTP, redirect ke halaman verifikasi OTP).
#### [NEW] `app/Mail/OtpMail.php` (Template email Mailable).

### 3. Payment Gateway (Penyempurnaan Mayar.id)
Kita sudah mengintegrasikan Mayar.id pada sesi sebelumnya untuk pembayaran tagihan (webhook `payment.received` sudah berjalan).
#### [MODIFY] Pastikan webhook `WebhookController` memproses jenis tagihan "Sewa Kamar", bukan hanya "Listrik" saja.
#### [MODIFY] Tombol "Bayar via QRIS (Mayar)" disempurnakan di Dasbor Tenant.

### 4. Manajemen WiFi
Membuat sistem agar Admin dapat membagikan info WiFi ke anak kost, dan anak kost dapat melihatnya di dasbor mereka.
#### [NEW] Migration & Model: `WifiNetwork` (SSID, password, lokasi/lantai).
#### [NEW] `resources/views/admin/wifi/index.blade.php` (CRUD untuk Admin mengatur password wifi).
#### [MODIFY] `resources/views/tenant/dashboard.blade.php` (Menampilkan kartu informasi WiFi aktif untuk penghuni).

### 5. Pengeluaran / Expense Management
Pencatatan uang keluar (beli sapu, token listrik fasilitas umum, gaji staf, perbaikan keluhan).
#### [NEW] Migration & Model: `Expense` (kategori, nominal, tanggal, bukti_nota, user_id).
#### [NEW] `resources/views/admin/expenses/index.blade.php` (Admin dapat menginput pengeluaran).
#### [NEW] `resources/views/owner/expenses/index.blade.php` (Owner dapat memantau seluruh pengeluaran bulanan).

### 6. Manajemen Pembayaran Sewa (Owner)
Owner butuh rekapitulasi khusus untuk arus kas masuk dari penyewaan kamar.
#### [NEW] `resources/views/owner/payments/index.blade.php` (Tabel khusus Owner berisi daftar tagihan sewa bulanan, siapa yang nunggak, dan siapa yang lunas).
#### [MODIFY] `app/Http/Controllers/OwnerController.php` (Menambahkan method `rentPayments` yang menggabungkan model `Lease` dan `Bill`).

---

## Verification Plan
1. **Automated / Manual Routing:** Menjalankan `php artisan migrate` untuk tabel `expenses`, `wifi_networks`, dan field OTP.
2. **Mail Testing:** Menguji pendaftaran akun baru hingga menerima email berisi kode OTP 6-digit.
3. **Role Testing:** Memastikan Admin bisa input pengeluaran dan melihat WiFi, sedangkan Tenant hanya bisa melihat WiFi dan membuat Tiket keluhan. Owner bisa memantau Pengeluaran dan Pemasukan Sewa.

