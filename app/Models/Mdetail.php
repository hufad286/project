<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdetail extends Model
{
    protected $table            = 'detail_penjualan';
    protected $primaryKey       = 'id_detail';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_detail', 'id_penjualan', 'idProduk', 'qty', 'total_harga'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDetailPenjualan($idPenjualan)
    {
        return $this->db->table('detail_penjualan')
            ->select('detail_penjualan.*, penjualan.no_faktur,produk.nama_produk')
            ->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan')
            ->join('produk', 'produk.idProduk = detail_penjualan.idProduk')
            ->where('detail_penjualan.id_penjualan', $idPenjualan)
            ->get()
            ->getResultArray();
    }
}
