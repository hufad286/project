<?= $this->extend('layout/menu'); ?>
<?= $this->section('judul'); ?>


<h3> data penjualan</h3>

<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<div class="card card-default color-palette-box">
    <div class="card-header">
        <div class="row">
            <div class="col-md-1">
                <h3 class="card-title">
                    <button type="button" class="btn btn-warning btn-sm" onclick="window.location='<?= site_url('dashboard') ?>'">&laquo; Kembali</button>
                </h3>
            </div>
            <div class="col-md-5">
                <Span>tanggal</Span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="<?= site_url('transaksi-penjualan') ?>" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nofaktur">Faktur</label>
                        <input type="text" class="form-control" style="color:red;font-weight:bold;" name="no_faktur" id="nofaktur" readonly value="<?= $no_transaksi; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" readonly value="<?= date('Y-m-d'); ?>">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kodebarcode">Produk</label>
                        <select class="js-example-basic-single form-control" name="id_produk">
                            <?php if (isset($produkList)) :
                                foreach ($produkList as $row) : ?>
                                    <option value="<?= $row['idProduk']; ?>"><?= $row['nama_produk']; ?> | <?= $row['stok']; ?> | <?= number_format($row['harga_jual'], 0, ',', '.'); ?></option>

                            <?php
                                endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jml">Jumlah</label>
                        <input type="text" class="form-control" name="qty" id="jumlah">
                    </div>
                </div>
            </div>
            <button class="btn btn-success" type="submit" id="btnSimpanTransaksi">
                <i class="fa fa-save"></i> Simpan
            </button>&nbsp;
        </form>
    </div>
</div>

<div class="row">
    <div class="col">

        <table class="table table-sm table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($detailPenjualan) && !empty($detailPenjualan)) :
                    $no = 1;
                    foreach ($detailPenjualan as $detail) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $detail['nama_produk']; ?></td>
                            <td><?= $detail['qty']; ?></td>
                            <td><?= number_format($detail['total_harga'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="4">Tidak ada produk</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>





<div class="col">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">TOTAL : RP <?= number_format($total_harga, 0, ',', '.'); ?></h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">BAYAR</label>
                <input type="text" name="txtbayar" class="form-control" id="txtbayar">
            </div>
            <div class="mb-3">
                <label class="form-label">KEMBALI</label>
                <input type="text" name="kembali" class="form-control" id="kembali" readonly>
            </div>
            <div class="card-footer text-end">
                <a href="<?= site_url('pembayaran') ?>" class="btn btn-success"">
                    BAYAR
                </a>

            </div>
        </div>
    </div>
</div>


</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen-elemen yang diperlukan
        var txtBayar = document.getElementById('txtbayar');
        var kembali = document.getElementById('kembali');
        var total_harga = <?= $total_harga ?>; // Ambil total harga dari controller dan diteruskan ke view

        // Tambahkan event listener untuk memantau perubahan pada input bayar
        txtBayar.addEventListener('input', function() {
            // Ambil nilai yang dibayarkan
            var bayar = parseFloat(txtBayar.value);

            // Hitung kembaliannya
            var kembalian = bayar - total_harga;

            // Tampilkan kembaliannya pada input kembali
            if (kembalian >= 0) {
                kembali.value = kembalian.toFixed(2).replace(/(\.00)+$/, ''); // Menampilkan hingga 2 digit desimal
            } else {
                kembali.value = '0'; // Jika kembalian negatif, tampilkan '0.00'
            }
        });
    });
</script>

<?= $this->endSection(); ?>