<?php   

class Cluster extends Controller {
    
    public function __construct() {
        // Middleware Auth: Wajib Login
        $this->auth();
        $this->adminOnly();
    }

    public function index() 
    {
        $data['judul'] = 'Manajemen Cluster (Centroid Awal)';
        $data['active'] = 'cluster';
        
        // Ambil data cluster (yang sudah di-join di model)
        $data['cluster'] = $this->model('Cluster_model')->getAllCluster();
        
        // Ambil data kriteria untuk header tabel
        $data['kriteria'] = $this->model('Dataset_model')->getAllKriteria();
        
        // Ambil semua dataset untuk pilihan di Modal Tambah
        $data['dataset'] = $this->model('Dataset_model')->getAllDataset();
        
        $this->view('templates/header', $data);
        $this->view('cluster/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() 
    {
        if($this->model('Cluster_model')->tambahDataCluster($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/cluster');
        exit;
    }

    public function hapus($id) 
    {
        if($this->model('Cluster_model')->hapusDataCluster($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/cluster');
        exit;
    }
}