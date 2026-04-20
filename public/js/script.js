$(function() {

    $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        // Tambahan: Pastikan action form balik ke tambah
        $('.modal-body form').attr('action', BASEURL + '/mahasiswa/tambah');
        
        // Opsional: Kosongkan inputan saat klik tambah
        $('#nama').val('');
        $('#nrp').val('');
        $('#email').val('');
        $('#id').val('');
    });

    $('.tampilmodalUbah').on('click', function() {
        $('#formModalLabel').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        
        // GANTI: Gunakan variabel BASEURL (tanpa kutip di variabelnya)
        $('.modal-body form').attr('action', BASEURL + '/mahasiswa/ubah');

        const id = $(this).data('id');

        $.ajax({
            // GANTI: Gunakan variabel BASEURL
            url: BASEURL + '/mahasiswa/getubah',
            data: {id: id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#nrp').val(data.nrp);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        });
    });

    // Inisialisasi DataTables secara eksplisit untuk setiap tabel dengan class .table-data
    if ($.fn.DataTable) {
        $('.table-data').each(function() {
            if (!$.fn.DataTable.isDataTable(this)) {
                $(this).DataTable({
                    "language": {
                        "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
                        "sProcessing":   "Sedang memproses...",
                        "sLengthMenu":   "Tampilkan _MENU_ entri",
                        "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                        "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "sInfoPostFix":  "",
                        "sSearch":       "Cari Data:",
                        "sUrl":          "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Sedang memuat...",
                        "oPaginate": {
                            "sFirst":    "Pertama",
                            "sLast":     "Terakhir",
                            "sNext":     "Selanjutnya",
                            "sPrevious": "Sebelumnya"
                        },
                        "oAria": {
                            "sSortAscending":  ": aktifkan untuk mengurutkan kolom ke atas",
                            "sSortDescending": ": aktifkan untuk mengurutkan kolom menurun"
                        }
                    },
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                    "responsive": true,
                    "autoWidth": false,
                    "orderCellsTop": true,
                    "stateSave": true // Mengingat halaman terakhir yang dibuka
                });
            }
        });
    }

});