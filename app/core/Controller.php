<?php   

class Controller {
    
    public function view ($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';  
        
    }   

    public function model ($model ){
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    // Middleware: Auth (Hanya yang sudah Authenticated / Login)
    public function auth() {
        if(!isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    // Middleware: Guest (Hanya Tamu yang belum login)
    public function guest() {
        if(isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }
    // Middleware: Admin Only (Hanya Admin yang boleh lewat)
    public function adminOnly() {
        if($_SESSION['level'] !== 'admin') {
            Flasher::setFlash('Akses', 'Ditolak! (Hanya Admin)', 'danger');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

}
