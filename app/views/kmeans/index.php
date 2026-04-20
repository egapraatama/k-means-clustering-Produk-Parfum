<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
        <a href="<?= BASEURL; ?>/kmeans/hitung" class="btn btn-primary shadow-sm">
            <i class="fas fa-play fa-sm text-white-50"></i> Mulai Hitung K-Means
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-success">
        <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-table"></i> 1. Data Dataset (Hasil Transformasi)</h6>
    </div>
    <div class="card-body">
        <p class="text-muted small">*Data di bawah ini adalah hasil mapping dari data mentah menjadi bobot angka (1-5) sesuai kriteria skripsi.</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Volume</th>
                        <th>Frekuensi</th>
                        <th>Aroma</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($data['dataset_transformasi'] as $ds) : ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $ds['nama_dataset']; ?></td>
                        <td class="text-center"><?= $ds['harga']; ?></td>
                        <td class="text-center"><?= $ds['volume']; ?></td>
                        <td class="text-center"><?= $ds['frekuensi']; ?></td>
                        <td class="text-center"><?= $ds['aroma']; ?></td>
                        <td class="text-center"><?= $ds['rating']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-info">
            <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-crosshairs"></i> 2. Titik Pusat Awal (Centroid)</h6>
        </div>
        <div class="card-body">
            <p class="text-muted small">*Centroid awal diambil dari data acuan yang telah dipilih sebelumnya.</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-data" width="100%" cellspacing="0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="10%">Kode Cluster</th>
                            <th>Produk Acuan</th>
                            <th>Harga</th>
                            <th>Volume</th>
                            <th>Frekuensi</th>
                            <th>Aroma</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['centroid_transformasi'] as $ct) : ?>
                        <tr class="text-center">
                            <!-- <td class="fw-bold text-primary">C<?= $ct['id_dataset']; ?></td> -->
                            <td class="fw-bold text-primary"><?= $ct['kode_cluster']; ?></td>
                            <td class="text-start fw-bold"><?= $ct['nama_dataset']; ?></td>
                            <td><?= $ct['harga']; ?></td>
                            <td><?= $ct['volume']; ?></td>
                            <td><?= $ct['frekuensi']; ?></td>
                            <td><?= $ct['aroma']; ?></td>
                            <td><?= $ct['rating']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


