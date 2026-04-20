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
        <!-- Native Bootstrap Modal trigger (Tidak pakai JS kustom) -->
        <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#kriteriaModal">
            <i class="fas fa-plus"></i> Tambah Kriteria Evaluasi
        </button>
    </div>
    <div class="col-lg-6">
        <form action="<?= BASEURL; ?>/kriteria/cari" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari tipe kriteria.." name="keyword" autocomplete="off">
                <button class="btn btn-info text-white" type="submit">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Daftar Variabel Analisis (Kriteria K-Means)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- Table Master Kriteria -->
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Data Kriteria</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach( $data['kriteria'] as $kr ) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td class="fw-bold text-dark"><?= $kr['nama_kriteria']; ?></td>
                        <td class="text-center">
                            <!-- Buka halaman PHP Edit khusus (Non-Ajax) -->
                            <a href="<?= BASEURL; ?>/kriteria/edit/<?= $kr['id_kriteria']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Tombol Bypass Hapus -->
                            <a href="<?= BASEURL; ?>/kriteria/hapus/<?= $kr['id_kriteria']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Peringatan: Menghapus Kriteria akan juga menghancurkan bobot matriks hitungan yang terlanjur diinput. Lanjutkan?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if(empty($data['kriteria'])) : ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada Kriteria yang didefinisikan. K-Means tidak bisa berjalan.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Simple Bootstrap Modal untuk Tambah Saja -->
<div class="modal fade" id="kriteriaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-top-info shadow">
      <div class="modal-header bg-info text-white alert-info border-0">
        <h5 class="modal-title">Tambah Variabel Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        
        <form action="<?= BASEURL; ?>/kriteria/tambah" method="post">
            <div class="mb-3">
                <label for="nama_kriteria" class="form-label fw-bold text-muted">Definisi Nama Kriteria</label>
                <input type="text" class="form-control form-control-lg text-dark" id="nama_kriteria" name="nama_kriteria" placeholder="(contoh: Angka Rating Pembeli)" required>
                <div class="form-text mt-2 text-warning"><i class="fas fa-exclamation-triangle"></i> Usahakan nama bisa merepresentasikan Kolom Baris pada data CSV nantinya!</div>
            </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-info text-white">Simpan Variabel</button>
        </form>
      </div>
    </div>
  </div>
</div>
