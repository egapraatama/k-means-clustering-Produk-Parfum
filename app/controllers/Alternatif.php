<?php   

class Alternatif extends Controller {
    
    public function __construct() {
        // Middleware Auth: Wajib Login
        $this->auth();
    }

    public function index() 
    {
        $data['judul'] = 'Data Master Alternatif';
        $data['active'] = 'alternatif';
        $data['alternatif'] = $this->model('Alternatif_model')->getAllAlternatif();
        
        $this->view('templates/header', $data);
        $this->view('alternatif/index', $data);
        $this->view('templates/footer');
    }

   

    public function tambah() 
    {
        if($this->model('Alternatif_model')->tambahDataAlternatif($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/alternatif');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/alternatif');
            exit;
        }
    }

    public function hapus($id) 
    {
        if($this->model('Alternatif_model')->hapusDataAlternatif($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/alternatif');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/alternatif');
            exit;
        }
    }

    public function edit($id) 
    {
        $data['judul'] = 'Ubah Data Parfum';
        $data['active'] = 'alternatif';
        $data['alternatif'] = $this->model('Alternatif_model')->getAlternatifById($id);
        
        $this->view('templates/header', $data);
        $this->view('alternatif/edit', $data);
        $this->view('templates/footer');
    }

    public function ubah()
    {
        if($this->model('Alternatif_model')->ubahDataAlternatif($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/alternatif');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/alternatif');
            exit;
        }
    }

    public function cari() 
    {
        $data['judul'] = 'Daftar Alternatif';
        $data['active'] = 'alternatif';
        $data['alternatif'] = $this->model('Alternatif_model')->cariDataAlternatif();
        
        $this->view('templates/header', $data);
        $this->view('alternatif/index', $data);
        $this->view('templates/footer');    
    }

}