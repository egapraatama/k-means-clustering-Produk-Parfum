<?php

class User_model {
    private $table = 'tbl_login';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // ambil user berdasarkan username (UNTUK LOGIN)
    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    // // (OPTIONAL) ambil semua user
    // public function getAllUser() {
    //     $this->db->query("SELECT * FROM " . $this->table);
    //     return $this->db->resultSet();
    // }

    // // (OPTIONAL) ambil user berdasarkan id
    // public function getUserById($id) {
    //     $this->db->query("SELECT * FROM " . $this->table . " WHERE id_login = :id");
    //     $this->db->bind('id', $id);
    //     return $this->db->single();
    // }
}