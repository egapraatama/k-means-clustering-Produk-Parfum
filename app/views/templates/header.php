<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>K-Means Clustering Parfum | <?= $data['judul']; ?></title>

    <!-- Font Awesome (Local & Offline) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/vendor/fontawesome-free/css/all.min.css">
    
    <!-- Bootstrap 5 (Local & Offline) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
    
    <!-- Custom CSS SB Admin 2 Vibe (Local) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">

    <!-- DataTables CSS (Local) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/vendor/datatables/dataTables.bootstrap5.min.css">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center text-white" href="<?= BASEURL; ?>/home">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="sidebar-brand-text mx-3 mt-1">R2DH <sup>Parfum</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'home') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/home">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if($_SESSION['level'] == 'admin'): ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading px-3 text-white-50 small mb-1 fw-bold text-uppercase">
                Data Master 
            </div>

            <!-- Nav Item - Kriteria -->
            <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'kriteria') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/kriteria">
                    <i class="fas fa-fw fa-sliders-h"></i>
                    <span>Kriteria</span>
                </a>
            </li>

            <!-- Nav Item - Dataset -->
            <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'dataset') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/dataset">
                    <i class="fas fa-fw fa-file-csv"></i>
                    <span>Dataset Parfum</span>
                </a>
            </li>

            <!-- Nav Item - Cluster -->
            <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'cluster') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/cluster">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Cluster</span>
                </a>
            </li>
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading px-3 text-white-50 small mb-1 fw-bold text-uppercase">
                Proses Analisis
            </div>
            <?php if($_SESSION['level'] == 'admin'): ?>
            <!-- Nav Item - Algoritma K-Means -->
            <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'kmeans') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/kmeans">
                    <i class="fas fa-fw fa-brain"></i>
                    <span>Analisa Metode K-Means</span>
                </a>
            </li>
            <?php endif; ?>


            <!-- Nav Item Level Pimpinan- Hasil Laporan -->
            <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'laporan') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/laporan">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Hasil Pengelompokan</span>
                </a>
            </li>
            

            <!-- Nav Item - About -->
            <!-- <li class="nav-item <?= (isset($data['active']) && $data['active'] === 'about') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="<?= BASEURL; ?>/about">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>About</span>
                </a>
            </li> -->
            <?php if($_SESSION['level'] == 'admin'): ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading px-3 text-white-50 small mb-1 fw-bold text-uppercase">
                Menu Cabang
            </div> -->

            <!-- Nav Item - Pages Collapse Menu (Dummy) -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed text-white d-flex justify-content-between align-items-center" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <div>
                        <i class="fas fa-fw fa-cog"></i>
                        <span class="ms-1">Komponen</span>
                    </div>
                    <i class="fas fa-angle-down" style="font-size: 0.8rem;"></i>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded mx-3 mb-2 shadow-sm">
                        <h6 class="collapse-header px-3 text-uppercase text-muted font-weight-bold text-xs mb-1">Custom Komponen:</h6>
                        <a class="collapse-item d-block px-3 py-1 text-decoration-none text-gray-800" href="#">Buttons / Tombol</a>
                        <a class="collapse-item d-block px-3 py-1 text-decoration-none text-gray-800" href="#">Cards / Kartu</a>
                    </div>
                </div>
            </li> -->
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Desktop) -->
            <div class="text-center d-none d-md-flex justify-content-center">
                <button class="btn btn-primary rounded-circle border-0 d-flex justify-content-center align-items-center" id="sidebarToggle" style="width: 2.5rem; height: 2.5rem; background-color: rgba(255,255,255,0.2);">
                    <i class="fas fa-angle-left text-white"></i>
                </button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column w-100 min-vh-100">

            <!-- Main Content -->
            <div id="content" class="flex-grow-1">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-bottom d-flex px-4 align-items-center">

                    <!-- Sidebar Toggle (Mobile) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3 text-decoration-none">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari sesuatu..." aria-label="Search">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Topbar Navbar (Right) -->
                    <div class="ms-auto d-flex align-items-center">

                        <!-- Nav Item - User Information -->
                        <div class="nav-item dropdown no-arrow d-flex align-items-center">
                            <a class="nav-link dropdown-toggle d-flex align-items-center text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2 d-none d-lg-inline text-muted small fw-bold"><?= $_SESSION['username']; ?> (<?= ucfirst($_SESSION['level']); ?>)</span>
                                <!-- Using placeholder user image (local fallback would be profile.jpeg) -->
                                <img class="img-profile rounded-circle" src="<?= BASEURL; ?>/img/profile.jpeg" style="width: 2rem; height: 2rem; object-fit: cover; border: 1px solid #ddd;" alt="Admin">
                            </a>
                            <!-- Dropdown - User Information -->
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item text-secondary py-2" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile</a></li>
                                <li><a class="dropdown-item text-secondary py-2" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-secondary py-2" href="<?= BASEURL; ?>/login/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a></li>
                            </ul>
                        </div>

                    </div>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid px-4">