<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['judul']) ? $data['judul'] : 'Landing Page'; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASEURL; ?>/img/favicon.png">
    <!-- File CSS Bootstrap 5 (Lokal) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
    <!-- Font Poppins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>
<body class="bg-light">

<!-- 1. NAVBAR (Transparan di atas Background) -->
<nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100 top-0 shadow-none bg-transparent" style="z-index: 10;">
    <div class="container mt-3">
        <a class="navbar-brand fw-bold fs-4 text-uppercase border-bottom border-primary border-3" href="#">R2DH Parfum</a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <!-- <li class="nav-item">
                    <a class="nav-link text-white fw-semibold active" href="#">Beranda</a>
                </li> -->
                <li class="nav-item ms-lg-2">
                    <a class="nav-link text-white fw-semibold" href="#metode">Metode K-Means</a>
                </li>
                <li class="nav-item ms-lg-4 mt-3 mt-lg-0">
                    <!-- Tombol Login Aplikasi -->
                    <a class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" href="<?= BASEURL; ?>/login" target="_blank">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO SECTION (Gabung menyatu dengan Navbar) -->
<header class="position-relative d-flex align-items-center" style="min-height: 100vh; overflow: hidden; background-color: #f8f9fa;">
    
    <!-- Background Image Asli (tanpa scale/distorsi) -->
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('<?= BASEURL; ?>/img/bg-parfum1.jpg') center/cover no-repeat; z-index: 0;"></div>
    
    <!-- Overlay Modern: Gradient Dark & Warm (Luxury) dengan efek Glassmorphism bernuansa elegan untuk tema Parfum -->
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: linear-gradient(135deg, rgba(15, 15, 15, 0.85) 0%, rgba(45, 35, 25, 0.75) 100%); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); z-index: 0;"></div>
    
    <div class="container position-relative pt-5 mt-4" style="z-index: 1;">
        <div class="row align-items-center justify-content-between pt-5">
            <!-- Teks Hero Sebelah Kiri -->
            <div class="col-lg-6 text-white text-center text-lg-start mb-5 mb-lg-0">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fs-6 fw-semibold text-uppercase tracking-wider">
                    DATA MINING - Proses Clustering
                </span>
                <h1 class="display-4 fw-bold lh-sm mb-4">
                    ANALISIS CLUSTERING <span class="text-primary">PRODUK PARFUM</span>
                </h1>
                <p class="lead mb-4 fw-light text-light" style="opacity: 0.9;">
                    Menggunakan Metode K-Means Untuk Mendukung Keputusan Produk Parfum paling banyak diminati Pada Toko Parfum R2DH.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start mt-4">
                    <a href="#metode" class="btn btn-primary btn-lg rounded-pill px-5 shadow">Mulai Analisis K-Means </a>
                </div>
            </div>
            
            <!-- Gambar Sebelah Kanan (Parfum Hero) -->
            <div class="col-lg-5 text-center position-relative">
                <!-- Glowing effect decoration belakang gambar -->
                <div class="position-absolute bg-primary rounded-circle" style="width: 300px; height: 300px; top: 50%; left: 50%; transform: translate(-50%, -50%); filter: blur(90px); opacity: 0.4;"></div>
                
                <img src="<?= BASEURL; ?>/img/bg-rdh.jpeg" alt="Parfum R2DH" class="img-fluid rounded-4 shadow-lg position-relative" style="max-height: 520px; object-fit: cover; border: 3px solid rgba(255,255,255,0.15);">
            </div>
        </div>
    </div>
    
    <!-- Wave / Diagonal Shape Bottom -->
    <div class="position-absolute bottom-0 w-100" style="height: 70px; background: #f8f9fa; clip-path: polygon(0 40%, 100% 0, 100% 100%, 0 100%); z-index: 1;"></div>
</header>

<!-- 2. METODE K-MEANS -->
<!-- <section id="metode" class="py-5" style="background-color: #f8f9fa; padding-top: 100px !important; padding-bottom: 100px !important;">
    <div class="container"> -->
        <!-- Section Header -->
        <!-- <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <p class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 2px;">Algoritma & Pendekatan</p>
                <h2 class="fw-bold display-5 mb-3 text-dark">Apa itu Metode K-Means?</h2>
                <div class="bg-primary mx-auto rounded" style="width: 70px; height: 5px;"></div>
                <p class="text-secondary lead mt-4">
                    K-Means adalah salah satu metode data clustering non-hierarki yang mempartisi data ke dalam bentuk satu atau lebih cluster. Pada Toko R2DH, metode ini membantu mengelompokkan data penjualan parfum untuk menentukan produk terlaris secara akurat.
                </p>
            </div>
        </div> -->
        
        <!-- Proses Cards -->
        <!-- <div class="row g-4 justify-content-center mt-3">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
                    <div class="card-body">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <h2 class="m-0 fw-bold">1</h2>
                        </div>
                        <h4 class="fw-bold mb-3">Persiapan Data</h4>
                        <p class="text-secondary mb-0">Mengumpulkan riwayat data jumlah produk dan tingkat penjualan dari Toko Parfum R2DH sebagai dataset utama.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow rounded-4 p-4 text-center text-white" style="background-color: #0d6efd; transform: scale(1.03); z-index: 1;">
                    <div class="card-body">
                        <div class="bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow" style="width: 75px; height: 75px;">
                            <h2 class="m-0 fw-bold">2</h2>
                        </div>
                        <h4 class="fw-bold mb-3">Proses Clustering</h4>
                        <p class="text-white mb-0" style="opacity: 0.9;">Penentuan nilai titik pusat (centroid), perhitungan jarak iteratif, dan pengelompokan produk parfum secara sistematis.</p>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
                    <div class="card-body">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <h2 class="m-0 fw-bold">3</h2>
                        </div>
                        <h4 class="fw-bold mb-3">Hasil Keputusan</h4>
                        <p class="text-secondary mb-0">Memberikan output cluster parfum strategis untuk mendukung pemilik toko R2DH dalam pengambilan keputusan bisnis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- 3. FOOTER -->
<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row gy-4">
            <!-- Footer Info -->
            <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                <h4 class="fw-bold text-primary mb-3 text-uppercase">Toko Parfum R2DH</h4>
                <p class="text-light opacity-75 pe-lg-5 mb-0">
                    Aplikasi Analisis Clustering Menggunakan Metode K-Means untuk Mendukung Keputusan Produk Parfum pada Toko Parfum R2DH.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 text-center text-md-start">
                <h5 class="fw-bold text-white mb-3">Navigasi</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-light opacity-75">Beranda</a></li>
                    <li class="mb-2"><a href="#metode" class="text-decoration-none text-light opacity-75">Metode K-Means</a></li>
                    <li><a href="<?= BASEURL; ?>/login" class="text-decoration-none text-light opacity-75" target="_blank">Login Aplikasi</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div class="col-lg-3 col-md-6 text-center text-md-start">
                <h5 class="fw-bold text-white mb-3">Kontak</h5>
                <p class="text-light opacity-75 mb-1">Toko Parfum R2DH</p>
                <p class="text-light opacity-75 mb-0">Medan</p>
            </div>
        </div>
        
        <hr class="mt-4 mb-3 border-secondary" style="opacity: 0.3;">
        
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-12 text-center text-light opacity-50">
                <p class="mb-0 small">
                    &copy; <?= date('Y'); ?> Analisis Clustering K-Means. Toko Parfum R2DH. 
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- File JS Bootstrap 5 (Lokal) -->
<script src="<?= BASEURL; ?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>
