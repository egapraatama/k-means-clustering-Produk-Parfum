<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-file-upload"></i> Import Dataset CSV
            </div>
            <div class="card-body">
                <form action="<?= BASEURL; ?>/dataset/upload" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file_csv" class="form-label">Pilih File (.csv)</label>
                        <input class="form-control" type="file" id="file_csv" name="file_csv" accept=".csv" required>
                        <div class="form-text">
                            Format CSV: Kolom 1 (No), Kolom 2 (Nama Parfum), diikuti dengan kolom kriteria sesuai urutan di sistem Kriteria. Peringatan: Import CSV akan me-reset/menghapus seluruh data sebelumnya!
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload & Proses Dinamis</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk Alternatif (Tersimpan di Sistem)</h6>
        <a href="<?= BASEURL; ?>/dataset/reset" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Peringatan: Seluruh data parfum akan dihapus bersih! Lanjutkan?');">
            <i class="fas fa-trash fa-sm text-white-50"></i> Kosongkan Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Parfum (Alternatif)</th>
                        
                        <?php foreach($data['kriteria'] as $krit) : ?>
                            <th><?= $krit['nama_kriteria']; ?></th>
                        <?php endforeach; ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['dataset'])) : ?>
                        <tr><td colspan="<?= count($data['kriteria']) + 2; ?>" class="text-center">Belum ada dataset. Silakan impor CSV.</td></tr>
                    <?php endif; ?>

                    <?php $i = 1; ?>
                    <?php foreach( $data['dataset'] as $ds ) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= $ds['nama_dataset']; ?></td>
                        
                        <?php foreach($data['kriteria'] as $k) : ?>
                            <?php 
                                // Ubah nama kriteria jadi nama kolom database (Contoh: "Jenis Aroma" jadi "jenis_aroma")
                                $namaKolom = strtolower(str_replace(' ', '_', $k['nama_kriteria'])); 
                            ?>
                            
                            <td><?= isset($ds[$namaKolom]) ? $ds[$namaKolom] : '-'; ?></td>
                            
                        <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>