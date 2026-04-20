USE `phpmvc`;

DROP TABLE IF EXISTS `tbl_hasil_clustering`;
DROP TABLE IF EXISTS `tbl_nilai_training`;
DROP TABLE IF EXISTS `tbl_kriteria`;
DROP TABLE IF EXISTS `tbl_dataset`;

CREATE TABLE `tbl_dataset` (
    `id_dataset` INT(11) NOT NULL AUTO_INCREMENT,
    `nama_dataset` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id_dataset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_kriteria` (
    `id_kriteria` INT(11) NOT NULL AUTO_INCREMENT,
    `nama_kriteria` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_kriteria` (`nama_kriteria`) VALUES
('Harga Parfum'),
('Volume'),
('Penjualan'),
('Frekuensi Pembelian'),
('Jenis Aroma'),
('Rating Pelanggan');

CREATE TABLE `tbl_nilai_training` (
    `id_nilai` INT(11) NOT NULL AUTO_INCREMENT,
    `id_dataset` INT(11) NOT NULL,
    `id_kriteria` INT(11) NOT NULL,
    `nilai_angka` FLOAT NOT NULL,
    PRIMARY KEY (`id_nilai`),
    FOREIGN KEY (`id_dataset`) REFERENCES `tbl_dataset`(`id_dataset`) ON DELETE CASCADE,
    FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria`(`id_kriteria`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_hasil_clustering` (
    `id_hasil` INT(11) NOT NULL AUTO_INCREMENT,
    `id_dataset` INT(11) NOT NULL,
    `iterasi_ke` INT(11) NOT NULL,
    `cluster_akhir` VARCHAR(50) NOT NULL,
    `tanggal_proses` DATETIME NOT NULL,
    PRIMARY KEY (`id_hasil`),
    FOREIGN KEY (`id_dataset`) REFERENCES `tbl_dataset`(`id_dataset`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
