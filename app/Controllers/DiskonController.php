<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    // Menampilkan semua diskon
    public function index()
    {
        $data['diskon'] = $this->diskonModel->orderBy('tanggal', 'DESC')->findAll();
        return view('diskon/index', $data);
    }

    // Tampilkan form create (opsional kalau pakai modal bisa diabaikan)
    public function create()
    {
        return view('diskon/create');
    }

    // Simpan data diskon baru
    public function store()
    {
        $rules = [
            'tanggal' => 'required|is_unique[diskon.tanggal]',
            'nominal' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/diskon')->withInput()->with('error', 'Diskon gagal ditambahkan! Tanggal sudah digunakan atau data tidak valid.');
        }

        $this->diskonModel->save([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $diskon = $this->diskonModel->find($id);
        if (!$diskon) {
            return redirect()->to('/diskon')->with('error', 'Data tidak ditemukan.');
        }

        return view('diskon/edit', ['diskon' => $diskon]);
    }

    // Update data diskon
    public function update($id)
    {
        $rules = ['nominal' => 'required|numeric'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nominal tidak valid.');
        }

        $this->diskonModel->update($id, [
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diperbarui!');
    }

    // Hapus diskon
    public function delete($id)
    {
        $this->diskonModel->delete($id);
        return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus!');
    }
}
