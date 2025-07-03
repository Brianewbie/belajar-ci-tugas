<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = isset($diskon); ?>
<form action="<?= $isEdit ? '/diskon/update/' . $diskon['id'] : '/diskon/save' ?>" method="post">
  <div class="modal-header">
    <h5 class="modal-title"><?= $isEdit ? 'Edit Diskon' : 'Tambah Diskon' ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  </div>

  <div class="modal-body">
    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $isEdit ? $diskon['tanggal'] : '' ?>" <?= $isEdit ? 'readonly' : '' ?> required>
    </div>
    <div class="mb-3">
      <label for="nominal" class="form-label">Nominal</label>
      <input type="number" name="nominal" class="form-control" value="<?= $isEdit ? $diskon['nominal'] : '' ?>" required>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?= $this->endSection() ?>
