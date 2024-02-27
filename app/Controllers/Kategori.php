<?php

namespace App\Controllers;

use App\Models\Modelkategori;

class Kategori extends BaseController
{
    public function index()
    {
        $data = [
            'listKategori' => $this->kategori->findAll()
        ];
        return view('kategori/data_kategori', $data);
    }

    public function tambahKategori()
    {
        return view('kategori/tambah-kategori');
    }

    public function simpanKategori()
    {
    helper(['form']);
    $validation = \Config\Services::validation();

    $rules = [
        'katnama' => 'required|is_unique[kategori.katnama]',
    ];

    $messages = [
        'katnama' => [
            'required' => 'Tidak boleh kosong!',
            'is_unique' => 'nama kategori sudah ada!',
        ],
    ];

    // set validasi
    $validation->setRules($rules, $messages);

    // cek validasi gagal
    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $data = [
        'katnama' => $this->request->getPost('katnama')
    ];

    $this->kategori->insert($data);

    session()->setFlashdata('pesan', 'data berhasil di tambahkan!!');
    return redirect()->to('/list-kategori');
}

    public function editKategori($katid)
    {
        $syarat = [
            'katid' => $katid
        ];
        $data = [
            'introText' => '<p>Berikut adalah data pengguna,silahkan tambahkan data baru pada halaman ini</p>',
            'judulHalaman' => 'Data Kategori',
            'listKategori' => $this->kategori->where($syarat)->findAll()
        ];

        return view('kategori/edit-kategori', $data);
    }

    public function updateKategori()
    {

        $id = $this->request->getVar('katid'); 

        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'katnama' => 'required|is_unique[kategori.katnama,katid,'. $id .']',
        ];

        $messages = [
            'katnama' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'nama kategori sudah ada!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'katid' => $this->request->getVar('katid'),
            'katnama' => $this->request->getVar('katnama'),
        ];
        $this->kategori->update($this->request->getVar('katid'), $data);
        session()->setFlashdata('pesan', 'data berhasil di edit!!');
        return redirect()->to('/list-kategori');
    }



    public function hapusKategori($id)
    {
        $this->kategori->delete($id);
        session()->setFlashdata('pesan', 'data berhasil di hapus!!');

        return redirect()->to('/list-kategori');
    }
}
