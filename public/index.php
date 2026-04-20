<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ... kode kamu selanjutnya (seperti require_once bootstrap.php, dll)
if(!session_id()) {
    session_start();
}

// Mencegah Browser menyimpan riwayat halaman di memori (Back/Forward Cache)
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

require_once '../app/init.php';

$app = new App();
