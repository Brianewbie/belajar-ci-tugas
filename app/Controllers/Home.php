<?php

namespace App\Controllers;

use App\Models\ProductModel; 
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\DiskonModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;
    protected $diskonModel;

    function __construct()
    {
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
        $this->diskonModel = new DiskonModel();
    }

    public function index()
    {
        // ✅ Set timezone agar tanggal diskon cocok dengan Indonesia/WIB
        date_default_timezone_set('Asia/Jakarta');

        $diskonModel = new DiskonModel();
        $today = date('Y-m-d');
        $diskon = $diskonModel->where('tanggal', $today)->first();

        if ($diskon) {
            session()->set('diskon', $diskon['nominal']);
        } else {
            session()->remove('diskon');
        }

        $produkModel = new \App\Models\ProductModel();
        $data['produk'] = $produkModel->findAll();
        return view('v_home', $data);
    }

    public function profile()
    {
        helper('number');
        $username = session()->get('username');
        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail
                    ->select('transaction_detail.*, product.nama, product.harga, product.foto')
                    ->join('product', 'transaction_detail.product_id=product.id')
                    ->where('transaction_id', $item['id'])
                    ->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_profile', $data);
    }

        public function getDashboard()
    {
        return view('v_dashboard'); 
    }
    

    public function postKeranjang()
    {
        $cart = \Config\Services::cart();

        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $harga = $this->request->getPost('harga');
        $foto = $this->request->getPost('foto');

        $diskon = session()->get('diskon') ?? 0;
        $harga_diskon = $harga - $diskon;

        $cart->insert([
            'id'    => $id,
            'qty'   => 1,
            'price' => $harga_diskon,
            'name'  => $nama,
            'options' => [
                'foto' => $foto
            ]
        ]);

        return redirect()->to('/keranjang');
    }
       
}

