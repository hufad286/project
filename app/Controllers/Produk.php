<?php

namespace App\Controllers;

use App\Models\Modelproduk;

class Produk extends BaseController
{
    public function index()
    {
        $data = [
            'listProduk' => $this->produk->getAllproduk(),
        ];
        return view('produk/data_produk', $data);
    }

    public function tambahProduk()
    {
        $data = [
            'listKategori' => $this->kategori->findAll(),
            'listSatuan' => $this->satuan->findAll(),
            'kode_produk' => $this->produk->generateProductCode()
        ];
        return view('produk/tambah-produk', $data);
    }

    public function simpanProduk()
    {

        $validation = \Config\Services::validation();
        $validation->setRule('nama_produk', 'Nama Produk', 'required|is_unique[produk.nama_produk]', [
            'is_unique' => '{field} sudah di gunakan',
        ]);

        $datavalid = [
            'nama_produk' => $this->request->getPost('nama_produk'),
        ];
        if (!$validation->run($datavalid)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }


        $data = [
            'kode_produk' => $this->produk->generateProductCode(),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_beli' => str_replace('.', '', $this->request->getPost('harga_beli')),
            'harga_jual' => str_replace('.', '', $this->request->getPost('harga_jual')),
            'katid' => $this->request->getPost('katid'),
            'satid' => $this->request->getPost('satid'),
            'stok' => $this->request->getPost('stok'),
        ];
        $this->produk->insert($data);
        session()->setFlashdata('pesan', 'data berhasil di tambahkan!!');
        return redirect()->to('/list-produk');
    }

    public function editProduk($idProduk)
    {
        $syarat = [
            'idProduk' => $idProduk
        ];
        $data = [
            'introText' => '<p>Berikut adalah data produk,silahkan tambahkan data baru pada halaman ini</p>',
            'judulHalaman' => 'Data Produk',
            'listProduk' => $this->produk->where($syarat)->findAll(),
            'listKategori' => $this->kategori->findAll(),
            'listSatuan' => $this->satuan->findAll(),
        ];
        return view('produk/edit-produk', $data);
    }

    public function updateProduk($idProduk)
    {
        $data =
            [
                'kode_produk' => $this->request->getPost('kode_produk'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'katid' => $this->request->getPost('katid'),
                'satid' => $this->request->getPost('satid'),
                'stok' => $this->request->getPost('stok'),
            ];

        // var_dump($data);
        $this->produk->update($idProduk, $data);
        session()->setFlashdata('pesan', 'data berhasil di edit!!');
        return redirect()->to('/list-produk');
    }

    public function hapusProduk($id)
    {
        $this->produk->delete($id);

        return redirect()->to('/list-produk');
    }
}
