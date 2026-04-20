<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php Flasher::flash(); ?>
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary text-white shadow" data-bs-toggle="modal" data-bs-target="#clusterModal">
            <i class="fas fa-plus"></i> Tambah Cluster Baru
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-primary">Data Titik Pusat (Centroid) Awal</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-dark text-center">
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;" width="5%">No</th>
                        <th rowspan="2" style="vertical-align: middle;" width="10%">Kode</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Cluster</th>
                        <th rowspan="2" style="vertical-align: middle;">Produk Acuan</th>
                        <th colspan="<?= count($data['kriteria']); ?>">Center Points (Nilai Asli)</th>
                        <th rowspan="2" style="vertical-align: middle;" width="10%">Aksi</th>
                    </tr>
                    <tr>
                        <?php foreach($data['kriteria'] as $k) : ?>
                            <th class="small"><?= strtoupper($k['nama_kriteria']); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['cluster'])) : ?>
                    <tr>
                        <td colspan="<?= count($data['kriteria']) + 5; ?>" class="text-center text-muted p-4">
                            Belum ada Cluster. Silakan pilih produk sebagai titik pusat awal (Centroid).
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php $no = 1; foreach($data['cluster'] as $cl) : ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center fw-bold text-primary"><?= $cl['kode_cluster']; ?></td>
                        <td><?= $cl['nama_cluster']; ?></td>
                        <td class="small text-muted"><?= $cl['nama_dataset']; ?></td>
                        
                        <?php foreach($data['kriteria'] as $k) : ?>
                            <?php $namaKolom = strtolower(str_replace(' ', '_', $k['nama_kriteria'])); ?>
                            <td class="text-center bg-light">
                                <?= (isset($cl[$namaKolom])) ? $cl[$namaKolom] : '-'; ?>
                            </td>
                        <?php endforeach; ?>

                        <td class="text-center">
                            <a href="<?= BASEURL; ?>/cluster/hapus/<?= $cl['id_cluster']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus cluster ini?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="clusterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-bullseye"></i> Tambah Centroid Awal</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        
        <form action="<?= BASEURL; ?>/cluster/tambah" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Kode</label>
                    <input type="text" class="form-control" name="kode_cluster" placeholder="C1" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Label Cluster</label>
                    <input type="text" class="form-control" name="nama_cluster" placeholder="Contoh: Best Seller" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Produk (Data Acuan Centroid)</label>
                <select name="id_dataset" class="form-control selectpicker" data-live-search="true" required>
                    <option value="">-- Cari & Pilih Produk --</option>
                    <?php foreach($data['dataset'] as $ds) : ?>
                        <option value="<?= $ds['id_dataset']; ?>">
                            <?= $ds['nama_dataset']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-info mt-2 d-block">
                    <i class="fas fa-info-circle"></i> Sistem akan otomatis menarik nilai kriteria dari produk yang Anda pilih.
                </small>
            </div>

      </div>
      <div class="modal-footer bg-light border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Cluster</button>
        </form>
      </div>
    </div>
  </div>
</div>