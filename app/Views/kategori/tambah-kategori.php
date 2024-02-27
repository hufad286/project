<?= $this->extend('layout/menu'); ?>
<?= $this->section('judul'); ?>

<?= $this->endSection(); ?>

<?= $this->section('isi'); ?>

<?php if (session()->has('errors')) : ?>
  <div class="alert alert-danger" role="alert">
    <?php foreach (session('errors') as $error) : ?>
      <ul>
        <li><?= $error; ?></li>
      </ul>
    <?php endforeach; ?>
  </div>

<?php endif; ?>


<!-- Horizontal Form -->
<div class="row">
  <div class="col-lg-12">
    <div class="card card-info ">

      <!-- form start -->
      <form action="<?= site_url('simpan-kategori'); ?>" method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-7 col-form-label">Nama Kategori</label>
            <div class="col-sm-10">
              <input type="hidden" class="form-control" id="inputJenis" name="id_kategori">
              <input type="text" class="form-control" id="inputJenis" name="katnama" required name="kategori" placeholder="Masukan Nama Kategori">
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