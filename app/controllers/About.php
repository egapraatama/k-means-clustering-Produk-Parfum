<?php

class About extends Controller {
    
    // Satpam: Blokir akses bagi pengunjung yang belum Login!
    public function __construct() {
        $this->auth();
    }

    public function index($name= 'Ega', $pekerjaan= 'Programmer', $umur= '22') 
     {

        $data['nama'] = $name;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['judul'] = 'About Me';
        $data['active'] = 'about';
        $this->view('templates/header', $data);
        $this ->view('about/index', $data);
        $this->view('templates/footer');


        // echo "Halo nama saya $name, Saya adalah seorang $pekerjaan dan saya $umur tahun";
    }   

    public function page()
     {
        // echo "About/page.";

        $data['judul'] = 'My Page';
        $data['active'] = 'about';
        $this ->view('templates/header', $data);
        $this -> view('about/page', $data);
        $this -> view('templates/footer');
    }   
}   