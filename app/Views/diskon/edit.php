<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Edit Diskon</h2>

<form action="/diskon/update/<?= $diskon['id'] ?>" method="post">
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" class="form-control" value="<?= $diskon['tanggal'] ?>" readonly>
  </div>
  <div class="mb-3">
    <label for="nominal" class="form-label">Nominal</label>
    <input type="number" name="nominal" class="form-control" value="<?= $diskon['nominal'] ?>" required>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>

<?= $this->endSection() ?>
