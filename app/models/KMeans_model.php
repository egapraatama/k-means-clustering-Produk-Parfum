<?php

class KMeans_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // public function buatTransformasi($data) {
    //     $hasil = [];
    //     foreach ($data as $row) {
    //         $item = [
    //             'id_dataset'   => $row['id_dataset'],
    //             'nama_dataset' => $row['nama_dataset'],
    //             'harga'     => $this->mapHarga($row['harga_parfum'] ?? 0),
    //             'volume'    => $this->mapVolume($row['volume_penjualan'] ?? 0),
    //             'frekuensi' => $this->mapFrekuensi($row['frekuensi_pembelian'] ?? 0),
    //             'aroma'     => $this->mapAroma($row['jenis_aroma'] ?? ''),
    //             'rating'    => $this->mapRating($row['rating_pelanggan'] ?? '')
    //         ];
    //         $hasil[] = $item;
    //     }
    //     return $hasil;
    // }


    public function buatTransformasi($data) {
        $hasil = [];
        foreach ($data as $row) {
            $item = [
                // Cek apakah ada kode_cluster (karena dari tbl_cluster). Kalau ada, simpan.
                'kode_cluster' => isset($row['kode_cluster']) ? $row['kode_cluster'] : null, 
                
                'id_dataset'   => $row['id_dataset'],
                'nama_dataset' => $row['nama_dataset'],
                'harga'     => $this->mapHarga($row['harga_parfum'] ?? 0),
                'volume'    => $this->mapVolume($row['volume_penjualan'] ?? 0),
                'frekuensi' => $this->mapFrekuensi($row['frekuensi_pembelian'] ?? 0),
                'aroma'     => $this->mapAroma($row['jenis_aroma'] ?? ''),
                'rating'    => $this->mapRating($row['rating_pelanggan'] ?? '')
            ];
            $hasil[] = $item;
        }
        return $hasil;
    }

    // --- LOGIKA MAPPING ---

    private function mapHarga($nilai) {
        $harga = (int) preg_replace('/[^0-9]/', '', $nilai);
        if ($harga >= 320000) return 1;
        if ($harga >= 270000) return 2;
        if ($harga >= 220000) return 3;
        if ($harga >= 190000) return 4;
        return 5; 
    }

    private function mapVolume($nilai) {
        $vol = (int) preg_replace('/[^0-9]/', '', $nilai);
        // Sesuai Aturan: 9-10 (5), 7-8 (4), 5-6 (3), 3-4 (2), 1-2 (1)
        if ($vol >= 9) return 5;
        if ($vol >= 7) return 4;
        if ($vol >= 5) return 3;
        if ($vol >= 3) return 2;
        return 1; 
    }

    private function mapFrekuensi($nilai) {
        $frek = (int) preg_replace('/[^0-9]/', '', $nilai);
        // Sesuai Aturan: 11> (2), 5-10 (1), 0-4 (0)
        if ($frek > 10) return 2;
        if ($frek >= 5) return 1;
        return 0; 
    }

    private function mapAroma($nama) {
        // Hapus spasi kiri-kanan dan jadikan huruf kecil semua
        $nama = strtolower(trim($nama));
        
        // Cek kecocokan kata secara spesifik
        if (strpos($nama, 'oriental') !== false) return 2;
        if (strpos($nama, 'wood') !== false) return 1; // Menangkap 'woody' atau 'wood'
        
        return 0; // Default untuk 'fresh' atau lainnya
    }

    private function mapRating($status) {
        // Hapus spasi kiri-kanan dan jadikan huruf kecil semua
        $status = strtolower(trim($status));
        
        // Sesuai Aturan: Ya/Bagus (1), Tidak/Tidak Dinilai (2)
        if (strpos($status, 'ya') !== false || strpos($status, 'bagus') !== false) {
            return 1;
        }
        return 2; 
    }

