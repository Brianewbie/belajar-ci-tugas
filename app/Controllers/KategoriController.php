<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriProduk; 
    function __construct()
    {
        $this->kategoriProduk = new KategoriModel();
    }

    public function index()
    {
        $kategoriProduk = $this->kategoriProduk->findAll();
        $data['kategori'] = $kategoriProduk;

        return view('v_kategori', $data);
    }
    public function create()
    {

    $dataForm = [
        'nama' => $this->request->getPost('nama'),
    ];
    if ($this->kategoriProduk->insert($dataForm)== false){
        return redirect()->back()->with('eror',$this->kategoriProduk->erors());
        }
        return redirect()->to('kategori')->with('success', 'Data Berhasil Ditambah');
    }
    public function edit($id)
    {
        {
        $dataForm = [
                'nama' => $this->request->getPost('nama'),
            ];
        if ($this->kategoriProduk->update($id,$dataForm)== false){
            return redirect()->back()->with('eror',$this->kategoriProduk->erors());
        }
            return redirect()->to('kategori')->with('success', 'Data Berhasil Ditambah');
        }
    }

    public function delete($id)
    {

        $this->kategoriProduk->delete($id);

        return redirect()->to('kategori')->with('success', 'Data Berhasil Dihapus');
        
    }

}
