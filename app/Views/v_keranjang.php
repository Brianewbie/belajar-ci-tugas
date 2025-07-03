<?= $this->extend('layout') ?>
    <?= $this->section('content') ?>

   
    <?php if (session()->getFlashData('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?= form_open('keranjang/edit') ?>

    <!-- Table with stripped rows -->
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Foto</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $diskon = session()->get('diskon') ?? 0;
            $totalDiskon = 0;

            if (!empty($items)) :
                foreach ($items as $index => $item) :
                    $hargaAsli = $item['price'] + $diskon;
                    $subAsli   = $hargaAsli * $item['qty'];
                    $totalDiskon += $diskon * $item['qty'];
            ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td><img src="<?= base_url("img/" . $item['options']['foto']) ?>" width="100px"></td>
                        
                        <td>
                            <span class="text-muted text-decoration-line-through"><?= number_to_currency($hargaAsli, 'IDR') ?></span><br>
                            <strong><?= number_to_currency($item['price'], 'IDR') ?></strong>
                        </td>
                        
                        <td>
                            <input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= $item['qty'] ?>">
                        </td>

                        <td>
                            <span class="text-muted text-decoration-line-through"><?= number_to_currency($subAsli, 'IDR') ?></span><br>
                            <strong><?= number_to_currency($item['subtotal'], 'IDR') ?></strong>
                        </td>

                        <td>
                            <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
            <?php
                endforeach;
            else :
            ?>
                <tr>
                    <td colspan="6" class="text-center">Keranjang kosong</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Total -->
    <div class="alert alert-info">
        <?php if (!empty($items)) : ?>
            <?= "Total Sebelum Diskon = " . number_to_currency($total + $totalDiskon, 'IDR') ?><br>
            <?= "Total Diskon = - " . number_to_currency($totalDiskon, 'IDR') ?><br>
            <strong><?= "Total Setelah Diskon = " . number_to_currency($total, 'IDR') ?></strong>
        <?php else : ?>
            <strong>Total = Rp 0</strong>
        <?php endif; ?>
    </div>

    <!-- Tombol -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
        <a class="btn btn-warning" href="<?= base_url('keranjang/clear') ?>">Kosongkan Keranjang</a>
        <?php if (!empty($items)) : ?>
            <a class="btn btn-success" href="<?= base_url('checkout') ?>">Selesai Belanja</a>
        <?php endif; ?>
    </div>

    <?= form_close() ?>
    <?= $this->endSection() ?>