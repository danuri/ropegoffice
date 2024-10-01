<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('auth', 'Auth::login');
 $routes->get('auth/login', 'Auth::login');
 $routes->get('auth/logout', 'Auth::logout');
 $routes->get('auth/callback', 'Auth::callback');

 $routes->get('/', 'Home::index');
 $routes->get('home', 'Home::index');
 $routes->get('dashboard', 'Dashboard::index',["filter" => "auth"]);

 $routes->group("ajax", ["filter" => "auth"], function ($routes) {
     $routes->get('searchpegawai/(:num)', 'Ajax::getPegawai/$1');
 });

 $routes->group("surat", ["filter" => "auth"], function ($routes) {
     $routes->get('surat_masuk', 'Surat\SuratMasuk::index');
     $routes->get('surat_masuk/getdata', 'Surat\SuratMasuk::getData');
     $routes->get('surat_masuk/detail/(:num)', 'Surat\SuratMasuk::detail/$1');
     $routes->post('surat_masuk/save', 'Surat\SuratMasuk::save');
     $routes->get('agenda_keluar', 'Surat\AgendaKeluar::index');
     $routes->get('agenda_keluar/getdata', 'Surat\AgendaKeluar::getData');
     $routes->post('agenda_keluar/add', 'Surat\AgendaKeluar::add');
 });

 $routes->group("aset", ["filter" => "auth"], function ($routes) {

   $routes->get('/', 'Aset\Dashboard::index');
   $routes->get('dashboard', 'Aset\Dashboard::index');
   $routes->get('data', 'Aset\Home::index');
   $routes->get('getaset', 'Aset\Home::getAset');
   $routes->post('save', 'Aset\Home::asetSave');
   $routes->get('kategori', 'Aset\Home::kategori');
   $routes->get('getkategori', 'Aset\Home::getKategori');
   $routes->post('kategori/save', 'Aset\Home::kategoriSave');
   $routes->get('kategori/edit', 'Aset\Home::kategoriEdit');
   $routes->get('kategori/delete/(:num)', 'Aset\Home::kategoriDelete/$1');

   $routes->group("distribusi", function ($routes) {
       $routes->get('/', 'Aset\Distribusi::index');
       $routes->get('getaset', 'Aset\Distribusi::getDistribusi');
       $routes->post('save', 'Aset\Distribusi::save');
   });
 });
