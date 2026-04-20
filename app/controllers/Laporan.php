<?php

class Laporan extends Controller {

    public function index()
    {
        $data['judul'] = 'Laporan Hasil Pengelompokan';
        $data['active'] = 'laporan'; // Untuk menandai menu sidebar yang sedang aktif

        // 1. Mengambil semua data hasil perhitungan beserta nama parfum dan cluster
        $data['laporan'] = $this->model('Hasil_model')->getAllHasilLaporan();

        // 2. Menghitung total masing-masing cluster untuk ditampilkan di kotak atas (Card)
        $total_low_demand = 0;
        $total_best_seller = 0;

        foreach ($data['laporan'] as $row) {
            // Asumsi: 'C1' adalah Low Demand, 'C2' adalah Best Seller. 
            // Silakan sesuaikan dengan isi kolom 'kode_cluster' di database kamu jika berbeda.
            if ($row['kode_cluster'] == 'C1') {
                $total_low_demand++;
            } elseif ($row['kode_cluster'] == 'C2') {
                $total_best_seller++;
            }
        }

        // Menyimpan hasil hitungan ke dalam array $data agar bisa dipanggil di View
        $data['total_low_demand'] = $total_low_demand;
        $data['total_best_seller'] = $total_best_seller;

        // 3. Memuat tampilan (View)
        $this->view('templates/header', $data);
        $this->view('laporan/index', $data);
        $this->view('templates/footer');
    }

    public function cetak()
    {
        $data['laporan'] = $this->model('Hasil_model')->getAllHasilLaporan();

        // Inisialisasi FPDF
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Judul Laporan
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'LAPORAN HASIL CLUSTERING K-MEANS', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'Toko Parfum R2DH', 0, 1, 'C');
        $pdf->Ln(10);

        // Header Tabel
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 7, 'No', 1, 0, 'C');
        $pdf->Cell(100, 7, 'Nama Produk', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Hasil Cluster', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Kode', 1, 1, 'C');

        // Isi Tabel
        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($data['laporan'] as $row) {
            $pdf->Cell(10, 7, $no++, 1, 0, 'C');
            $pdf->Cell(100, 7, $row['nama_dataset'], 1, 0, 'L');
            $pdf->Cell(40, 7, $row['nama_cluster'], 1, 0, 'C');
            $pdf->Cell(40, 7, $row['kode_cluster'], 1, 1, 'C');
        }

        // Tanda Tangan (Opsional)
        $pdf->Ln(15);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(130);
        $pdf->Cell(60, 7, 'Medan, ' . date('d F Y'), 0, 1, 'C');
        $pdf->Cell(130);
        $pdf->Cell(60, 7, 'Pimpinan Toko', 0, 1, 'C');
        $pdf->Ln(20);
        $pdf->Cell(130);
        $pdf->Cell(60, 7, '( ____________________ )', 0, 1, 'C');

        // Output PDF
        $pdf->Output('I', 'Laporan_Clustering_' . date('Y-m-d') . '.pdf');
    }

}