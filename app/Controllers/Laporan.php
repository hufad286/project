<?php

namespace App\Controllers;

use App\Models\Mproduk;

class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'listProduk' => $this->produk->getLaporanProduk()
        ];
        return view('laporan/data-laporan',$data);
    }

}
