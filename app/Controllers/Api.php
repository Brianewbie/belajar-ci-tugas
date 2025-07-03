<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailModel;

class Api extends BaseController
{
    public function transaksi()
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new DetailModel();

        $transaksiList = $transaksiModel->findAll();

        foreach ($transaksiList as &$tr) {
            $items = $detailModel->where('id_transaksi', $tr['id_transaksi'])->findAll();
            $tr['jumlah_item'] = array_sum(array_column($items, 'qty'));
        }

        return $this->response->setJSON($transaksiList);
    }
}
