<?php

namespace App\Controllers;

use App\Models\Modelsatuan;

class Satuan extends BaseController
{
    public function index()
    {
        $data = [
            'listSatuan' => $this->satuan->findAll()
        ];
        return view('satuan/data_satuan', $data);
    }

    public function tambahSatuan()
    {
        return view('satuan/tambah-satuan');
    }

    public function simpanSatuan()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'satnama' => 'required|is_unique[satuan.satnama]',
        ];

        $messages = [
            'satnama' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'nama satuan sudah ada!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'satnama' => $this->request->getPost('satnama')
        ];

        $this->satuan->insert($data);

        session()->setFlashdata('pesan', 'data berhasil di tambahkan!!');
        return redirect()->to('/list-satuan');
    }

    public function editSatuan($satid)
    {
        $syarat = [
            'satid' => $satid
        ];
        $data = [
            'introText' => '<p>Berikut adalah data pengguna,silahkan tambahkan data baru pada halaman ini</p>',
            'judulHalaman' => 'Data Satuan',
            'listSatuan' => $this->satuan->where($syarat)->findAll()
        ];
        return view('satuan/edit-satuan', $data);
    }

    public function updateSatuan()
    {
        $id = $this->request->getVar('satid'); 

        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'satnama' => 'required|is_unique[satuan.satnama,satid,'. $id .']',
        ];

        $messages = [
            'satnama' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'nama satuan sudah ada!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'satnama' => $this->request->getVar('satnama'),
        ];

        $this->satuan->update($id, $data);
        session()->setFlashdata('pesan', 'data berhasil di edit!!');
        return redirect()->to('/list-satuan');
    }

    public function hapusSatuan($id)
    {
        $this->satuan->delete($id);
        session()->setFlashdata('pesan', 'data berhasil di hapus!!');
        return redirect()->to('/list-satuan');
    }
}
