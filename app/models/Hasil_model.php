<?php

class Hasil_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Menghapus data hasil perhitungan yang lama agar tidak menumpuk
    public function kosongkanDataHasil() {
        $this->db->query("TRUNCATE TABLE tbl_hasil");
        $this->db->execute();
    }

    // Menyimpan data hasil perhitungan yang baru
    public function simpanHasilKmeans($id_dataset, $id_cluster, $jarak_minimum) {
        $query = "INSERT INTO tbl_hasil (id_dataset, id_cluster, jarak_minimum) 
                  VALUES (:id_dataset, :id_cluster, :jarak_minimum)";
        
        $this->db->query($query);
        $this->db->bind('id_dataset', $id_dataset);
        $this->db->bind('id_cluster', $id_cluster);
        $this->db->bind('jarak_minimum', $jarak_minimum);
        $this->db->execute();
    }


    // Fungsi untuk mengambil semua data hasil perhitungan untuk halaman Laporan
    public function getAllHasilLaporan() {
        // Menggunakan teknik JOIN untuk menggabungkan tbl_hasil dengan tbl_dataset dan tbl_cluster
        $query = "SELECT tbl_hasil.*, tbl_dataset.nama_dataset, tbl_cluster.nama_cluster, tbl_cluster.kode_cluster 
                  FROM tbl_hasil 
                  JOIN tbl_dataset ON tbl_hasil.id_dataset = tbl_dataset.id_dataset 
                  JOIN tbl_cluster ON tbl_hasil.id_cluster = tbl_cluster.id_cluster
                  ORDER BY tbl_cluster.kode_cluster ASC"; // <-- TAMBAHKAN BARIS INI
        
        $this->db->query($query);

        
        // Kembalikan hasilnya dalam bentuk array
        // (Pastikan fungsi pengambil banyak data di database wrapper kamu namanya resultSet() atau rubah sesuai punyamu)
        return $this->db->resultSet(); 
    }
}