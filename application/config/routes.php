<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Default routes
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';

// Dashboard routes
$route['dashboard'] = 'dashboard/index';
$route['dashboard/profil'] = 'dashboard/profil';
$route['dashboard/update_profil'] = 'dashboard/update_profil';

// Acara routes
$route['acara'] = 'acara/index';
$route['acara/tambah'] = 'acara/tambah';
$route['acara/simpan'] = 'acara/simpan';
$route['acara/edit/(:num)'] = 'acara/edit/$1';
$route['acara/update/(:num)'] = 'acara/update/$1';
$route['acara/hapus/(:num)'] = 'acara/hapus/$1';

// Pengurus routes
$route['pengurus'] = 'pengurus/index';
$route['pengurus/tambah'] = 'pengurus/tambah';
$route['pengurus/simpan'] = 'pengurus/simpan';
$route['pengurus/edit/(:num)'] = 'pengurus/edit/$1';
$route['pengurus/update/(:num)'] = 'pengurus/update/$1';
$route['pengurus/hapus/(:num)'] = 'pengurus/hapus/$1';

// Artikel routes
$route['artikel'] = 'artikel/index';
$route['artikel/tambah'] = 'artikel/tambah';
$route['artikel/simpan'] = 'artikel/simpan';
$route['artikel/edit/(:num)'] = 'artikel/edit/$1';
$route['artikel/update/(:num)'] = 'artikel/update/$1';
$route['artikel/hapus/(:num)'] = 'artikel/hapus/$1';
$route['artikel/publikasi/(:num)'] = 'artikel/publikasi/$1';

// Pemasukan routes
$route['pemasukan'] = 'pemasukan/index';
$route['pemasukan/tambah'] = 'pemasukan/tambah';
$route['pemasukan/simpan'] = 'pemasukan/simpan';
$route['pemasukan/edit/(:num)'] = 'pemasukan/edit/$1';
$route['pemasukan/update/(:num)'] = 'pemasukan/update/$1';
$route['pemasukan/hapus/(:num)'] = 'pemasukan/hapus/$1';

// Pengeluaran routes
$route['pengeluaran'] = 'pengeluaran/index';
$route['pengeluaran/tambah'] = 'pengeluaran/tambah';
$route['pengeluaran/simpan'] = 'pengeluaran/simpan';
$route['pengeluaran/edit/(:num)'] = 'pengeluaran/edit/$1';
$route['pengeluaran/update/(:num)'] = 'pengeluaran/update/$1';
$route['pengeluaran/hapus/(:num)'] = 'pengeluaran/hapus/$1';

// Laporan routes
$route['laporan'] = 'laporan/index';
$route['laporan/pemasukan'] = 'laporan/pemasukan';
$route['laporan/pengeluaran'] = 'laporan/pengeluaran';
$route['laporan/keuangan'] = 'laporan/keuangan';
$route['laporan/cetak_pemasukan'] = 'laporan/cetak_pemasukan';
$route['laporan/cetak_pengeluaran'] = 'laporan/cetak_pengeluaran';
$route['laporan/cetak_keuangan'] = 'laporan/cetak_keuangan';