<?php

namespace App\Controllers;

use App\Models\Modelpengguna;

class Pengguna extends BaseController
{
    public function index()
    {
        $data = [
            'listPengguna' => $this->pengguna->findAll()
        ];
        return view('pengguna/data_pengguna', $data);
    }

    public function tambahPengguna()
    {
        $data = [
            'listlevel' => $this->pengguna->findAll(),
        ];
        return view('pengguna/tambah-pengguna', $data);
    }
    public function simpanPengguna()
    {

        
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'Nama_User' => 'required',
            'username' => 'required|is_unique[user.username]',
            'Password' => 'required',
            'Level' => 'required',
        ];

        $messages = [
            'Nama_User' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'username' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'username sudah ada silahkan gunakan yang lain',
            ],
            'Password' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'Level' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'Nama_User' => $this->request->getVar('Nama_User'),
            'username' => $this->request->getVar('username'),
            'Password' => md5($this->request->getVar('Password')),
            'Level' => $this->request->getVar('Level'),
            
        ];
        $this->pengguna->save($data);
        session()->setFlashdata('pesan', 'data berhasil di tambahkan!!');
        return redirect()->to('/list-pengguna');
    }

    public function editPengguna($idUser){
        $syarat=[
            'idUser'=>$idUser
        ];
        $data=[
            'introText'=>'<p>Berikut adalah data pengguna,silahkan tambahkan data baru pada halaman ini</p>',
            'judulHalaman'=> 'Data Pengguna',
            'listPengguna'=> $this->pengguna->where($syarat)->findAll()
        ];
        return view('pengguna/edit-pengguna',$data);
    }
    
        public function updatePengguna(){
            $data=[
                    'idUser'=>$this->request->getVar('idUser'),
                    'Nama_User'=>$this->request->getVar('Nama_User'),
                    'username'=>$this->request->getVar('username'),
                    'Level'=>$this->request->getVar('Level'),
                   
            ];
            $this->pengguna->update($this->request->getVar('idUser'), $data);
            session()->setFlashdata('pesan', 'data berhasil di edit!!');
            return redirect()->to('/list-pengguna');
        }

    public function hapusPengguna($id)
    {
        $this->pengguna->delete($id);
        session()->setFlashdata('pesan', 'data berhasil di hapus!!');

        return redirect()->to('/list-pengguna');
    }
}