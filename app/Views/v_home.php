<?= $this->extend('layout') ?>

<?php 
// Pastikan variabel $product ada dan tidak kosher
if (!isset($product)) {
    $product = [];
}
?>

<?= $this->section('title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<p>Welcome to the home page!</p>

<!-- Table with stripped rows -->
<div class="row">
    <?php foreach ($product as $key => $item) : ?>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" alt="..." width="100%">
                    <h5 class="card-title"><?php echo $item['nama'] ?><br><?php echo $item['harga'] ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<!-- End Table with stripped rows -->

<div class="navigation-links">
    <a href="<?= base_url('profile') ?>">Profile</a>
    <a href="<?= base_url('faq') ?>">FAQ</a>
    <a href="<?= base_url('contact') ?>">Contact</a>
</div>
<?= $this->endSection() ?>