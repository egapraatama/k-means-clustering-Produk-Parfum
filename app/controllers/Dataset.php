<?php

class Dataset extends Controller {
    
    public function __construct() 
    {
        // Middleware Auth: Wajib Login
        $this->auth();
        $this->adminOnly();
        
        // Proteksi Pimpinan
        if(isset($_SESSION['level']) && $_SESSION['level'] == 'pimpinan') {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    public function index() 
    {
        $data['judul'] = 'Dataset Parfum & Import CSV';
        $data['active'] = 'dataset';
        
        $data['dataset'] = $this->model('Dataset_model')->getAllDataset();
        $data['kriteria'] = $this->model('Dataset_model')->getAllKriteria();
        
        $this->view('templates/header', $data);
        $this->view('dataset/index', $data);
        $this->view('templates/footer');
    }

    public function upload() 
    {
        if(isset($_FILES['file_csv'])) {
            $fileCSV = $_FILES['file_csv']['tmp_name'];
            
            if($_FILES['file_csv']['size'] > 0) {
                $bukaFile = fopen($fileCSV, "r");
                $modelDataset = $this->model('Dataset_model');
                
                // 1. Sinkronisasi Kolom Otomatis
                $modelDataset->sinkronisasiKolomDataset(); 

                // 2. Bersihkan Data Lama
                $modelDataset->kosongkanDataDataset(); 

                // 3. Persiapan Data
                $daftarKriteria = $modelDataset->getAllKriteria();
                $barisPertamaAdalahHeader = true;

                while (($barisDataCSV = fgetcsv($bukaFile, 10000, ",")) !== FALSE) {
                    
                    if(count($barisDataCSV) == 1) {
                        $barisDataCSV = explode(";", $barisDataCSV[0]);
                    }

                    if($barisPertamaAdalahHeader) {
                        $barisPertamaAdalahHeader = false;
                        continue;
                    }
                    
                    // Validasi kekosongan nama
                    if(empty(trim($barisDataCSV[1]))) continue;

                    // Merakit Array
                    $dataDatasetBaru = [
                        'nama_dataset' => trim($barisDataCSV[1])
                    ];

                    foreach ($daftarKriteria as $index => $kriteria) {
                        $formatNamaKolom = strtolower(str_replace(' ', '_', $kriteria['nama_kriteria']));
                        $nilaiKriteria = isset($barisDataCSV[$index + 2]) ? trim($barisDataCSV[$index + 2]) : 0;
                        
                        $dataDatasetBaru[$formatNamaKolom] = $nilaiKriteria;
                    }

                    // 4. Eksekusi Tambah Data
                    $modelDataset->tambahDataDataset($dataDatasetBaru);
                }
                
                fclose($bukaFile);
                Flasher::setFlash('berhasil', 'di-import dan disinkronisasi', 'success');
            } else {
                Flasher::setFlash('gagal', 'di-import, file terdeteksi kosong', 'danger');
            }
            
            header('Location: ' . BASEURL . '/dataset');
            exit;
        }
    }

    // Fitur Reset Data Manual
    public function reset() 
    {
        $this->model('Dataset_model')->kosongkanDataDataset();
        Flasher::setFlash('berhasil', 'menghapus seluruh data dataset', 'warning');
        header('Location: ' . BASEURL . '/dataset');
        exit;
    }
}