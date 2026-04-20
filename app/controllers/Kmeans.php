<?php

class Kmeans extends Controller {

    public function __construct() {
        // Middleware Auth: Wajib Login
        $this->auth();
        $this->adminOnly();
    }

    /**
     * Bandingkan centroid dengan toleransi epsilon
     * agar tidak bergantung pada presisi floating-point PHP.
     */
    private function centroidSama($a, $b, $epsilon = 0.0001) {
        if (count($a) !== count($b)) return false;
        $keys = ['harga', 'volume', 'frekuensi', 'aroma', 'rating'];
        foreach ($a as $i => $ca) {
            foreach ($keys as $key) {
                if (abs($ca[$key] - $b[$i][$key]) > $epsilon) {
                    return false;
                }
            }
        }
        return true;
    }

    public function index()
    {
        $data['judul'] = ' Proses Analisa Metode K-Means';
        $data['active'] = 'kmeans';

        // 1. Ambil data asli dari database
        $dataMentah = $this->model('Dataset_model')->getAllDataset();
        $centroidAwal = $this->model('Cluster_model')->getAllCluster();

        // Cek Keamanan: Jika data kosong, jangan diproses dulu
        if (empty($dataMentah) || empty($centroidAwal)) {
            Flasher::setFlash('gagal', 'Dataset atau Cluster Centroid masih kosong!', 'danger');
            header('Location: ' . BASEURL . '/dataset');
            exit;
        }

        // 2. TAHAP TRANSFORMASI (Mapping Data Mentah ke Angka Bobot)
        // Memanggil KMeans_model untuk mengubah data mentah menjadi nilai bobot
        $data['dataset_transformasi'] = $this->model('KMeans_model')->buatTransformasi($dataMentah);
        $data['centroid_transformasi'] = $this->model('KMeans_model')->buatTransformasi($centroidAwal);
        
        // Ambil kriteria untuk header tabel di View agar dinamis
        $data['kriteria'] = $this->model('Dataset_model')->getAllKriteria();

        // 3. Kirim ke View
        $this->view('templates/header', $data);
        $this->view('kmeans/index', $data); // Pastikan folder view-nya juga bernama kmeans
        $this->view('templates/footer');
    }

    // / 2. Fungsi untuk halaman hasil perhitungan (Tombol "Mulai Hitung")
    // / 2. Fungsi untuk halaman hasil perhitungan K-Means (Looping sampai Konvergen)
    public function hitung()
    {
        $data['judul'] = 'Hasil Perhitungan K-Means (Iterasi Lengkap)';
        $data['active'] = 'kmeans';

        // 1. Ambil & Transformasi Data Awal
        $dataMentah = $this->model('Dataset_model')->getAllDataset();
        $centroidAwal = $this->model('Cluster_model')->getAllCluster();

        $dataTransformasi = $this->model('KMeans_model')->buatTransformasi($dataMentah);
        
        // Kita jadikan centroid awal sebagai 'centroidSekarang' untuk iterasi pertama
        $centroidSekarang = $this->model('KMeans_model')->buatTransformasi($centroidAwal);

        // --- MULAI LOGIKA ITERASI & KONVERGENSI ---
        
        $maxIterasi = 15; // Batasan aman (Fail-safe) agar memori server tidak hang
        $iterasi = 0;
        $konvergen = false;
        
        $semuaHasilIterasi = []; // Array untuk menyimpan riwayat Iterasi 1, Iterasi 2, dst.

        while (!$konvergen && $iterasi < $maxIterasi) {
            $iterasi++;
            
            // a. Hitung Jarak Euclidean dengan centroid saat ini
            $hasilEuclidean = $this->model('KMeans_model')->hitungEuclidean($dataTransformasi, $centroidSekarang);
            
            // b. Simpan riwayat iterasi ini (Centroid yang dipakai & Hasil jaraknya)
            $semuaHasilIterasi[$iterasi] = [
                'centroid' => $centroidSekarang,
                'hasil'    => $hasilEuclidean
            ];

            // c. Hitung Posisi Centroid Baru (Nilai Rata-rata dari cluster yang terbentuk)
            $centroidBaru = $this->model('KMeans_model')->hitungCentroidBaru($dataTransformasi, $hasilEuclidean, $centroidSekarang);

            // d. Cek Konvergensi: Bandingkan centroid lama dan baru dengan toleransi epsilon
            if ($this->centroidSama($centroidSekarang, $centroidBaru)) {
                // Jika posisi cukup dekat (stabil), hentikan perulangan
                $konvergen = true; 
            } else {
                // Jika belum sama, update nilai centroid sekarang untuk putaran berikutnya
                $centroidSekarang = $centroidBaru;
            }
        }

        // --- SELESAI LOGIKA ITERASI ---

            //Proses Simpan Database
        $hasilFinal = end($semuaHasilIterasi);
        $this->model('Hasil_model')->kosongkanDataHasil();

        // 1. Ambil data asli Cluster (untuk mengubah 'C1'/'C2' menjadi angka id_cluster)
        $semuaCluster = $this->model('Cluster_model')->getAllCluster();
        $mapCluster = [];
        foreach($semuaCluster as $c) {
            $mapCluster[$c['kode_cluster']] = $c['id_cluster'];
        }

        // 2. Looping untuk menyimpan setiap baris data
        foreach ($hasilFinal['hasil'] as $row) {
            
            // Cek key array sesuai dengan yang ada di KMeans_model.php kamu
            if(isset($row['id_dataset']) && isset($row['cluster'])) {
                
                $id_dataset = $row['id_dataset'];
                $jarak_min  = $row['min_jarak']; // Sesuai nama key di model
                $kode_cl    = $row['cluster'];   // Isinya 'C1' atau 'C2'
                
                // Ubah 'C1' menjadi angka ID (misal: 1) untuk masuk ke database
                $id_cluster_db = $mapCluster[$kode_cl]; 

                // Simpan!
                $this->model('Hasil_model')->simpanHasilKmeans($id_dataset, $id_cluster_db, $jarak_min);
            }
        }
        // =========================================================================

        // 4. Bawa seluruh riwayat perjalanan algoritma ke View
        $data['riwayat_iterasi'] = $semuaHasilIterasi;
        $data['total_iterasi'] = $iterasi;
        $data['status_konvergen'] = $konvergen;

        // Kirim label cluster dari database agar view tidak hardcode C1/C2
        $data['cluster_labels'] = $mapCluster; // ['C1' => id_cluster, 'C2' => id_cluster, ...]
        $data['cluster_names'] = [];
        foreach ($semuaCluster as $c) {
            $data['cluster_names'][$c['kode_cluster']] = $c['nama_cluster'];
        }

        $this->view('templates/header', $data);
        $this->view('kmeans/hasil', $data); 
        $this->view('templates/footer');
    }

        

}