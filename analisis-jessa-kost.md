# Kilas Balik & Analisis Permasalahan Jessa Kost

Dokumen ini merupakan analisis komprehensif mengenai permasalahan operasional yang biasa terjadi di Jessa Kost, dan bagaimana sistem manajemen digital yang telah kita bangun memberikan solusi atas permasalahan tersebut.

---

## 1. Masalah Keuangan & Tunggakan Pembayaran
**Permasalahan di Lapangan:**
* **Pelacakan Manual yang Rumit:** Pemilik (Owner) dan Admin sering kesulitan melacak siapa saja penghuni yang sudah bayar, belum bayar, atau telat membayar sewa kamar.
* **Perhitungan Denda/Keterlambatan:** Menghitung berapa hari seorang penghuni terlambat membayar seringkali tidak akurat karena perbedaan zona waktu pencatatan atau kelalaian manusia.
* **Validasi Bukti Transfer:** Memakan waktu karena admin harus mengecek mutasi rekening secara manual setiap kali penghuni mengklaim sudah membayar.

**Solusi Sistem Jessa Kost:**
* **Dashboard Tagihan Terpusat:** Sistem secara otomatis memisahkan tagihan berdasarkan kategori (Sewa Kamar, Listrik, WiFi) beserta statusnya (Lunas / Belum Lunas).
* **Perhitungan Hari Keterlambatan Otomatis (Timezone-Aware):** Sistem mendeteksi secara presisi dan seketika (real-time) jumlah hari keterlambatan berdasarkan waktu lokal (WIB), sehingga Owner bisa melihat label "Telat X Hari" dengan akurat.
* **Integrasi Payment Gateway (Mayar):** Pembayaran kini terverifikasi otomatis. Begitu penghuni membayar melalui *virtual account* atau e-wallet, status tagihan otomatis berubah menjadi "Lunas" tanpa intervensi manual Admin.

---

## 2. Manajemen Utilitas (Listrik & WiFi)
**Permasalahan di Lapangan:**
* **Distribusi Token Listrik:** Penghuni kehabisan listrik tengah malam, dan Admin kesulitan mendistribusikan kode token listrik secara efisien.
* **Informasi WiFi yang Sering Ditanyakan:** Penghuni baru atau penghuni lama sering lupa dan berulang kali menanyakan *password* WiFi kepada Admin.

**Solusi Sistem Jessa Kost:**
* **Modul Token Listrik Digital:** Admin dapat langsung mengunggah struk token atau mengetikkan kode token ke dalam sistem. Penghuni cukup menekan tombol "Lihat Token" di dashboard mereka untuk mendapatkan kodenya (meskipun hanya berupa foto atau hanya berupa teks).
* **Widget WiFi Otomatis:** Kredensial WiFi (SSID dan Password) kini terpampang elegan di beranda dashboard penghuni, mengurangi beban pertanyaan berulang ke nomor WhatsApp pengelola.

---

## 3. Keamanan & Pemantauan Tamu
**Permasalahan di Lapangan:**
* **Tamu Tak Dikenal:** Kurangnya pengawasan terhadap siapa saja pihak luar yang keluar-masuk atau menginap di kost, yang berpotensi menimbulkan risiko keamanan.
* **Pendataan Identitas:** Pengumpulan KTP tamu menginap yang dilakukan secara fisik rentan hilang atau tercecer.

**Solusi Sistem Jessa Kost:**
* **Sistem Buku Tamu (Guest Log):** Penghuni diwajibkan melapor secara mandiri melalui portal mereka. Sistem membedakan secara cerdas antara tamu yang hanya berkunjung (tidak wajib KTP) dan tamu yang menginap (wajib unggah foto KTP valid).

---

## 4. Pemeliharaan Fasilitas & Komplain
**Permasalahan di Lapangan:**
* **Komplain yang Tertumpuk di WhatsApp:** Laporan kerusakan (AC bocor, lampu mati, keran rusak) sering tenggelam di *chat* WhatsApp Admin sehingga penanganannya lambat.
* **Transparansi Biaya Perbaikan:** Pemilik (Owner) tidak tahu pasti berapa rincian biaya perbaikan fasilitas karena pencatatan pengeluaran tidak rapi.

**Solusi Sistem Jessa Kost:**
* **Sistem Tiket Kerusakan (Ticketing):** Penghuni dapat membuat tiket laporan kerusakan yang terpantau statusnya (Menunggu, Dikerjakan, Selesai).
* **Rekap Biaya Perbaikan:** Admin wajib memasukkan estimasi atau total biaya perbaikan ke dalam tiket tersebut, yang nantinya akan terekap secara otomatis ke dalam laporan pengeluaran Owner.

---

## 5. Komunikasi & Pengumuman
**Permasalahan di Lapangan:**
* **Informasi Terabaikan:** Broadcast pesan aturan baru atau pengumuman kost via WhatsApp sering diabaikan atau tertumpuk *chat* lain.

**Solusi Sistem Jessa Kost:**
* **Papan Pengumuman Digital:** Modul khusus yang memastikan setiap informasi penting selalu tersemat di portal Penghuni. Pengumuman bisa diatur masa aktifnya oleh Admin (Tampilkan/Sembunyikan).

---

## Kesimpulan
Sistem yang kita kembangkan telah mengubah Jessa Kost dari sebuah bisnis konvensional menjadi **Properti yang Dikelola Berbasis Data (Data-Driven Property)**. Alur kerja yang sebelumnya bergantung pada daya ingat dan pencatatan manual kini telah didelegasikan sepenuhnya pada otomatisasi sistem, memberikan kenyamanan maksimal bagi **Penghuni**, efisiensi waktu bagi **Admin**, dan visibilitas finansial yang transparan bagi **Owner**.
