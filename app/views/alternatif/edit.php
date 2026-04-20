<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Perubahan Data</h6>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL; ?>/alternatif/ubah" method="post">
                    <input type="hidden" name="id_alternatif" value="<?= $data['alternatif']['id_alternatif']; ?>">
                    
                    <div class="mb-3">
                        <label for="kode_alternatif" class="form-label">Kode Parfum</label>
                        <input type="text" class="form-control fw-bold" id="kode_alternatif" name="kode_alternatif" value="<?= $data['alternatif']['kode_alternatif']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_alternatif" class="form-label">Deksripsi/Nama Parfum</label>
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" value="<?= $data['alternatif']['nama_alternatif']; ?>" required>
                    </div>

                    <div class="mt-4">
                        <a href="<?= BASEURL; ?>/alternatif" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
