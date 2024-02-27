<?php

namespace App\Controllers;

use App\Models\Modelpenjualan;

class Penjualan extends BaseController
{
    public function index()
    {
        $no_transaksi = $this->penjualan->generateTransactionNumber();


        $data = [
            'no_transaksi' => $no_transaksi,
            'produkList' => $this->produk->getAllProduk(),
            'detailPenjualan' => $this->detail->getDetailPenjualan(session()->get('IdPenjualan')),
            'total_harga' => $this->penjualan->getTotalHargaById(session()->get('IdPenjualan')),
        ];
        return view('penjualan/data_penjualan', $data);
    }

    public function simpanPenjualan()
    {
        // ambil detail barang yang dijual
        $where = ['idProduk' => $this->request->getPost('id_produk')];
        $cekBarang = $this->produk->where($where)->findAll();
        $hargaJual = $cekBarang[0]['harga_jual'];

        if (session()->get('IdPenjualan') == null) {
            // 1. Menyiapkan data penjualan
            date_default_timezone_set('Asia/Jakarta');
            // Mendapatkan waktu saat ini dalam zona waktu yang telah diatur
            $tanggal_sekarang = date('Y-m-d H:i:s');

            $dataPenjualan = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tgl_penjualan' => $tanggal_sekarang, // Perbaiki format tanggal
                'idUser' => session()->get('idUser'),
                'total' => 0
                // NOTE SAMAIN TABEL PENJUALAN YA
            ];
            // var_dump($dataPenjualan);
            // 2. Menyimpan data ke dalam tabel penjualan
            $this->penjualan->insert($dataPenjualan);

            // 3. Menyiapkan data untuk menyimpan detail penjualan
            $idPenjualanBaru = $this->penjualan->insertID(); // Mendapatkan ID penjualan baru
            $dataDetailPenjualan = [
                'id_penjualan' => $idPenjualanBaru,
                'idProduk' => $this->request->getPost('id_produk'),
                'qty' => $this->request->getPost('qty'),
                'total_harga' => $hargaJual * $this->request->getPost('qty')
            ];
            // NOTE SAMAIN KAYA DETAIL PENJUALAN
            // 4. Menyimpan data ke dalam tabel detail penjualan
            // var_dump($dataDetailPenjualan);
            $this->detail->insert($dataDetailPenjualan);

            // 5. Membuat session untuk penjualan baru
            session()->set('IdPenjualan', $idPenjualanBaru);
        } else {
            // Jika ada ID penjualan yang sudah tersimpan di sesi, gunakan ID itu untuk menyimpan detail penjualan
            $idPenjualanSaatIni = session()->get('IdPenjualan');
            $dataDetailPenjualan = [
                'id_penjualan' => $idPenjualanSaatIni,
                'idProduk' => $this->request->getPost('id_produk'),
                'qty' => $this->request->getPost('qty'),
                'total_harga' => $hargaJual * $this->request->getPost('qty')
            ];

            // Simpan data ke dalam tabel detail penjualan
            $this->detail->insert($dataDetailPenjualan);
            // var_dump($dataDetailPenjualan);
        }

        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('transaksi-penjualan');
    }
    public function simpanPembayaran()
    {
        // Mendapatkan ID penjualan yang selesai
        $idPenjualanSelesai = session()->get('IdPenjualan');

        // Menghapus ID penjualan dari sesi
        session()->remove('IdPenjualan');

        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('transaksi-penjualan');
    }
}
