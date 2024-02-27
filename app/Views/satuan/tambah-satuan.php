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
<div class="card">

  <!-- form start -->
  <form action="<?= site_url('simpan-satuan'); ?>" method="POST">
    <div class="card-body">
      <div class="form-group row">
        <label for="satuan" class="col-sm-7 col-form-label">Nama Satuan</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="satuan" name="satnama" placeholder="Masukan Nama Satuan">
        </div>
      </div>
      <button type="submit" class="btn btn-info">Simpan</button>
    </div>
    <!-- /.card-body -->
  </form>
</div>
<!-- /.card-footer -->
<!-- /.card -->

<?= $this->endSection(); ?>