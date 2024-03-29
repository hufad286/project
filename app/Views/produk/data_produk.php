<?= $this->extend('layout/menu'); ?>

<?= $this->section('judul'); ?>
<h3>Manajemen data produk</h3>

<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<?php

use Kint\Zval\Value;

if (session()->getFlashdata('pesan')) {
  echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>';
  echo session()->getFlashdata('pesan');
  echo '</h5></div>';
}
?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      <p><a href="<?= site_url('tambah-produk'); ?>" class="btn btn-primary ">
          Tambah</a></p>
    </h3>
  </div>
  <div class="card-body">
    <!--
    <form method="POST" action="/produk/index">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari Namaproduk" aria-label="Cari Namaproduk" aria-describedby="tombolproduk">
        <button class="btn btn-primary" type="Submit" id="tombolproduk">Cari</button>
      </div>
    </form>
-->
    <table class="table table-sm table-striped ">
      <thead>
        <tr>
          <th>No</th>
          <th>kode produk</th>
          <th>nama produk</th>
          <th>harga beli</th>
          <th>harga jual</th>

          <th>kategori produk</th>
          <th>satuan produk</th>
          <th>stok</th>
          <th>aksi</th>
        </tr>
      </thead>
      <tbody>

        <?php
        if (isset($listProduk)) {
          $no = null;
          foreach ($listProduk as $baris) {
            $no++
        ?>

            <tr>
              <td><?= $no; ?></td>
              <td><?= $baris['kode_produk']; ?></td>
              <td><?= $baris['nama_produk']; ?></td>
              <td><?= $baris['harga_beli']; ?></td>
              <td><?= $baris['harga_jual']; ?></td>
              <td><?= $baris['katnama']; ?></td>
              <td><?= $baris['satnama']; ?></td>
              <td><?= $baris['stok']; ?></td>

              <td>
                <a href="<?= site_url('hapus-produk/') . $baris['idProduk']; ?>" class="fas fa-trash" style="color: #0033ff;"></a>
                <a href="<?= site_url('edit-produk/') . $baris['idProduk']; ?>" class="fas fa-edit" style="color: #0033ff;"></a>
              </td>

          <?php
          }
        }
          ?>

            </tr>

      </tbody>
    </table>

  </div>
</div>


<?= $this->endSection(); ?>