// Fungsi untuk menghitung jarak Euclidean dan menentukan Cluster
    public function hitungEuclidean($datasetTransformasi, $centroidTransformasi) {
        $hasilIterasi = [];

        foreach ($datasetTransformasi as $data) {
            
            // BEST PRACTICE: Gunakan konstanta nilai float maksimal bawaan PHP
            // Daripada hardcode magic number 999999
            $jarakTerdekat = PHP_FLOAT_MAX; 
            
            $clusterTerpilih = '';
            $detailJarak = []; 

            foreach ($centroidTransformasi as $c) {
                // Rumus Euclidean Distance
                $jarak = sqrt(
                    pow(($data['harga'] - $c['harga']), 2) +
                    pow(($data['volume'] - $c['volume']), 2) +
                    pow(($data['frekuensi'] - $c['frekuensi']), 2) +
                    pow(($data['aroma'] - $c['aroma']), 2) +
                    pow(($data['rating'] - $c['rating']), 2)
                );
            // Kita ambil langsung kode_cluster (C1, C2) dari database
              $kodeCentroid = $c['kode_cluster'];
                $detailJarak[$kodeCentroid] = round($jarak, 4);

                if ($jarak < $jarakTerdekat) {
                    $jarakTerdekat = $jarak; 
                    $clusterTerpilih = $kodeCentroid; 
                }
            }

            $hasilIterasi[] = [
                'id_dataset'   => $data['id_dataset'],
                'kode_cluster' => $clusterTerpilih, // Gunakan cluster pemenang, bukan variabel sisa loop
                'nama_dataset' => $data['nama_dataset'],
                'jarak'        => $detailJarak, 
                'min_jarak'    => round($jarakTerdekat, 4),
                'cluster'      => $clusterTerpilih 
            ];
        }

        return $hasilIterasi; 
    }

// Fungsi untuk mencari rata-rata (mean) dan membentuk Centroid Baru
    public function hitungCentroidBaru($dataTransformasi, $hasilEuclidean, $centroidLama) {
        $centroidBaru = [];

        // BEST PRACTICE: Buat peta lookup berdasarkan id_dataset agar tidak bergantung pada urutan index array
        $dataMap = [];
        foreach ($dataTransformasi as $d) {
            $dataMap[$d['id_dataset']] = $d;
        }
        
        // Evaluasi setiap cluster yang ada (Misal: C1, C2)
        foreach ($centroidLama as $lama) {
            $kodeCluster = $lama['kode_cluster'];
            
            $sumHarga = 0; $sumVolume = 0; $sumFrekuensi = 0; $sumAroma = 0; $sumRating = 0;
            $jumlahAnggota = 0;

            // Cari produk mana saja yang tergabung ke dalam cluster ini pada putaran ini
            foreach ($hasilEuclidean as $hasil) {
                if ($hasil['cluster'] == $kodeCluster) {
                    $jumlahAnggota++;
                    
                    // Tarik nilai bobot dari data transformasi menggunakan id_dataset (bukan index posisi)
                    $dt = $dataMap[$hasil['id_dataset']];
                    $sumHarga += $dt['harga'];
                    $sumVolume += $dt['volume'];
                    $sumFrekuensi += $dt['frekuensi'];
                    $sumAroma += $dt['aroma'];
                    $sumRating += $dt['rating'];
                }
            }

            // Jika cluster ini punya anggota, hitung rata-ratanya.
            if ($jumlahAnggota > 0) {
                $centroidBaru[] = [
                    'kode_cluster' => $kodeCluster,
                    'id_dataset'   => $lama['id_dataset'], 
                    'nama_dataset' => 'Rata-rata ' . $kodeCluster, // Label penanda
                    
                    // Kita gunakan round() agar presisi desimalnya seragam saat membandingkan konvergensi
                    'harga'        => round($sumHarga / $jumlahAnggota, 4),
                    'volume'       => round($sumVolume / $jumlahAnggota, 4),
                    'frekuensi'    => round($sumFrekuensi / $jumlahAnggota, 4),
                    'aroma'        => round($sumAroma / $jumlahAnggota, 4),
                    'rating'       => round($sumRating / $jumlahAnggota, 4)
                ];
            } else {
                // Mencegah error pembagian dengan nol jika cluster tidak mendapat anggota
                $centroidBaru[] = $lama;
            }
        }

        return $centroidBaru;
    }




}