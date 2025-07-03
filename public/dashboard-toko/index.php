<?php ob_start(); ?>

<?php
error_log("✅ Dashboard LOG aktif!");

// Fungsi CURL
function curl()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost:8080/api",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: wiwokdetok12367",
        ),
    ));

    $output = curl_exec($curl);

    if ($output === false) {
        error_log("❌ CURL Error: " . curl_error($curl));
        curl_close($curl);
        return [];
    }

    curl_close($curl);

    $data = json_decode($output);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("❌ JSON Decode Error: " . json_last_error_msg());
        return [];
    }

    // Tangani jika data langsung array
    if (is_array($data)) {
        return $data;
    }

    // Jika berbentuk objek dengan results
    return $data->results ?? [];
}

// Fungsi status transaksi
function getStatusText($status)
{
    return match ($status) {
        0 => "Belum Selesai",
        1 => "Sudah Selesai",
        2 => "Dibatalkan",
        default => "Tidak Diketahui"
    };
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Toko</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="p-3 pb-md-4 mx-auto text-center">
  <h1 class="display-4 fw-normal text-body-emphasis">Dashboard - TOKO</h1>
  <p class="fs-5 text-body-secondary"><?= date("l, d-m-Y") ?> <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></p>
</div>

<div class="table-responsive card m-5 p-5">
  <table class="table text-center">
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Alamat</th>
        <th>Total Harga</th>
        <th>Ongkir</th>
        <th>Status</th>
        <th>Tanggal Transaksi</th>
        <th>Jumlah Item</th> <!-- ✅ Kolom tambahan -->
      </tr>
    </thead>
    <tbody>
      <?php
      $transaksiList = curl();
      $i = 1;

      if (!empty($transaksiList)) {
          foreach ($transaksiList as $item) {
              // Hitung jumlah item dibeli
              $jumlahItem = 0;
              if (isset($item->items) && is_array($item->items)) {
                  foreach ($item->items as $itm) {
                      $jumlahItem += $itm->jumlah ?? 0;
                  }
              }
              ?>
              <tr>
                  <td><?= $i++ ?></td>
                  <td><?= esc($item->username ?? '-') ?></td>
                  <td><?= esc($item->alamat ?? '-') ?></td>
                  <td>Rp<?= number_format($item->total_harga ?? 0) ?></td>
                  <td>Rp<?= number_format($item->ongkir ?? 0) ?></td>
                  <td><?= getStatusText($item->status ?? -1) ?></td>
                  <td><?= esc($item->created_at ?? '-') ?></td>
                  <td><?= $jumlahItem ?></td>
              </tr>
              <?php
          }
      } else {
          echo '<tr><td colspan="8" class="text-center text-danger">Tidak ada data transaksi.</td></tr>';
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  window.setTimeout("waktu()", 1000);

  function waktu() {
      var waktu = new Date();
      setTimeout("waktu()", 1000);
      document.getElementById("jam").innerHTML = waktu.getHours();
      document.getElementById("menit").innerHTML = waktu.getMinutes();
      document.getElementById("detik").innerHTML = waktu.getSeconds();
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<?php ob_end_flush(); ?>
</body>
</html>
