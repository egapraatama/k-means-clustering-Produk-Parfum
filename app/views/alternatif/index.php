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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
            <i class="fas fa-plus"></i> Tambah Data Parfum
        </button>
    </div>
    <div class="col-lg-6">
        <form action="<?= BASEURL; ?>/alternatif/cari" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari nama parfum.." name="keyword" id="keyword" autocomplete="off">
                <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk Parfum (Alternatif)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Kode</th>
                        <th>Nama Parfum</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach( $data['alternatif'] as $alt ) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><span class="badge bg-secondary"><?= $alt['kode_alternatif']; ?></span></td>
                        <td><?= $alt['nama_alternatif']; ?></td>
                        <td class="text-center">
                            <!-- Tombol Ubah -> Beralih halaman manual (tanpa JS) -->
                            <a href="<?= BASEURL; ?>/alternatif/edit/<?= $alt['id_alternatif']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Tombol Hapus -->
                            <a href="<?= BASEURL; ?>/alternatif/hapus/<?= $alt['id_alternatif']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data parfum ini?');">
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

<!-- Modal Dialog untuk Tambah/Ubah -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Parfum</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="<?= BASEURL; ?>/alternatif/tambah" method="post">
            <input type="hidden" name="id_alternatif" id="id_alternatif">
            
            <div class="mb-3">
                <label for="kode_alternatif" class="form-label">Kode Parfum</label>
                <input type="text" class="form-control fw-bold" id="kode_alternatif" name="kode_alternatif" placeholder="Contoh: A01" required>
            </div>

            <div class="mb-3">
                <label for="nama_alternatif" class="form-label">Deksripsi/Nama Parfum</label>
                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" placeholder="Masukkan nama merek parfum" required>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
