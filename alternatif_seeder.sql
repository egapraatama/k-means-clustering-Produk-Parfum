-- Struktur Tabel untuk 'tbl_alternatif'
CREATE TABLE `tbl_alternatif` (
    `id_alternatif` INT AUTO_INCREMENT PRIMARY KEY,
    `kode_alternatif` VARCHAR(10),
    `nama_alternatif` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Data Insert untuk Tabel 'tbl_alternatif' (Data Master Produk Parfum R2DH)
INSERT INTO `tbl_alternatif` (`kode_alternatif`, `nama_alternatif`) VALUES
('A01', 'Baccarat Rouge 540'),
('A02', 'Black Opium YSL'),
('A03', 'Vanilla Woods'),
('A04', 'Dior Sauvage'),
('A05', 'Chanel No. 5'),
('A06', 'Jo Malone English Pear & Freesia'),
('A07', 'Creed Aventus'),
('A08', 'Victoria Secret Bombshell'),
('A09', 'Tom Ford Oud Wood'),
('A10', 'Bulgari Omnia Amethyste'),
('A11', 'Hugo Boss Bottled'),
('A12', 'Versace Eros'),
('A13', 'Marc Jacobs Daisy'),
('A14', 'Zara Oriental Dew'),
('A15', 'Zara Red Vanilla');
