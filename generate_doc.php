<?php
/**
 * Generator Dokumen Perhitungan Manual K-Means
 * Membaca langsung dari database agar data 100% selaras
 * Jalankan: php generate_doc.php
 */

// --- KONEKSI DATABASE ---
$pdo = new PDO('mysql:host=localhost;dbname=phpmvc', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// --- AMBIL DATA DARI DATABASE ---
$dataset = $pdo->query("SELECT * FROM tbl_dataset ORDER BY id_dataset ASC")->fetchAll();
$clusters = $pdo->query("SELECT c.*, d.* FROM tbl_cluster c JOIN tbl_dataset d ON c.id_dataset = d.id_dataset ORDER BY c.kode_cluster ASC")->fetchAll();
$kriteria = $pdo->query("SELECT * FROM tbl_kriteria ORDER BY id_kriteria ASC")->fetchAll();

// --- FUNGSI TRANSFORMASI (IDENTIK DENGAN KMeans_model.php) ---
function mapHarga($nilai) {
    $harga = (int) preg_replace('/[^0-9]/', '', $nilai);
    if ($harga >= 320000) return 1;
    if ($harga >= 270000) return 2;
    if ($harga >= 220000) return 3;
    if ($harga >= 190000) return 4;
    return 5;
}
function mapVolume($nilai) {
    $vol = (int) preg_replace('/[^0-9]/', '', $nilai);
    if ($vol >= 9) return 5;
    if ($vol >= 7) return 4;
    if ($vol >= 5) return 3;
    if ($vol >= 3) return 2;
    return 1;
}
function mapFrekuensi($nilai) {
    $frek = (int) preg_replace('/[^0-9]/', '', $nilai);
    if ($frek > 10) return 2;
    if ($frek >= 5) return 1;
    return 0;
}
function mapAroma($nama) {
    $nama = strtolower(trim($nama));
    if (strpos($nama, 'oriental') !== false) return 2;
    if (strpos($nama, 'wood') !== false) return 1;
    return 0;
}
function mapRating($status) {
    $status = strtolower(trim($status));
    if (strpos($status, 'ya') !== false || strpos($status, 'bagus') !== false) return 1;
    return 2;
}
function transformRow($row) {
    return [
        'id_dataset'   => $row['id_dataset'],
        'nama_dataset' => $row['nama_dataset'],
        'kode_cluster' => $row['kode_cluster'] ?? null,
        'harga'     => mapHarga($row['harga_parfum'] ?? 0),
        'volume'    => mapVolume($row['volume_penjualan'] ?? 0),
        'frekuensi' => mapFrekuensi($row['frekuensi_pembelian'] ?? 0),
        'aroma'     => mapAroma($row['jenis_aroma'] ?? ''),
        'rating'    => mapRating($row['rating_pelanggan'] ?? '')
    ];
}

// --- TRANSFORMASI DATA ---
$dataTransformasi = array_map('transformRow', $dataset);
$centroidTransformasi = array_map('transformRow', $clusters);

// --- FUNGSI EUCLIDEAN ---
function hitungEuclidean($dataTransformasi, $centroidTransformasi) {
    $hasil = [];
    foreach ($dataTransformasi as $data) {
        $jarakTerdekat = PHP_FLOAT_MAX;
        $clusterTerpilih = '';
        $detailJarak = [];
        foreach ($centroidTransformasi as $c) {
            $jarak = sqrt(
                pow(($data['harga'] - $c['harga']), 2) +
                pow(($data['volume'] - $c['volume']), 2) +
                pow(($data['frekuensi'] - $c['frekuensi']), 2) +
                pow(($data['aroma'] - $c['aroma']), 2) +
                pow(($data['rating'] - $c['rating']), 2)
            );
            $kodeCentroid = $c['kode_cluster'];
            $detailJarak[$kodeCentroid] = round($jarak, 4);
            if ($jarak < $jarakTerdekat) {
                $jarakTerdekat = $jarak;
                $clusterTerpilih = $kodeCentroid;
            }
        }
        $hasil[] = [
            'id_dataset' => $data['id_dataset'],
            'nama_dataset' => $data['nama_dataset'],
            'jarak' => $detailJarak,
            'min_jarak' => round($jarakTerdekat, 4),
            'cluster' => $clusterTerpilih
        ];
    }
    return $hasil;
}

// --- FUNGSI CENTROID BARU ---
function hitungCentroidBaru($dataTransformasi, $hasilEuclidean, $centroidLama) {
    $dataMap = [];
    foreach ($dataTransformasi as $d) $dataMap[$d['id_dataset']] = $d;
    $centroidBaru = [];
    foreach ($centroidLama as $lama) {
        $kode = $lama['kode_cluster'];
        $sum = ['harga'=>0,'volume'=>0,'frekuensi'=>0,'aroma'=>0,'rating'=>0];
        $n = 0;
        foreach ($hasilEuclidean as $h) {
            if ($h['cluster'] == $kode) {
                $n++;
                $dt = $dataMap[$h['id_dataset']];
                foreach ($sum as $k => &$v) $v += $dt[$k];
            }
        }
        if ($n > 0) {
            $centroidBaru[] = [
                'kode_cluster' => $kode,
                'id_dataset' => $lama['id_dataset'],
                'nama_dataset' => 'Rata-rata '.$kode,
                'harga' => round($sum['harga']/$n, 4),
                'volume' => round($sum['volume']/$n, 4),
                'frekuensi' => round($sum['frekuensi']/$n, 4),
                'aroma' => round($sum['aroma']/$n, 4),
                'rating' => round($sum['rating']/$n, 4),
            ];
        } else {
            $centroidBaru[] = $lama;
        }
    }
    return $centroidBaru;
}

function centroidSama($a, $b, $eps = 0.0001) {
    foreach ($a as $i => $ca) {
        foreach (['harga','volume','frekuensi','aroma','rating'] as $k) {
            if (abs($ca[$k] - $b[$i][$k]) > $eps) return false;
        }
    }
    return true;
}

// --- JALANKAN ITERASI K-MEANS ---
$centroidSekarang = $centroidTransformasi;
$maxIterasi = 15;
$iterasi = 0;
$konvergen = false;
$riwayat = [];

while (!$konvergen && $iterasi < $maxIterasi) {
    $iterasi++;
    $hasilEuclidean = hitungEuclidean($dataTransformasi, $centroidSekarang);
    $riwayat[$iterasi] = ['centroid' => $centroidSekarang, 'hasil' => $hasilEuclidean];
    $centroidBaru = hitungCentroidBaru($dataTransformasi, $hasilEuclidean, $centroidSekarang);
    if (centroidSama($centroidSekarang, $centroidBaru)) {
        $konvergen = true;
    } else {
        $centroidSekarang = $centroidBaru;
    }
}

// --- HITUNG TOTAL CLUSTER AKHIR ---
$hasilAkhir = end($riwayat)['hasil'];
$totalPerCluster = [];
foreach ($hasilAkhir as $h) {
    $totalPerCluster[$h['cluster']] = ($totalPerCluster[$h['cluster']] ?? 0) + 1;
}

// =====================================================
// GENERATE WORD DOCUMENT (HTML FORMAT)
// =====================================================

$html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta charset="utf-8">
<meta name="ProgId" content="Word.Document">
<!--[if gte mso 9]><xml><w:WordDocument><w:View>Print</w:View></w:WordDocument></xml><![endif]-->
<style>
body { font-family: "Times New Roman", serif; font-size: 12pt; line-height: 2.0; }
h2 { font-size: 12pt; font-weight: bold; text-align: center; margin-top: 18pt; margin-bottom: 6pt; }
h3 { font-size: 12pt; font-weight: bold; margin-top: 12pt; margin-bottom: 6pt; }
p { text-align: justify; margin: 0 0 6pt 0; text-indent: 36pt; }
p.no-indent { text-indent: 0; }
p.center { text-align: center; text-indent: 0; }
p.formula { text-align: left; text-indent: 0; margin-left: 36pt; font-family: "Cambria Math", "Times New Roman", serif; }
table { border-collapse: collapse; margin: 6pt auto; font-size: 11pt; }
table.data-table { width: 100%; }
th, td { border: 1px solid black; padding: 4pt 6pt; text-align: center; vertical-align: middle; }
th { font-weight: bold; background-color: #D9E2F3; }
td.left { text-align: left; }
td.bold { font-weight: bold; }
span.bold { font-weight: bold; }
ol, ul { margin-left: 36pt; }
li { margin-bottom: 3pt; }
.page-break { page-break-before: always; }
</style>
</head>
<body lang="id">';

// ===== JUDUL =====
$html .= '<h2>PERHITUNGAN MANUAL METODE K-MEANS CLUSTERING<br>TOKO PARFUM R2DH</h2>';

// ===== TAHAP 1: DATA MENTAH =====
$html .= '<h3>1. Data Mentah (Data Understanding)</h3>';
$html .= '<p>Data yang digunakan dalam penelitian ini adalah data penjualan parfum dari Toko Parfum R2DH yang berjumlah ' . count($dataset) . ' data produk parfum dengan ' . count($kriteria) . ' kriteria penilaian, yaitu: ';
$kNames = array_column($kriteria, 'nama_kriteria');
$html .= implode(', ', $kNames) . '.</p>';

$html .= '<p class="center"><span class="bold">Tabel 1. Data Mentah Penjualan Parfum (10 Sampel Pertama)</span></p>';
$html .= '<table class="data-table"><thead><tr><th>No</th><th>Nama Produk</th><th>Harga Parfum</th><th>Volume Penjualan</th><th>Frekuensi Pembelian</th><th>Jenis Aroma</th><th>Rating Pelanggan</th></tr></thead><tbody>';
for ($i = 0; $i < min(10, count($dataset)); $i++) {
    $d = $dataset[$i];
    $html .= '<tr><td>'.($i+1).'</td><td class="left">'.$d['nama_dataset'].'</td><td>Rp '.number_format($d['harga_parfum'],0,',','.').'</td><td>'.$d['volume_penjualan'].'</td><td>'.$d['frekuensi_pembelian'].'</td><td>'.$d['jenis_aroma'].'</td><td>'.$d['rating_pelanggan'].'</td></tr>';
}
$html .= '<tr><td colspan="7" style="text-align:center; font-style:italic;">... dan seterusnya hingga data ke-'.count($dataset).'</td></tr>';
$html .= '</tbody></table>';

// ===== TAHAP 2: ATURAN TRANSFORMASI =====
$html .= '<div class="page-break"></div>';
$html .= '<h3>2. Tahap Transformasi Data (Data Preparation)</h3>';
$html .= '<p>Sebelum data dapat diproses menggunakan algoritma K-Means, data mentah yang bersifat kategorikal maupun numerik perlu ditransformasi menjadi nilai bobot numerik. Berikut adalah aturan transformasi yang digunakan:</p>';

// Tabel Harga
$html .= '<p class="center"><span class="bold">Tabel 2a. Aturan Transformasi Harga Parfum</span></p>';
$html .= '<table><tr><th>Rentang Harga</th><th>Bobot</th></tr>';
$html .= '<tr><td>≥ Rp 320.000</td><td>1</td></tr>';
$html .= '<tr><td>Rp 270.000 – Rp 319.999</td><td>2</td></tr>';
$html .= '<tr><td>Rp 220.000 – Rp 269.999</td><td>3</td></tr>';
$html .= '<tr><td>Rp 190.000 – Rp 219.999</td><td>4</td></tr>';
$html .= '<tr><td>&lt; Rp 190.000</td><td>5</td></tr></table>';

// Tabel Volume
$html .= '<p class="center"><span class="bold">Tabel 2b. Aturan Transformasi Volume Penjualan</span></p>';
$html .= '<table><tr><th>Volume</th><th>Bobot</th></tr>';
$html .= '<tr><td>9 – 10</td><td>5</td></tr>';
$html .= '<tr><td>7 – 8</td><td>4</td></tr>';
$html .= '<tr><td>5 – 6</td><td>3</td></tr>';
$html .= '<tr><td>3 – 4</td><td>2</td></tr>';
$html .= '<tr><td>1 – 2</td><td>1</td></tr></table>';

// Tabel Frekuensi
$html .= '<p class="center"><span class="bold">Tabel 2c. Aturan Transformasi Frekuensi Pembelian</span></p>';
$html .= '<table><tr><th>Frekuensi</th><th>Bobot</th></tr>';
$html .= '<tr><td>&gt; 10</td><td>2</td></tr>';
$html .= '<tr><td>5 – 10</td><td>1</td></tr>';
$html .= '<tr><td>0 – 4</td><td>0</td></tr></table>';

// Tabel Aroma
$html .= '<p class="center"><span class="bold">Tabel 2d. Aturan Transformasi Jenis Aroma</span></p>';
$html .= '<table><tr><th>Jenis Aroma</th><th>Bobot</th></tr>';
$html .= '<tr><td>Oriental</td><td>2</td></tr>';
$html .= '<tr><td>Woody</td><td>1</td></tr>';
$html .= '<tr><td>Fresh</td><td>0</td></tr></table>';

// Tabel Rating
$html .= '<p class="center"><span class="bold">Tabel 2e. Aturan Transformasi Rating Pelanggan</span></p>';
$html .= '<table><tr><th>Rating</th><th>Bobot</th></tr>';
$html .= '<tr><td>Bagus / Ya</td><td>1</td></tr>';
$html .= '<tr><td>Tidak Dinilai / Tidak</td><td>2</td></tr></table>';

// ===== TAHAP 3: DATA SETELAH TRANSFORMASI =====
$html .= '<div class="page-break"></div>';
$html .= '<h3>3. Hasil Transformasi Data</h3>';
$html .= '<p>Berdasarkan aturan transformasi di atas, berikut adalah hasil konversi seluruh data mentah menjadi nilai bobot:</p>';

$html .= '<p class="center"><span class="bold">Tabel 3. Data Setelah Transformasi (Seluruh '.count($dataTransformasi).' Data)</span></p>';
$html .= '<table class="data-table"><thead><tr><th>No</th><th>Nama Produk</th><th>Harga</th><th>Volume</th><th>Frekuensi</th><th>Aroma</th><th>Rating</th></tr></thead><tbody>';
foreach ($dataTransformasi as $i => $d) {
    $html .= '<tr><td>'.($i+1).'</td><td class="left">'.$d['nama_dataset'].'</td><td>'.$d['harga'].'</td><td>'.$d['volume'].'</td><td>'.$d['frekuensi'].'</td><td>'.$d['aroma'].'</td><td>'.$d['rating'].'</td></tr>';
}
$html .= '</tbody></table>';

// ===== TAHAP 4: CENTROID AWAL =====
$html .= '<div class="page-break"></div>';
$html .= '<h3>4. Penentuan Centroid Awal</h3>';
$html .= '<p>Centroid awal ditentukan dari data produk yang telah dipilih sebagai acuan titik pusat cluster. Berikut centroid awal yang digunakan:</p>';

$html .= '<p class="center"><span class="bold">Tabel 4. Centroid Awal</span></p>';
$html .= '<table><thead><tr><th>Cluster</th><th>Nama Cluster</th><th>Produk Acuan</th><th>Harga</th><th>Volume</th><th>Frekuensi</th><th>Aroma</th><th>Rating</th></tr></thead><tbody>';
foreach ($clusters as $ci => $cl) {
    $ct = $centroidTransformasi[$ci];
    $html .= '<tr><td class="bold">'.$cl['kode_cluster'].'</td><td>'.$cl['nama_cluster'].'</td><td class="left">'.$cl['nama_dataset'].'</td><td>'.$ct['harga'].'</td><td>'.$ct['volume'].'</td><td>'.$ct['frekuensi'].'</td><td>'.$ct['aroma'].'</td><td>'.$ct['rating'].'</td></tr>';
}
$html .= '</tbody></table>';

// Tampilkan detail transformasi centroid
foreach ($clusters as $ci => $cl) {
    $ct = $centroidTransformasi[$ci];
    $html .= '<p class="no-indent" style="margin-left:36pt;"><span class="bold">'.$cl['kode_cluster'].' ('.$cl['nama_cluster'].') — '.$cl['nama_dataset'].':</span></p>';
    $html .= '<ul>';
    $html .= '<li>Harga: Rp '.number_format($cl['harga_parfum'],0,',','.') .' → Bobot ' . $ct['harga'] . '</li>';
    $html .= '<li>Volume Penjualan: '.$cl['volume_penjualan'].' → Bobot '.$ct['volume'].'</li>';
    $html .= '<li>Frekuensi Pembelian: '.$cl['frekuensi_pembelian'].' → Bobot '.$ct['frekuensi'].'</li>';
    $html .= '<li>Jenis Aroma: '.$cl['jenis_aroma'].' → Bobot '.$ct['aroma'].'</li>';
    $html .= '<li>Rating Pelanggan: '.$cl['rating_pelanggan'].' → Bobot '.$ct['rating'].'</li>';
    $html .= '</ul>';
}

// ===== TAHAP 5: RUMUS EUCLIDEAN =====
$html .= '<div class="page-break"></div>';
$html .= '<h3>5. Rumus Euclidean Distance</h3>';
$html .= '<p>Perhitungan jarak antara setiap data dengan centroid menggunakan rumus Euclidean Distance:</p>';
$html .= '<p class="formula"><i>d(x, c) = √( (x₁ - c₁)² + (x₂ - c₂)² + (x₃ - c₃)² + (x₄ - c₄)² + (x₅ - c₅)² )</i></p>';
$html .= '<p class="no-indent">Dimana:</p>';
$html .= '<ul>';
$html .= '<li>x₁ = Bobot Harga, x₂ = Bobot Volume, x₃ = Bobot Frekuensi, x₄ = Bobot Aroma, x₅ = Bobot Rating</li>';
$html .= '<li>c₁...c₅ = Nilai centroid yang bersesuaian</li>';
$html .= '</ul>';

// Contoh Perhitungan Manual (5 produk pertama)
$html .= '<h3>5.1. Contoh Perhitungan Manual Iterasi Ke-1</h3>';
$c1 = $centroidTransformasi[0]; // C1
$c2 = $centroidTransformasi[1]; // C2

$html .= '<p class="no-indent">Centroid saat ini:</p>';
$html .= '<ul>';
$html .= '<li>'.$c1['kode_cluster'].' = ['.$c1['harga'].', '.$c1['volume'].', '.$c1['frekuensi'].', '.$c1['aroma'].', '.$c1['rating'].']</li>';
$html .= '<li>'.$c2['kode_cluster'].' = ['.$c2['harga'].', '.$c2['volume'].', '.$c2['frekuensi'].', '.$c2['aroma'].', '.$c2['rating'].']</li>';
$html .= '</ul>';

// Detail 5 produk pertama
for ($i = 0; $i < 5; $i++) {
    $d = $dataTransformasi[$i];
    $nama = $d['nama_dataset'];
    $html .= '<p class="no-indent" style="margin-left:18pt;"><span class="bold">Produk '.($i+1).': '.$nama.' ['.$d['harga'].', '.$d['volume'].', '.$d['frekuensi'].', '.$d['aroma'].', '.$d['rating'].']</span></p>';

    foreach ($centroidTransformasi as $c) {
        $kode = $c['kode_cluster'];
        $dH = $d['harga'] - $c['harga']; $dV = $d['volume'] - $c['volume'];
        $dF = $d['frekuensi'] - $c['frekuensi']; $dA = $d['aroma'] - $c['aroma'];
        $dR = $d['rating'] - $c['rating'];
        $j = sqrt($dH*$dH + $dV*$dV + $dF*$dF + $dA*$dA + $dR*$dR);

        $html .= '<p class="formula">d('.$nama.', '.$kode.') = √( ('.$d['harga'].' - '.$c['harga'].')² + ('.$d['volume'].' - '.$c['volume'].')² + ('.$d['frekuensi'].' - '.$c['frekuensi'].')² + ('.$d['aroma'].' - '.$c['aroma'].')² + ('.$d['rating'].' - '.$c['rating'].')² )</p>';
        $html .= '<p class="formula">= √( '.($dH*$dH).' + '.($dV*$dV).' + '.($dF*$dF).' + '.($dA*$dA).' + '.($dR*$dR).' ) = √'.($dH*$dH + $dV*$dV + $dF*$dF + $dA*$dA + $dR*$dR).' = <span class="bold">'.round($j, 4).'</span></p>';
    }

    // Tentukan cluster
    $h1 = $riwayat[1]['hasil'][$i];
    $html .= '<p class="formula">Jarak minimum = <span class="bold">'.$h1['min_jarak'].'</span> → Masuk <span class="bold">'.$h1['cluster'].'</span></p><br>';
}

$html .= '<p>Dengan menggunakan rumus yang sama, perhitungan dilakukan untuk seluruh '.count($dataset).' data produk parfum.</p>';

// ===== ITERASI LENGKAP =====
foreach ($riwayat as $iter => $detail) {
    $html .= '<div class="page-break"></div>';
    $html .= '<h3>6.'.$iter.'. Iterasi Ke-'.$iter;
    if ($iter == $iterasi) $html .= ' (Hasil Akhir)';
    $html .= '</h3>';

    // Tabel Centroid
    $html .= '<p class="center"><span class="bold">Tabel Centroid Iterasi Ke-'.$iter.'</span></p>';
    $html .= '<table><tr><th>Cluster</th><th>Harga</th><th>Volume</th><th>Frekuensi</th><th>Aroma</th><th>Rating</th></tr>';
    foreach ($detail['centroid'] as $c) {
        $html .= '<tr><td class="bold">'.$c['kode_cluster'].'</td><td>'.$c['harga'].'</td><td>'.$c['volume'].'</td><td>'.$c['frekuensi'].'</td><td>'.$c['aroma'].'</td><td>'.$c['rating'].'</td></tr>';
    }
    $html .= '</table>';

    // Tabel Hasil Euclidean
    $html .= '<p class="center"><span class="bold">Tabel Hasil Perhitungan Euclidean Distance Iterasi Ke-'.$iter.'</span></p>';
    $html .= '<table class="data-table"><thead><tr><th>No</th><th>Nama Produk</th>';
    foreach ($detail['centroid'] as $c) {
        $html .= '<th>Jarak ke '.$c['kode_cluster'].'</th>';
    }
    $html .= '<th>Jarak Min</th><th>Cluster</th></tr></thead><tbody>';
    foreach ($detail['hasil'] as $idx => $h) {
        $html .= '<tr><td>'.($idx+1).'</td><td class="left">'.$h['nama_dataset'].'</td>';
        foreach ($h['jarak'] as $kode => $j) {
            $isBold = ($j == $h['min_jarak']) ? ' class="bold"' : '';
            $html .= '<td'.$isBold.'>'.number_format($j, 4).'</td>';
        }
        $html .= '<td class="bold">'.number_format($h['min_jarak'],4).'</td>';
        $html .= '<td class="bold">'.$h['cluster'].'</td></tr>';
    }
    $html .= '</tbody></table>';

    // Centroid Baru (jika bukan iterasi terakhir yang konvergen)
    if ($iter < $iterasi || !$konvergen) {
        $html .= '<h3>Perhitungan Centroid Baru Setelah Iterasi Ke-'.$iter.'</h3>';
        $html .= '<p>Centroid baru dihitung dari rata-rata nilai bobot seluruh anggota masing-masing cluster:</p>';
        $html .= '<p class="formula"><i>Centroid baru = ( Σxᵢ ) / n</i>, dimana n = jumlah anggota cluster</p>';

        $nextCentroid = ($iter < $iterasi) ? $riwayat[$iter+1]['centroid'] : $centroidSekarang;
        // Count members
        $memberCount = [];
        foreach ($detail['hasil'] as $h) {
            $memberCount[$h['cluster']] = ($memberCount[$h['cluster']] ?? 0) + 1;
        }
        foreach ($nextCentroid as $nc) {
            $n = $memberCount[$nc['kode_cluster']] ?? 0;
            $html .= '<p class="no-indent" style="margin-left:36pt;"><span class="bold">'.$nc['kode_cluster'].'</span> (n = '.$n.' anggota): ['.$nc['harga'].', '.$nc['volume'].', '.$nc['frekuensi'].', '.$nc['aroma'].', '.$nc['rating'].']</p>';
        }
    }
}

// ===== CEK KONVERGENSI =====
$html .= '<div class="page-break"></div>';
$html .= '<h3>7. Cek Konvergensi</h3>';
if ($konvergen) {
    $html .= '<p>Pada Iterasi Ke-'.$iterasi.', posisi centroid tidak mengalami perubahan dibandingkan iterasi sebelumnya. Oleh karena itu, algoritma telah <span class="bold">KONVERGEN</span> dan proses perhitungan dihentikan.</p>';
    if ($iterasi >= 2) {
        $html .= '<p class="center"><span class="bold">Perbandingan Centroid</span></p>';
        $html .= '<table><tr><th>Cluster</th><th>Centroid Iterasi '.($iterasi-1).'</th><th>Centroid Iterasi '.$iterasi.'</th><th>Status</th></tr>';
        $prevCentroid = $riwayat[$iterasi-1]['centroid'] ?? $riwayat[$iterasi]['centroid'];
        $currCentroid = $riwayat[$iterasi]['centroid'];
        foreach ($currCentroid as $ci => $cc) {
            $pc = $prevCentroid[$ci] ?? $cc;
            $html .= '<tr><td class="bold">'.$cc['kode_cluster'].'</td>';
            $html .= '<td>['.$pc['harga'].', '.$pc['volume'].', '.$pc['frekuensi'].', '.$pc['aroma'].', '.$pc['rating'].']</td>';
            $html .= '<td>['.$cc['harga'].', '.$cc['volume'].', '.$cc['frekuensi'].', '.$cc['aroma'].', '.$cc['rating'].']</td>';
            $html .= '<td>Sama</td></tr>';
        }
        $html .= '</table>';
    }
} else {
    $html .= '<p>Algoritma dihentikan pada batas maksimal Iterasi Ke-'.$iterasi.' (fail-safe). Centroid belum sepenuhnya konvergen.</p>';
}

// ===== KESIMPULAN =====
$html .= '<div class="page-break"></div>';
$html .= '<h3>8. Kesimpulan Evaluasi K-Means</h3>';
$html .= '<p>Berdasarkan hasil perhitungan algoritma K-Means Clustering yang telah dilakukan sebanyak '.$iterasi.' iterasi hingga konvergen, diperoleh pengelompokan sebagai berikut:</p>';

$html .= '<p class="center"><span class="bold">Tabel Kesimpulan Pengelompokan</span></p>';
$html .= '<table><tr><th>Cluster</th><th>Nama Cluster</th><th>Jumlah Produk</th></tr>';
foreach ($clusters as $cl) {
    $total = $totalPerCluster[$cl['kode_cluster']] ?? 0;
    $html .= '<tr><td class="bold">'.$cl['kode_cluster'].'</td><td>'.$cl['nama_cluster'].'</td><td>'.$total.' produk</td></tr>';
}
$html .= '</table>';

// Daftar anggota per cluster
foreach ($clusters as $cl) {
    $kode = $cl['kode_cluster'];
    $html .= '<p class="center"><span class="bold">Anggota Cluster '.$kode.' ('.$cl['nama_cluster'].')</span></p>';
    $html .= '<table class="data-table"><thead><tr><th>No</th><th>Nama Produk</th><th>Jarak Minimum</th></tr></thead><tbody>';
    $no = 1;
    foreach ($hasilAkhir as $h) {
        if ($h['cluster'] == $kode) {
            $html .= '<tr><td>'.$no.'</td><td class="left">'.$h['nama_dataset'].'</td><td>'.$h['min_jarak'].'</td></tr>';
            $no++;
        }
    }
    $html .= '</tbody></table>';
}

$html .= '</body></html>';

// --- SIMPAN FILE ---
$outputPath = __DIR__ . '/PERHITUNGAN_MANUAL_KMEANS.doc';
file_put_contents($outputPath, $html);
echo "✅ Dokumen berhasil dibuat: " . $outputPath . "\n";
echo "   Total data: " . count($dataset) . " produk\n";
echo "   Total iterasi: " . $iterasi . "\n";
echo "   Status: " . ($konvergen ? "Konvergen" : "Belum Konvergen") . "\n";
foreach ($totalPerCluster as $k => $v) {
    echo "   $k: $v produk\n";
}
