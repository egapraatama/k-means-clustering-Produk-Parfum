# Product Requirements Document (PRD)

**Sistem Analisis Clustering Menggunakan Metode K-Means Untuk Mendukung Keputusan Produk Parfum Pada Toko Parfum R2DH**

---

## 1. Pendahuluan

Sistem ini bertujuan untuk mengelompokkan data penjualan dan minat produk parfum menggunakan algoritma K-Means Clustering. Hasil pengelompokkan (clustering) ini nantinya akan digunakan oleh Pimpinan Toko R2DH sebagai dasar pengambilan keputusan terkait produk mana yang harus dipertahankan stoknya, ditingkatkan promosinya, atau dievaluasi penjualannya.

---

## 2. Spesifikasi Modul K-Means & Fitur

Struktur fitur dikelompokkan sesuai dengan kebutuhan proses algoritma K-Means.

### 2.1. DATASET (Data Mentah Ketika Upload CSV)

Sistem dapat menerima dataset awal dari riwayat data produk. Tabel ini harus menampung data riil yang sesuai dengan format sumber data (200 baris sampel seperti Black Orchid, White Musk, dll).

**Informasi Kolom Dataset:**

- `No` : Nomor identitas atau urutan.
- `Nama Parfum` : Nama produk (Misal: Black Orchid, White Musk).
- `Harga Parfum` : Harga jual dari parfum tersebut. (Numerik)
- `Volume` : Takaran isi produk parfum. (Numerik)
- `Penjualan` : Angka penjualan yang berhasil tercapai. (Numerik)
- `Frekuensi Pembelian` : Pengulangan rata-rata pelanggan membeli. (Numerik)
- `Jenis Aroma` : Varian harum parfum (Fresh, Woody, Oriental). (Kategorikal Teks)
- `Rating Pelanggan` : Tingkat kepuasan (Bagus, Tidak Dinilai). (Kategorikal Teks)

**Acceptance Criteria Terhadap Fitur Ini:**

- [ ] Admin dapat mengunggah file berekstensi CSV yang berisi data dataset mentah produk parfum.
- [ ] Sistem dapat membaca, memvalidasi pemisah (koma / titik koma delimiter), dan menyimpan data mentah ke database tanpa menghancurkan tipe data aslinya.
- [ ] Terdapat fitur preview data mentah (minimal berbentuk tabel paginasi) sebelum maupun sesudah CSV diimpor.

---

### 2.2. DATA ATRIBUT (Data Kriteria Label)

Algoritma K-Means membutuhkan data berjenis numerik untuk menghitung jarak antar titik data. Oleh karena itu, semua `Dataset Mentah` harus di-transformasi / di-mapping ke dalam susunan data perhitungan yang disebut `Atribut Kriteria`.

**Daftar Kriteria (C) Untuk Analisa:**

1. **C1 (Harga Parfum):** Tetap pada nilai numerik aslinya / dikonversi dalam skala (misal dibagi ribuan).
2. **C2 (Volume):** Tetap numerik (contoh: 2, 8, 3).
3. **C3 (Penjualan):** Tetap numerik (contoh: 15, 10, 5).
4. **C4 (Frekuensi Pembelian):** Pengelompokan numerik jika perlu sesuai model frekuensi.
5. **C5 (Jenis Aroma):** Mapping Teks ke Angka (Misal: `Fresh` = 1, `Woody` = 2, `Oriental` = 3).
6. **C6 (Rating Pelanggan):** Mapping Teks ke Angka (Misal: `Tidak Dinilai` = 0, `Bagus` = 1).

**Acceptance Criteria Terhadap Fitur Ini:**

- [ ] Sistem memiliki fungsi otomatis untuk merubah (transformasi) tipe data kategorikal (Jenis Aroma & Rating Pelanggan) menjadi angka numerik di sisi memori memori backend sebelum perhitungan.
- [ ] Pengguna disediakan tabel view (sementara) yang memperlihatkan _Data Training Hasil Normalisasi/Transformasi_ yang benar-benar siap diproses oleh K-Means.

