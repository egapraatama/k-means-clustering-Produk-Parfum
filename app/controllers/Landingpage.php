<?php 

class Landingpage extends Controller {
    
    // Pasang Middleware Guest di sini agar user yang sudah sukses masuk ke sistem TIDAK BISA kembali menyentuh Landingpage
    public function __construct() {
        $this->guest();
    }

    public function index() {

        $data['judul'] = 'Landing Page | Toko Parfum R2DH';
        $this->view('landingpage/index', $data);
    }
}

?>