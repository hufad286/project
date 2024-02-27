<?= $this->extend('layout/menu'); ?>
<?= $this->section('judul'); ?>

<?= $this->endSection(); ?>

<?= $this->section('isi'); ?>

<!-- Horizontal Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-info ">

            <!-- form start -->
            <form action="<?= site_url('update-produk/') . $listProduk[0]['idProduk']; ?>" method="POST">

                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-7 col-form-label">Edit Produk</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="inputJenis" name="idProduk" value="<?= $listProduk[0]['idProduk']; ?>">

                            <div class="form-group">
                                <label for="kode_produk"> Kode Produk</label>
                                <input type="text" class="form-control" id="kode_produk" placeholder="Masukan kode produk" value="<?= $listProduk[0]['kode_produk']; ?>" name="kode_produk" readonly>

                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk </label>
                                    <input type="text" class="form-control" id="nama_produk" placeholder="Masukan nama produk" value="<?= $listProduk[0]['nama_produk']; ?>" name="nama_produk">
                                </div>

                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="text" class="form-control" id="harga_beli" placeholder="Masukan Harga Beli" value="<?= $listProduk[0]['harga_beli']; ?>" name="harga_beli">
                                </div>

                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual </label>
                                    <input type="text" class="form-control" id="harga_jual" placeholder="Masukan Harga Jual" value="<?= $listProduk[0]['harga_jual']; ?>" name="harga_jual">
                                </div>

                               

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-7 col-form-label">Nama Satuan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputJenis" name="satid">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($listSatuan as $value) : ?>
                                                <option value="<?= $value['satid']; ?>" <?= ($listProduk[0]['satid'] == $value['satid']) ? 'selected' : ''; ?>><?= $value['satnama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-7 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputJenis" name="katid">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($listKategori as $value) : ?>
                                                <option value="<?= $value['katid']; ?>" <?= ($listProduk[0]['katid'] == $value['katid']) ? 'selected' : ''; ?>><?= $value['katnama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok </label>
                                    <input type="text" class="form-control" id="stok" placeholder="Masukan Stok " value="<?= $listProduk[0]['stok']; ?>" name="stok">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
            </form>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>