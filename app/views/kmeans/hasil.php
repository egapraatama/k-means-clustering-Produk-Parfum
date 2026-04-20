<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $data['judul']; ?></h1>
        <a href="<?= BASEURL; ?>/kmeans" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Data Awal
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-lg-12">
            <?php if($data['status_konvergen']) : ?>
                <div class="alert alert-success shadow-sm border-left-success">
                    <h5 class="font-weight-bold mb-1"><i class="fas fa-check-circle"></i> Algoritma Telah Konvergen!</h5>
                    <p class="mb-0">Posisi Centroid sudah stabil dan tidak berubah lagi pada <b>Iterasi ke-<?= $data['total_iterasi']; ?></b>. Proses perhitungan dihentikan.</p>
                </div>
            <?php else : ?>
                <div class="alert alert-warning shadow-sm border-left-warning">
                    <h5 class="font-weight-bold mb-1"><i class="fas fa-exclamation-triangle"></i> Batas Iterasi Tercapai!</h5>
                    <p class="mb-0">Algoritma dihentikan secara paksa pada batas maksimal (Iterasi ke-<?= $data['total_iterasi']; ?>) untuk mencegah beban server.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php foreach($data['riwayat_iterasi'] as $iterasi_ke => $detail) : ?>
        <div class="card shadow mb-5">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-sync-alt"></i> Iterasi Ke-<?= $iterasi_ke; ?> 
                    <?= ($iterasi_ke == $data['total_iterasi']) ? '(Hasil Akhir)' : ''; ?>
                </h6>
            </div>
            <div class="card-body">
                
                <div class="mb-4">
                    <h6 class="font-weight-bold text-dark mb-2">
                        <i class="fas fa-crosshairs"></i> Titik Pusat (Centroid) Saat Ini:
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped" width="100%" cellspacing="0">
                            <thead class="bg-light text-center">
                                    <tr>
                                        <th class="text-dark" width="15%">Kode Cluster</th>
                                        <th class="text-dark">Harga</th>
                                        <th class="text-dark">Volume</th>
                                        <th class="text-dark">Frekuensi</th>
                                        <th class="text-dark">Aroma</th>
                                        <th class="text-dark">Rating</th>
                                    </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach($detail['centroid'] as $c) : ?>
                                <tr>
                                    <td class="fw-bold"><?= $c['kode_cluster']; ?></td>
                                    <td><?= $c['harga']; ?></td>
                                    <td><?= $c['volume']; ?></td>
                                    <td><?= $c['frekuensi']; ?></td>
                                    <td><?= $c['aroma']; ?></td>
                                    <td><?= $c['rating']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <p class="text-muted small mb-2">
                    *Keterangan: Cluster ditentukan berdasarkan label yang didefinisikan di manajemen cluster.
                </p>

                <p class="text-muted small mb-2">
                    *Kolom yang di-highlight kuning menunjukkan jarak terdekat dari produk ke centroid.
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-data" width="100%" cellspacing="0">
                   <thead class="bg-light text-center">
                    <tr>
                        <th rowspan="2" class="align-middle text-dark" width="5%">No</th>
                        <th rowspan="2" class="align-middle text-dark">Nama Produk</th>
                        <th colspan="<?= count($detail['centroid']); ?>" class="text-dark">Jarak ke Centroid</th>
                        <th rowspan="2" class="align-middle text-dark">Min Distance</th>
                        <th rowspan="2" class="align-middle text-dark">Hasil<br>Cluster</th>
                        <th rowspan="2" class="align-middle text-dark">Group<br>Awal</th>
                        <th rowspan="2" class="align-middle text-dark">Group<br>Baru</th>
                        <th rowspan="2" class="align-middle text-dark">Prioritas</th>
                    </tr>
                    <tr>
                        <?php foreach($detail['centroid'] as $c) : ?>
                            <th class="text-dark"><?= $c['kode_cluster']; ?></th> 
                        <?php endforeach; ?>
                    </tr>
                    </thead>    
                        <tbody>
                            <?php $no = 1; foreach($detail['hasil'] as $index => $row) : ?>
                            
                            <?php 
                                // LOGIKA PENENTUAN LABEL — DINAMIS dari database, bukan hardcode
                                $cluster_sekarang = $row['cluster'];
                                $nama_cluster_sekarang = $data['cluster_names'][$cluster_sekarang] ?? $cluster_sekarang;
                                $is_best_seller = (stripos($nama_cluster_sekarang, 'best') !== false || stripos($nama_cluster_sekarang, 'seller') !== false);
                                $badge_color = $is_best_seller ? 'success' : 'danger';

                                // Cek status pada iterasi sebelumnya (Group Awal)
                                if ($iterasi_ke == 1) {
                                    $status_awal = '-'; 
                                } else {
                                    $cluster_sebelumnya = $data['riwayat_iterasi'][$iterasi_ke - 1]['hasil'][$index]['cluster'];
                                    $nama_cluster_sebelumnya = $data['cluster_names'][$cluster_sebelumnya] ?? $cluster_sebelumnya;
                                    $status_awal = $nama_cluster_sebelumnya;
                                }
                            ?>

                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-bold"><?= $row['nama_dataset']; ?></td>
                                
                                <?php foreach($row['jarak'] as $kode_centroid => $nilai_jarak) : ?>
                                    <td class="text-center <?= ($nilai_jarak == $row['min_jarak']) ? 'bg-warning text-dark fw-bold' : ''; ?>">
                                        <?= number_format($nilai_jarak, 3); ?>
                                    </td>
                                <?php endforeach; ?>

                                <td class="text-center fw-bold"><?= number_format($row['min_jarak'], 3); ?></td>
                                <td class="text-center fw-bold h6">
                                    <span class="badge bg-secondary"><?= $row['cluster']; ?></span>
                                </td>
                                
                                <td class="text-center fw-bold"><?= $status_awal; ?></td>
                                <td class="text-center fw-bold"><?= $nama_cluster_sekarang; ?></td>
                                <td class="text-center">
                                    <span class="badge bg-<?= $badge_color; ?>"><?= $nama_cluster_sekarang; ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <?php 
        $iterasi_akhir = $data['total_iterasi'];
        $hasil_akhir = $data['riwayat_iterasi'][$iterasi_akhir]['hasil'];
        
        // Hitung total anggota per cluster secara dinamis
        $cluster_counts = [];
        foreach ($hasil_akhir as $ha) {
            $kode = $ha['cluster'];
            if (!isset($cluster_counts[$kode])) $cluster_counts[$kode] = 0;
            $cluster_counts[$kode]++;
        }
    ?>

    <div class="row mt-5 mb-4">
        <div class="col-lg-12">
            <h1 class="h4 mb-0 text-gray-800 border-bottom pb-2"><i class="fas fa-flag-checkered text-success"></i> Kesimpulan Evaluasi K-Means</h1>
        </div>
    </div>

    <div class="row mb-5">
        <?php foreach ($data['cluster_names'] as $kode => $nama) : ?>
            <?php 
                $is_best = (stripos($nama, 'best') !== false || stripos($nama, 'seller') !== false);
                $border_color = $is_best ? 'success' : 'danger';
                $icon = $is_best ? 'fa-arrow-up' : 'fa-arrow-down';
                $label = $is_best ? 'Parfum Banyak Diminati' : 'Parfum Kurang Diminati';
                $jumlah = $cluster_counts[$kode] ?? 0;
            ?>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-<?= $border_color; ?> shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-<?= $border_color; ?> text-uppercase mb-1">Total <?= $kode; ?> (<?= $nama; ?>)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah; ?> <?= $label; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas <?= $icon; ?> fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>