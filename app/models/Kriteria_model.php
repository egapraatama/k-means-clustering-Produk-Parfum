<?php 
class Kriteria_model {
    private $table = 'tbl_kriteria';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Mengambil semua data Kriteria (Dimensi Evaluasi K-Means)
    public function getAllKriteria()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    // Mencari Kriteria Tepat berdasarkan ID untuk keperluan Form Update
    public function getKriteriaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_kriteria=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Operasi Core: Tambah Parameter K-Means Baru (Misal: Rating)
    public function tambahDataKriteria($data)
    {
        $query = "INSERT INTO " . $this->table . " (nama_kriteria) VALUES (:nama_kriteria)";
        
        $this->db->query($query);
        $this->db->bind('nama_kriteria', $data['nama_kriteria']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Hati-hati menghapus kriteria, karena K-Means akan kehilangan 1 Dimensi hitungan
    public function hapusDataKriteria($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_kriteria = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Eksekusi Pembaruan Data Nama Kriteria Terbaru
    public function ubahDataKriteria($data)
    {
        $query = "UPDATE " . $this->table . " SET nama_kriteria = :nama_kriteria WHERE id_kriteria = :id_kriteria";
        
        $this->db->query($query);
        $this->db->bind('nama_kriteria', $data['nama_kriteria']);
        $this->db->bind('id_kriteria', $data['id_kriteria']); 
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Mencegah hardcode dengan memfasilitasi pencarian Search Box
    public function cariDataKriteria()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE nama_kriteria LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
