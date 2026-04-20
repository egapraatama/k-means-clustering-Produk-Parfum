<?php

class Login extends Controller {

    public function index() {
        // Middleware Guest: Wajib Tamu / Belum Login
        $this->guest();

        $data['judul'] = 'Login';
        $this->view('login/index', $data);
    }

    public function proses() {
        // Middleware Guest: Wajib Tamu / Belum Login
        $this->guest();

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Panggil model untuk mencari user berdasarkan username
        $user = $this->model('User_model')->getUserByUsername($username);

        // Verifikasi Login (Versi Simple if-else)
        if ($user && $password === $user['password']) {
            // Jika BERHASIL
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];
            $_SESSION['id_login'] = $user['id_login'];

            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            // Jika GAGAL
            Flasher::setFlash('Username / Password', 'salah!', 'danger');
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function logout() {
        // Hapus semua session
        session_unset();
        session_destroy();

        header('Location: ' . BASEURL . '/login');
        exit;
    }
}
