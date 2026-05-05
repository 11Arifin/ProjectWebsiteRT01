<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Berita routes
$route['berita'] = 'berita/index';
$route['berita/(:any)'] = 'berita/detail/$1';

// Agenda routes
$route['agenda'] = 'agenda/index';
$route['agenda/(:num)'] = 'agenda/detail/$1';

// Admin routes
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/berita'] = 'admin/berita';
$route['admin/berita/tambah'] = 'admin/tambah_berita';
$route['admin/berita/simpan'] = 'admin/simpan_berita';
$route['admin/berita/edit/(:num)'] = 'admin/edit_berita/$1';
$route['admin/berita/update/(:num)'] = 'admin/update_berita/$1';
$route['admin/berita/hapus/(:num)'] = 'admin/hapus_berita/$1';
$route['admin/agenda'] = 'admin/agenda';
$route['admin/agenda/tambah'] = 'admin/tambah_agenda';
$route['admin/agenda/simpan'] = 'admin/simpan_agenda';
$route['admin/agenda/edit/(:num)'] = 'admin/edit_agenda/$1';
$route['admin/agenda/update/(:num)'] = 'admin/update_agenda/$1';
$route['admin/agenda/hapus/(:num)'] = 'admin/hapus_agenda/$1';