---

### 2.3. CENTROID DIPILIH

Pemilihan nilai awal (pusat cluster/titik tengah cluster). Misalnya akan diputuskan menjadi 2 kelompok klaster: `Klaster 1 (Kurang Laku)` dan `Klaster 2 (Sangat Laku)` sehingga akan ada 2 Titik Centroid awal.

**Mekanisme Centroid:**

- Aplikasi memungkinkan penentuan **Centroid Awal** dengan 2 opsi (atau minimal salah satu):
  1. _Random (Otomatis)_: Sistem secara acak merandom ID Alternatif pada array memori yang dijadikan nilai C1 awal dan C2 awal.
  2. _By Value (Manual)_: Di mana nilai awal di-supply dari record awal dan akhir pada urutan database.

**Acceptance Criteria Terhadap Fitur Ini:**

- [ ] Pengguna (Admin) harus bisa meng-inputkan berapa nilai **K** (Misal: 2 atau 3 klaster) sebelum mulai kalkulasi.
- [ ] Terdapat visualisasi tabel awal khusus mendaftar posisi **Nilai Centroid Awal** dengan Kriteria (C1-C6) sebelum proses iterasi berjalan.

---

### 2.4. HASIL CLUSTERING (Analisa Metode K-MEANS - Semua Perhitungan Disini)

Fase ini merupakan _Core Engine_ algoritma K-Means. Semua _Black-box_ algoritma harus diprint-out secara transparan ke dalam tampilan User Interface dari log iterasi ke-1 sampai _n_-iterasi hingga letak centroid tidak berubah.

**Alur Perhitungan yang Akan Ditampilkan:**

1. **Menghitung Jarak / Euclidean Distance:**
   Data Parfum ke-i terhadap Centroid K-j.
   _Rumus: `D(x,c) = sqrt((Cx1 - Cc1)^2 + (Cx2 - Cc2)^2 + ... + (Cxn - Ccn)^2)`_
2. **Pengelompokan (Clustering):**
   Membandingkan hasil Jarak Euclidean. Parfum A akan masuk ke `Cluster 1` apabila "Jarak ke Centroid 1" `<` "Jarak ke Centroid 2".
3. **Pembaruan Centroid (New Centroid Update):**
   Setelah semua produk terbagi, Sistem akan menghitung Nilai Rata-Rata (Mean) untuk semua entitas yang ada di dalam `Cluster N`. Mean tersebut akan mengganti titik koordinat nilai Centroid yang baru.
4. **Iterasi Otomatis (Looping):**
   Mengulang perputaran langkah **1 s.d. 3** hingga mencapai kondisi: "Nilai Anggota Cluster Iterasi Saat Ini sama dengan Anggota Cluster Iterasi Sebelumnya".

**Acceptance Criteria Terhadap Fitur Ini:**

- [ ] **Tampilan History Iterasi**: Sistem menampilkan progress Iterasi 1, Iterasi 2, dst berupa tabel _Distance Matrix_ & _Cluster Result_ secara lengkap di layar admin.
- [ ] **Validasi Akhir:** Looping PHP/Algoritma divalidasi berhenti berjalan tanpa infinite-loop ketika anggota array di cluster baru == anggota array cluster lama.
- [ ] **Tabulasi Hasil Akhir**: Menampilkan rincian daftar Parfum yang termasuk `Cluster 1`, `Cluster 2`, dll di halaman paling akhir (Summary/Dashboard Kesimpulan).
- [ ] Pimpinan Toko R2DH dapat mem-print (PDF / Cetak halaman) sebagai landasan keputusan.

---

## 3. Arsitektur Sistem (MVC)

Sistem ini dibangun menggunakan arsitektur perangkat lunak **MVC (Model-View-Controller)** dengan bahasa pemrograman **PHP** dan basis data **MySQL**, yang memisahkan antara logika aplikasi, struktur data, dan antarmuka pengguna:

