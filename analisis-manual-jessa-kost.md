# Analisis Permasalahan Operasional Jessa Kost (Skenario Sistem Manual)

## 1. Latar Belakang
Jessa Kost adalah sebuah usaha di bidang properti yang menyewakan kamar kost untuk berbagai kalangan. Saat ini, seluruh proses bisnis di Jessa Kost mulai dari pendaftaran penghuni, pembayaran sewa, hingga pelaporan keluhan masih dilakukan secara konvensional (manual). Pengelola (Admin) hanya mengandalkan pencatatan melalui buku besar, *spreadsheet* sederhana, dan komunikasi melalui aplikasi WhatsApp. Seiring bertambahnya jumlah kamar dan penghuni, proses manual ini mulai menimbulkan berbagai masalah operasional yang menghambat perkembangan bisnis.

## 2. Identifikasi Permasalahan (Berdasarkan Proses Bisnis)

### A. Aspek Pemasaran & Pelayanan Calon Penghuni
1. **Pengecekan Ketersediaan Kamar yang Tidak Praktis:** Calon penghuni (masyarakat umum) harus datang langsung ke lokasi kost hanya untuk menanyakan apakah ada kamar kosong, mengecek harga, atau melihat fasilitas. Hal ini sangat menyulitkan calon penghuni, terutama mahasiswa atau pekerja yang berasal dari luar kota.
2. **Potensi Kehilangan Calon Pelanggan (Lost Sales):** Ketika calon penghuni datang berkunjung namun pengelola (Admin) kebetulan sedang tidak ada di tempat, calon penghuni seringkali membatalkan niatnya dan mencari kost kompetitor lain yang informasinya lebih mudah diakses.

### B. Aspek Keuangan & Penagihan (Billing)
1. **Pengecekan Pembayaran yang Tidak Efisien:** Penghuni membayar sewa kamar melalui transfer bank dan mengirimkan bukti transfer berupa foto ke WhatsApp Admin. Admin harus membuka aplikasi perbankan (m-banking) secara manual untuk mencocokkan mutasi rekening satu per satu.
2. **Kesulitan Melacak Tunggakan:** Karena pencatatan dilakukan di buku atau Excel, Admin sering terlewat mengecek tanggal jatuh tempo setiap penghuni yang berbeda-beda. Hal ini menyebabkan banyak penghuni yang menunggak tanpa disadari, dan perhitungan denda keterlambatan menjadi tidak akurat.
3. **Laporan Keuangan yang Tidak Transparan:** Pemilik (Owner) kesulitan mendapatkan rekapitulasi pendapatan dan pengeluaran secara *real-time* karena harus menunggu Admin merekap nota dan catatan fisik setiap akhir bulan.

### C. Aspek Operasional & Manajemen Fasilitas
1. **Distribusi Token Listrik yang Merepotkan:** Pengisian token listrik masih dilakukan secara manual. Penghuni sering kehabisan listrik di tengah malam dan harus mengirim pesan ke Admin, yang mana sangat tidak efisien dan mengganggu waktu istirahat pengelola.
2. **Manajemen Keluhan (Maintenance) yang Buruk:** Saat ada fasilitas yang rusak (misal: AC bocor, lampu mati), penghuni melapor via WhatsApp. Pesan ini sering tenggelam (tertumpuk) oleh pesan lain, menyebabkan perbaikan terlambat dilakukan dan memicu ketidakpuasan penghuni.

### D. Aspek Administrasi & Keamanan
1. **Data Penghuni yang Berserakan:** Berkas fisik identitas penghuni (fotokopi KTP) rentan hilang atau rusak. Saat dibutuhkan, pencarian data memakan waktu lama.
2. **Lemahnya Pengawasan Keamanan (Buku Tamu):** Tidak ada pencatatan yang sistematis mengenai tamu yang keluar-masuk atau menginap. Penghuni sering membawa teman menginap tanpa sepengetahuan pengelola, yang berpotensi melanggar aturan kost dan membahayakan keamanan.
3. **Penyampaian Informasi Tidak Efektif:** Pengumuman aturan baru atau jadwal kebersihan hanya di-*broadcast* via WhatsApp, yang sering kali diabaikan atau tidak dibaca oleh penghuni.

---

## 3. Analisis Berdasarkan Kerangka PIECES

Untuk mengevaluasi kelemahan sistem manual ini, dapat digunakan metode PIECES:

*   **P (Performance - Kinerja):** Kinerja pengelola sangat lambat karena harus memproses segala sesuatunya (mengecek mutasi, mencatat tagihan, merespons komplain) secara berulang dan manual.
*   **I (Information - Informasi):** Calon penghuni tidak bisa mengakses informasi ketersediaan kamar dari jarak jauh. Selain itu, informasi keuangan internal dan status kamar sering tidak akurat bagi Owner.
*   **E (Economics - Ekonomi):** Terdapat kerugian berupa hilangnya potensi pendapatan (*lost sales*) dari calon penghuni yang batal menyewa, serta potensi denda keterlambatan yang luput tertagih akibat *human error*.
*   **C (Control - Kendali):** Lemahnya kendali keamanan karena tidak adanya riwayat buku tamu, serta kurangnya kontrol Owner terhadap kinerja harian Admin.
*   **E (Efficiency - Efisiensi):** Pencatatan identitas penghuni, pembuatan kwitansi, dan menjawab pertanyaan ketersediaan kamar yang berulang membuang terlalu banyak waktu pengelola.
*   **S (Service - Layanan):** Kualitas layanan buruk karena calon penghuni wajib datang ke lokasi hanya untuk bertanya, dan lambatnya penanganan komplain kerusakan bagi penghuni aktif.

## 4. Kesimpulan
Sistem operasional Jessa Kost yang berjalan secara manual saat ini sudah tidak memadai untuk mendukung proses bisnis yang efektif dan efisien. Diperlukan adanya sebuah Sistem Informasi Manajemen Kost berbasis web (terdigitalisasi) untuk mengotomatisasi penagihan, memusatkan data penghuni, menangani keluhan, serta menyajikan laporan keuangan secara *real-time* kepada pemilik bisnis.
