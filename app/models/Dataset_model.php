<?php

class Dataset_model {
    private $table = 'tbl_dataset';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDataset()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY nama_dataset ASC');
        return $this->db->resultSet();
    }

    public function getAllKriteria()
    {
        $this->db->query('SELECT * FROM tbl_kriteria ORDER BY id_kriteria ASC');
        return $this->db->resultSet();
    }

    // Fungsi Tukang Bangunan: Mengecek dan membuat kolom otomatis
    public function sinkronisasiKolomDataset() 
    {
        // 1. Ambil kriteria master dari database
        $this->db->query('SELECT * FROM tbl_kriteria');
        $daftarKriteria = $this->db->resultSet();

        // 2. Ambil struktur kolom di tabel dataset saat ini
        $this->db->query('SHOW COLUMNS FROM ' . $this->table);
        $kolomTabelDataset = $this->db->resultSet();

        $daftarKolomEksisting = [];
        foreach($kolomTabelDataset as $kolom) {
            $daftarKolomEksisting[] = $kolom['Field'];
        }

        // 3. Cocokkan dan buat kolom jika belum ada
        foreach($daftarKriteria as $kriteria) {
            $formatNamaKolom = strtolower(str_replace(' ', '_', $kriteria['nama_kriteria']));

            if(!in_array($formatNamaKolom, $daftarKolomEksisting)) {
                // PENTING: Menggunakan VARCHAR(100) agar kebal terhadap inputan Teks maupun Angka dari CSV
                $queryTambahKolom = "ALTER TABLE " . $this->table . " ADD `$formatNamaKolom` VARCHAR(100) NULL DEFAULT '-'";
                $this->db->query($queryTambahKolom);
                $this->db->execute();
            }
        }
    }

    // Fungsi untuk me-reset tabel sebelum import baru
    public function kosongkanDataDataset() 
    {
        // Gunakan DELETE FROM alih-alih TRUNCATE untuk menghindari bentrok / error 
        // dengan Foreign Key dari tabel tbl_hasil_clustering
        $this->db->query('DELETE FROM ' . $this->table);
        $this->db->execute();
        
        // Reset id agar kembali mulai dari 1
        $this->db->query('ALTER TABLE ' . $this->table . ' AUTO_INCREMENT = 1');
        $this->db->execute();
    }

    // Fungsi dinamis untuk menyimpan array CSV ke Database
    public function tambahDataDataset($data) 
    {
        // Ekstrak kunci array menjadi daftar kolom dan parameter PDO
        $daftarNamaKolom = implode(", ", array_keys($data));
        $daftarParameterPDO = ":" . implode(", :", array_keys($data));

        // Rakit Query SQL
        $queryInsertSQL = "INSERT INTO " . $this->table . " ($daftarNamaKolom) VALUES ($daftarParameterPDO)";
        $this->db->query($queryInsertSQL);
        
        // Looping untuk mengikat (bind) data ke parameter PDO
        foreach ($data as $namaKolom => $nilaiData) {
            $this->db->bind($namaKolom, $nilaiData);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }
}