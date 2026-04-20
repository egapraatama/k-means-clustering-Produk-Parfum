<div class="container-fluid px-4 mt-4">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Daftar Mahasiswa</h1>
        <button type="button" class="btn btn-primary btn-sm shadow-sm tombolTambahData" data-bs-toggle="modal" data-bs-target="#formModal">
            <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Tambah Data Mahasiswa
        </button>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Mahasiswa</h6>
            </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover w-100 table-data" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NRP</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($data['mhs'] as $mhs) : ?>
                        <tr>
                            <td class="text-center text-gray-800"><?= $i++; ?></td>
                            <td class="fw-bold text-gray-800"><?= $mhs['nama']; ?></td>
                            <td><?= $mhs['nrp']; ?></td>
                            <td><?= $mhs['email']; ?></td>
                            <td><?= $mhs['jurusan']; ?></td>
                            <td class="text-center">
                                <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= $mhs['id']; ?>" class="btn btn-info btn-sm shadow-sm text-white px-2 py-1"><i class="fas fa-eye fa-sm"></i></a>
                                <a href="<?= BASEURL; ?>/mahasiswa/ubah/<?= $mhs['id']; ?>" class="btn btn-success btn-sm shadow-sm text-white px-2 py-1 tampilmodalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $mhs['id']; ?>"><i class="fas fa-edit fa-sm"></i></a>
                                <a href="<?= BASEURL; ?>/mahasiswa/hapus/<?= $mhs['id']; ?>" class="btn btn-danger btn-sm shadow-sm text-white px-2 py-1" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fas fa-trash fa-sm"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title font-weight-bold" id="formModalLabel">Tambah Data Mahasiswa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       
      <div class="modal-body p-4">
        <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="POST">
        <input type="hidden" name="id" id="id">
        
        <div class="mb-3">
          <label for="nama" class="form-label font-weight-bold text-gray-800 small text-uppercase">Nama</label>
          <input type="text" class="form-control bg-light border-0" id="nama" name="nama" required>
        </div>
        
        <div class="mb-3">
          <label for="nrp" class="form-label font-weight-bold text-gray-800 small text-uppercase">NRP</label>
          <input type="number" class="form-control bg-light border-0" id="nrp" name="nrp" required>
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label font-weight-bold text-gray-800 small text-uppercase">Email</label>
          <input type="email" class="form-control bg-light border-0" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
          <label for="jurusan" class="form-label font-weight-bold text-gray-800 small text-uppercase">Jurusan</label>
          <select class="form-select bg-light border-0" id="jurusan" name="jurusan">
            <option value="Informatika">Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Industri">Teknik Industri</option>
            <option value="Desain Interior">Desain Interior</option>
            <option value="Televisi dan Film">Televisi dan Film</option>
          </select>
        </div>
      </div>
      
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary shadow-sm">Tambah Data</button>
      </div>
      
      </form>
    </div>
  </div>
</div>