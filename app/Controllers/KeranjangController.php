<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class KeranjangController extends BaseController
{
    protected $cart;

    public function __construct()
    {
        $this->cart = Services::cart();
    }

    public function index()
    {
        $data = [
            'items' => $this->cart->contents(),
            'total' => $this->cart->total(),
        ];

        return view('v_keranjang', $data);
    }

    public function add()
    {
        $harga = $this->request->getPost('harga');
        $id    = $this->request->getPost('id');
        $nama  = $this->request->getPost('nama');
        $foto  = $this->request->getPost('foto');

        // Validasi minimal
        if (!$id || !$harga) {
            return redirect()->back()->with('error', 'Data produk tidak lengkap.');
        }

        $this->cart->insert([
            'id'      => $id,
            'name'    => $nama,
            'price'   => $harga, // ✅ harga sudah diskon dari form
            'qty'     => 1,
            'options' => ['foto' => $foto],
        ]);

        return redirect()->to('/keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function edit()
    {
        $request = service('request');
        $items = $this->cart->contents();
        $i = 1;

        foreach ($items as $item) {
            $qty = $request->getPost('qty' . $i++);
            $this->cart->update([
                'rowid' => $item['rowid'],
                'qty'   => $qty
            ]);
        }

        return redirect()->to('/keranjang')->with('success', 'Keranjang diperbarui.');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        return redirect()->to('/keranjang')->with('success', 'Item dihapus dari keranjang.');
    }

    public function clear()
    {
        $this->cart->destroy();
        return redirect()->to('/keranjang')->with('success', 'Keranjang dikosongkan.');
    }
}
