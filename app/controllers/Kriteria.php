<?php   

class Kriteria extends Controller {
    
    public function __construct() {
        $this->auth();
        $this->adminOnly();
    }

    // Front-Desk 1: Menampilkan list kriteria
    public function index() 
    {
        $data['judul'] = 'Manajemen Kriteria Clustering';
        $data['active'] = 'kriteria';
        $data['kriteria'] = $this->model('Kriteria_model')->getAllKriteria();
        
        $this->view('templates/header', $data);
        $this->view('kriteria/index', $data);
        $this->view('templates/footer');
    }

    // Gudang: Menangkap aksi simpan Kriteria baru
    public function tambah() 
    {
        if($this->model('Kriteria_model')->tambahDataKriteria($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/kriteria');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/kriteria');
            exit;
        }
    }

    // Front-desk 2: Membuka Halaman Edit (Murni UI)
    public function edit($id) 
    {
        $data['judul'] = 'Ubah Definisi Kriteria';
        $data['active'] = 'kriteria';
        $data['kriteria'] = $this->model('Kriteria_model')->getKriteriaById($id);
        
        $this->view('templates/header', $data);
        $this->view('kriteria/edit', $data);
        $this->view('templates/footer');
    }

    // Gudang: Tempat pengiriman Data UPDATE
    public function ubah()
    {
        if($this->model('Kriteria_model')->ubahDataKriteria($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/kriteria');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/kriteria');
            exit;
        }
    }

    // Gudang: Menghapus data spesifik
    public function hapus($id) 
    {
        if($this->model('Kriteria_model')->hapusDataKriteria($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/kriteria');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/kriteria');
            exit;
        }
    }

    // Mengolah pencarian pada list utama
    public function cari() 
    {
        $data['judul'] = 'Pencarian Kriteria';
        $data['active'] = 'kriteria';
        $data['kriteria'] = $this->model('Kriteria_model')->cariDataKriteria();
        
        $this->view('templates/header', $data);
        $this->view('kriteria/index', $data);
        $this->view('templates/footer');    
    }
}
