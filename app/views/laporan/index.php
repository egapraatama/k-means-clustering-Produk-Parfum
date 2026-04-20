<div class="container-fluid mb-5">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
        <a href="<?= BASEURL; ?>/laporan/cetak" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan (PDF)
        </a>
    </div>

    <div class="row">

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-start border-danger border-4 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Low Demand
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $data['total_low_demand']; ?> Parfum Kurang Diminati
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-start border-success border-4 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Best Seller
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $data['total_best_seller']; ?> Parfum Banyak Diminati
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-dark text-white">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-table"></i> Rincian Kategori Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center text-primary bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Parfum</th>
                            <th>Jarak Akurasi (Min. Distance)</th>
                            <th>Kode Cluster</th>
                            <th>Prioritas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['laporan'])) : ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data yang tersedia pada tabel ini. Silakan lakukan perhitungan K-Means terlebih dahulu.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data['laporan'] as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $row['nama_dataset']; ?></td>
                                    
                                    <td class="text-center"><?= number_format($row['jarak_minimum'], 4); ?></td>
                                    
                                    <td class="text-center">
                                        <span class="badge <?= ($row['kode_cluster'] == 'C1') ? 'bg-danger' : 'bg-success'; ?>">
                                            <?= $row['kode_cluster']; ?>
                                        </span>
                                    </td>
                                    
                                    <td class="text-center">
                                        <strong><?= $row['nama_cluster']; ?></strong>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>