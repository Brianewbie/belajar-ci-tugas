<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php elseif (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<!-- Tombol Tambah Diskon -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
  Tambah Diskon
</button>

<!-- Tabel Diskon -->
<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>Tanggal</th>
      <th>Nominal (Rp)</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($diskon as $d): ?>
      <tr>
        <td><?= esc($d['tanggal']) ?></td>
        <td>Rp<?= number_format($d['nominal'], 0, ',', '.') ?></td>
        <td>
          <!-- Tombol Ubah -->
          <button
            class="btn btn-success btn-sm edit-btn"
            data-id="<?= $d['id'] ?>"
            data-tanggal="<?= $d['tanggal'] ?>"
            data-nominal="<?= $d['nominal'] ?>"
            data-bs-toggle="modal"
            data-bs-target="#modalEdit">
            Ubah
          </button>

          <form action="/diskon/delete/<?= $d['id'] ?>" method="post" style="display:inline;">
            <input type="hidden" name="_method" value="delete">
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus diskon?')">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<!-- Modal Tambah Diskon -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <form action="/diskon/store" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Diskon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="tanggal" class="form-label">Tanggal</label>
          <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>" required>
        </div>
        <div class="mb-3">
          <label for="nominal" class="form-label">Nominal</label>
          <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Diskon -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" class="modal-content" id="formEdit">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Diskon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Tanggal</label>
          <input type="date" name="tanggal" id="editTanggal" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label>Nominal</label>
          <input type="number" name="nominal" id="editNominal" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<!-- SCRIPT -->
<?= $this->section('script') ?>
<script>
  // Buka modal tambah kalau ada flash error
  <?php if (session()->getFlashdata('error')): ?>
    const modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'));
    modalTambah.show();
  <?php endif; ?>

  // Modal edit
  $('.edit-btn').on('click', function () {
    const id = $(this).data('id');
    const tanggal = $(this).data('tanggal');
    const nominal = $(this).data('nominal');

    $('#editTanggal').val(tanggal);
    $('#editNominal').val(nominal);
    $('#formEdit').attr('action', '/diskon/update/' + id);
  });
</script>
<?= $this->endSection() ?>
