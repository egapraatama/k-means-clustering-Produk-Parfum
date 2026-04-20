<?php   

class Home extends Controller {
    
    public function __construct() {
        // Middleware Auth: Wajib Login
        $this->auth();
        
    }

    public function index()
     {

        $data['judul'] = 'Home';    
        $data['active'] = 'home';
        // Ambil nama dari session bukan dari getUser()
        $data['nama'] = $_SESSION['username'];
        $this->view('templates/header', $data);
        $this->view('home/index', $data);         
        $this->view('templates/footer');

    }   
}   