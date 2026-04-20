<?php 

class Cluster_model {
    private $table = 'tbl_cluster';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCluster()
    {
        // JOIN Dinamis: Mengambil nama cluster dan semua nilai kriteria dari dataset
        $query = "SELECT tbl_cluster.*, tbl_dataset.* FROM tbl_cluster 
                  JOIN tbl_dataset ON tbl_cluster.id_dataset = tbl_dataset.id_dataset";
        
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambahDataCluster($data)
    {
        // Kita hanya perlu simpan 3 hal: Kode, Nama Cluster, dan ID Dataset mana yang jadi acuan
        $query = "INSERT INTO " . $this->table . " (kode_cluster, nama_cluster, id_dataset) 
                  VALUES (:kode_cluster, :nama_cluster, :id_dataset)";
        
        $this->db->query($query);
        $this->db->bind('kode_cluster', $data['kode_cluster']);
        $this->db->bind('nama_cluster', $data['nama_cluster']);
        $this->db->bind('id_dataset', $data['id_dataset']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataCluster($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_cluster = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}