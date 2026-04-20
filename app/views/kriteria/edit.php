<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm border-left-warning mb-4">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-warning text-uppercase"><i class="fas fa-edit"></i> Formulir Reposisi Parameter</h6>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL; ?>/kriteria/ubah" method="post">
                    <!-- Lemparan ID Hidden untuk dikenali Model -->
                    <input type="hidden" name="id_kriteria" value="<?= $data['kriteria']['id_kriteria']; ?>">
                    
                    <div class="mb-4 mt-2">
                        <label for="nama_kriteria" class="form-label text-muted fw-bold">Nama Kriteria Saat Ini</label>
                        <input type="text" class="form-control form-control-lg border-2" id="nama_kriteria" name="nama_kriteria" value="<?= $data['kriteria']['nama_kriteria']; ?>" required>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="<?= BASEURL; ?>/kriteria" class="btn btn-light border">Batalkan</a>
                        <button type="submit" class="btn btn-warning px-4 shadow-sm text-dark font-weight-bold">Simpan Struktur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
