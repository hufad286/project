<?php

use App\Controllers\Layout;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Login
$routes->get('/', 'Login::login');
$routes->post('/proses-login', 'Login::prosesLogin');
$routes->get('logout', 'Login::logout');


// Dashboard
$routes->get('/dashboard', 'Layout::index', ['filter' => 'otentifikasi']);


//pengguna
$routes->get('/list-pengguna', 'Pengguna::index');
$routes->get('/tambah-pengguna', 'Pengguna::tambahPengguna');
$routes->post('/simpan-pengguna', 'Pengguna::simpanPengguna');
$routes->get('hapus-pengguna/(:num)', 'Pengguna::hapusPengguna/$1');
$routes->get('edit-pengguna/(:num)', 'Pengguna::editPengguna/$1');
$routes->post('update-pengguna', 'Pengguna::updatePengguna');


// Kategori
$routes->get('/list-kategori', 'Kategori::index');
$routes->get('/tambah-kategori', 'Kategori::tambahKategori');
$routes->post('simpan-kategori', 'Kategori::simpanKategori');
$routes->get('hapus-kategori/(:num)', 'Kategori::hapusKategori/$1');
$routes->get('edit-kategori/(:num)', 'Kategori::editKategori/$1');
$routes->post('update-kategori', 'Kategori::updateKategori');

// Satuan
$routes->get('/list-satuan', 'Satuan::index');
$routes->get('/tambah-satuan', 'Satuan::tambahSatuan');
$routes->post('simpan-satuan', 'Satuan::simpanSatuan');
$routes->get('hapus-satuan/(:num)', 'Satuan::hapusSatuan/$1');
$routes->get('edit-satuan/(:num)', 'Satuan::editSatuan/$1');
$routes->post('update-satuan', 'Satuan::updateSatuan');

// Produk
$routes->get('/list-produk', 'Produk::index');
$routes->get('/tambah-produk', 'Produk::tambahProduk');
$routes->post('simpan-produk', 'Produk::simpanProduk');
$routes->get('hapus-produk/(:num)', 'Produk::hapusProduk/$1');
$routes->get('edit-produk/(:num)', 'Produk::editProduk/$1');
$routes->post('update-produk/(:num)', 'Produk::updateProduk/$1');

//penjualan
$routes->get('/list-penjualan', 'Penjualan::index');

//laporan
$routes->get('/list-laporan', 'Laporan::index');
$routes->get('/listLaporan', 'Laporan::tampilLaporan');
//view pdf
$routes->get('/pdf_view', 'PdfController::index');
$routes->get('/pdf/generate', 'PdfController::generate');

// penjualan
$routes->get('/transaksi-penjualan', 'Penjualan::index');
$routes->post('/transaksi-penjualan', 'Penjualan::simpanPenjualan');
$routes->get('/pembayaran', 'Penjualan::simpanPembayaran',);