- **Model:** Mengelola representasi entitas data MySQL, mengoperasikan perintah database (seperti insert dataset, select data mentah).
- **View:** Bagian antar muka pengguna (_User Interface_) yang akan di-render ke web browser pengguna (contoh: Form Login, Dashboard laporan).
- **Controller:** Pengontrol arus logika bisnis utama, termasuk yang menangani kalkulasi **mesin KMeans (Looping iterasi jarak centroid)**.

---

## 4. Struktur Database (ERD)

Sistem memiliki skema basis data (_Entity Relationship Diagram_) sebagai relasi antar tabel dasar untuk kemudahan _coding_, dengan rincian berikut:

### 4.1. `tbl_login` (Tabel Akses Pengguna)

- `id_login` [INT(11), Primary Key, Auto Increment]
- `username` [VARCHAR(50)]
- `password` [VARCHAR(255)]
- `level` [ENUM('admin', 'pimpinan')]

### 4.2. `tbl_dataset` (Tabel Identitas Alternatif)

_Berhubung sistem kita dirancang **100% dinamis**, tabel ini HANYA menyimpan identitas subjek/alternatif saja agar bersifat umum dan reusable. Atribut rinci ditampung seluruhnya secara relasional ke `tbl_kriteria`._

- `id_dataset` [INT(11), Primary Key, Auto Increment]
- `nama_dataset` [VARCHAR(100)]

### 4.3. `tbl_kriteria` (Tabel Kriteria Dinamis)

_Tabel ini menyimpan daftar kriteria atribut agar sistem 100% dinamis. Anda bisa menambah kriteria (C7, C8, dst) melalui aplikasi tanpa menyentuh kode program MySQL._

- `id_kriteria` [INT(11), Primary Key, Auto Increment]
- `nama_kriteria` [VARCHAR(50)] _(Misal: "Harga Parfum", "Penjualan")_

### 4.4. `tbl_nilai_training` (Tabel Nilai Atribut Numerik)

_Menggantikan struktur kolom statis (`c1`, `c2`, dst). Data nilai dikaitkan secara vertikal/relasional (Entity-Attribute-Value)._

- `id_nilai` [INT(11), Primary Key, Auto Increment]
- `id_dataset` [INT(11), Foreign Key: *tbl_dataset*]
- `id_kriteria` [INT(11), Foreign Key: *tbl_kriteria*]
- `nilai_angka` [FLOAT] _(Angka hasil mapping/transformasi yang akan dihitung K-Means)_

### 4.5. `tbl_hasil_clustering` (Tabel Laporan Hasil / History)

- `id_hasil` [INT(11), Primary Key, Auto Increment]
- `id_dataset` [INT(11), Foreign Key: *tbl_dataset*]
- `iterasi_ke` [INT] _(Misal iterasi terkunci di iterasi-3)_
- `cluster_akhir` [VARCHAR(50)] _(Contoh value: "Cluster 1: Sangat Lari")_
- `tanggal_proses` [DATETIME] _(Untuk melihat laporan history)_

---

## 5. Keamanan dan Akses (Role Management)

Peran dan otoritas sistem didasarkan dari field `level` di `tbl_login`.

- **Admin (`tbl_login.level = 'admin'`):** Memiliki hak akses penuh.
  - Dapat mengakses Dashboard Utama.
  - _Create, Read, Update, Delete_ (CRUD) semua entitas dataset/CSV.
  - Berhak menjalankan Engine / Trigger proses kalkulasi _K-Means Iterations_.
  - Bebas memanipulasi _Centroid Awal_ dan jumlah Klaster (K).

- **Pimpinan (`tbl_login.level = 'pimpinan'`):**
  - Hanya dapat mengakses navigasi spesifik yaitu **Laporan Hasil Akhir Perhitungan KMeans**.
  - Pimpinan _TIDAK BERHAK_ mengatur dataset (insert/upload/delete) dan tidak dapat menjalankan tombol perhitungan ulang perulangan klastering dari awal untuk mencegah bias data.
  - Fokus eksklusif pada halaman _Read-Only_ Laporan beserta fitur _Print/Export_.
