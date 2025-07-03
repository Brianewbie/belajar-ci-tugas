<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<h2>Tambah Diskon</h2>

<form action="/diskon/save" method="post">
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="form-group mt-2">
        <label>Nominal</label>
        <input type="number" name="nominal" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
</form>

<?= $this->endSection(); ?>
