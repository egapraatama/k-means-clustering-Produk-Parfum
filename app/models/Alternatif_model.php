<?php 

class Alternatif_model {
    private $table = 'tbl_alternatif';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAlternatif()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getAlternatifById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_alternatif=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataAlternatif($data)
    {
        $query = "INSERT INTO " . $this->table . " (kode_alternatif, nama_alternatif)
                  VALUES (:kode_alternatif, :nama_alternatif)";
        
        $this->db->query($query);
        $this->db->bind('kode_alternatif', $data['kode_alternatif']);
        $this->db->bind('nama_alternatif', $data['nama_alternatif']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataAlternatif($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_alternatif = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataAlternatif($data)
    {
        $query = "UPDATE " . $this->table . " SET 
                    kode_alternatif = :kode_alternatif,
                    nama_alternatif = :nama_alternatif
                  WHERE id_alternatif = :id_alternatif";
        
        $this->db->query($query);
        
        $this->db->bind('kode_alternatif', $data['kode_alternatif']);
        $this->db->bind('nama_alternatif', $data['nama_alternatif']);
        // Pastikan POST mengirimkan 'id_alternatif'
        $this->db->bind('id_alternatif', $data['id_alternatif']); 

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataAlternatif()
    {
        // Pastikan input text dari form pencarian di View memiliki name="keyword"
        $keyword = $_POST['keyword'];
        
        $query = "SELECT * FROM " . $this->table . " WHERE nama_alternatif LIKE :keyword OR kode_alternatif LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        
        return $this->db->resultSet();
    }
}
