# PHP_SistemManajemenKontak
Fadhil Akbar (2315061037)

Sistem ini adalah aplikasi sederhana berbasis PHP yang digunakan untuk mengelola data kontak secara praktis melalui fitur CRUD (Create, Read, Update, Delete). Aplikasi ini tidak menggunakan database, tetapi memanfaatkan PHP Session untuk menyimpan data selama sesi berjalan, sehingga cocok untuk pembelajaran dan demonstrasi konsep dasar CRUD di PHP.

Fitur Utama
1. Tambah Kontak – Menambahkan data kontak berupa nama, email, dan nomor telepon.
2. Edit Kontak – Memperbarui informasi kontak secara langsung.
3. Hapus Kontak – Menghapus data kontak yang tidak diperlukan.
4. Tampilan Daftar Kontak – Menampilkan seluruh kontak yang tersimpan di session.
5. Desain Modern – Menggunakan Bootstrap 5 agar tampilan lebih rapi dan responsif.

Struktur File: 
sistem/

── index.php       → Menampilkan daftar kontak  
── tambah.php      → Form untuk menambahkan kontak  
── edit.php        → Form untuk mengedit kontak  
── hapus.php       → Menghapus kontak berdasarkan ID  
── README.md       → Dokumentasi proyek  

Teknologi yang Digunakan
1. PHP 7/8
2. Bootstrap 5
3. Session untuk penyimpanan data sementara

Cara Menjalankan
1. Pastikan Anda sudah menginstall XAMPP / Laragon / PHP Server lainnya.
2. Taruh folder proyek ini ke dalam htdocs atau direktori server Anda.
3. Jalankan server Apache.
   
Akses aplikasi melalui browser:
http://localhost/sistem/

Catatan
1. Data kontak tidak permanen, karena menggunakan session; data akan hilang saat browser ditutup atau session berakhir.
2. Proyek ini dirancang sebagai latihan implementasi CRUD dasar, form handling, dan validasi sederhana di PHP.

Kontributor:
Fadhil Akbar – Developer
