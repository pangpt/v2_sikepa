<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$controller_path = 'App\Http\Controllers';


// Main Page Route
Route::get('/login', $controller_path.'\authentications\LoginBasic@index')->name('loginpage')->middleware('guest');
Route::post('/login', $controller_path.'\authentications\LoginBasic@login')->name('proseslogin');
Route::post('/logout', $controller_path.'\authentications\LoginBasic@logout')->name('logout');
Route::get('/view/izin-cuti/{sign_permohonan}', $controller_path.'\izin_cuti\CutiController@viewCuti')->name('view-izin-cuti');


Route::group(['middleware' => 'App\Http\Middleware\CekLogin'], function () {
  // Route yang memerlukan otentikasi
  // layout
  $controller_path = 'App\Http\Controllers';

Route::get('/', $controller_path . '\dashboard\Welcome@index')->name('welcome');
Route::get('/dashboard', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

Route::get('/profil-pegawai/permohonan-cuti', $controller_path . '\pages\AccountSettingsNotifications@index')->name('profil-pegawai-permohonan-cuti');
Route::get('/profil-pegawai/kepangkatan', $controller_path . '\pages\AccountSettingsConnections@index')->name('profil-pegawai-kepangkatan');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');


Route::get('/profil-hakim-pegawai/pns', $controller_path . '\employee\EmployeeController@index')->name('profil-hakim-pegawai-pns');
Route::get('/profil-hakim-pegawai/create', $controller_path .'\employee\EmployeeController@create')->name('profil-hakim-pegawai-create');
Route::post('/profil-hakim-pegawai/addPegawai', $controller_path .'\employee\EmployeeController@addPegawai')->name('profil-hakim-pegawai-addPegawai');
Route::get('/profil-pegawai/pns/detail/{nip}', $controller_path . '\employee\EmployeeController@detail')->name('profil-pegawai-detail');
Route::post('/profil-pegawai/pns/editpegawai/{nip}', $controller_path . '\employee\EmployeeController@editpegawai')->name('profil-pegawai-update');

Route::get('/profil-pegawai/pns/detail', $controller_path . '\employee\EmployeeController@profile')->name('profil-pegawai-profile');
Route::post('/profil-pegawai/pns/updateCell', $controller_path . '\employee\EmployeeController@updateCell')->name('profil-pegawai-updateCell');

Route::get('/kalender-cuti', $controller_path. '\kalender\KalenderCutiController@index')->name('kalender-cuti');

ROute::get('/informasi-umum', $controller_path. '\informasi\InformasiController@index')->name('informasi-umum');
ROute::get('/informasi-umum/informasi', $controller_path. '\informasi\InformasiController@informasiCreate')->name('informasi-create-page');
Route::post('/informasi-umum/informasi/create', $controller_path. '\informasi\InformasiController@store')->name('informasi-baru-create');
Route::get('/informasi-umum/informasi/edit/{id}', $controller_path. '\informasi\InformasiController@edit')->name('informasi-baru-edit');
Route::post('/informasi-umum/informasi/update/{id}', $controller_path. '\informasi\InformasiController@update')->name('informasi-baru-update');


Route::get('/pengaturan/akun', $controller_path . '\akun\AkunController@index')->name('pengaturan-akun-index');
Route::get('/datamaster/satker', $controller_path . '\pengaturan\SatkerController@index')->name('datamaster-satker-index');
Route::post('/datamaster/satker/create', $controller_path . '\pengaturan\SatkerController@create')->name('datamaster-satker-create');
Route::get('/datamaster/jabatan/', $controller_path . '\pengaturan\DatamasterController@jabatanIndex')->name('datamaster-jabatan-index');
Route::get('/datamaster/struktural/', $controller_path . '\pengaturan\DatamasterController@strukturalIndex')->name('datamaster-struktural-index');
Route::post('/datamaster/jabatan/create', $controller_path . '\pengaturan\DatamasterController@jabatanCreate')->name('datamaster-jabatan-create');
Route::post('/datamaster/struktural/create', $controller_path . '\pengaturan\DatamasterController@strukturalCreate')->name('datamaster-struktural-create');


// User Interface
Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/izin-cuti', $controller_path . '\izin_cuti\CutiController@index')->name('layanan-izin-cuti-index');
Route::get('/izin-cuti/approval', $controller_path . '\izin_cuti\CutiController@indexApproval')->name('izin-cuti-index-approval');
Route::get('/izin-cuti/verifikasi', $controller_path . '\izin_cuti\CutiController@indexVerifikasi')->name('izin-cuti-index-verifikasi');
Route::get('/izin-cuti/tambah', $controller_path . '\izin_cuti\CutiController@tambah')->name('izin-cuti-tambah');
Route::get('/izin-cuti/penangguhan', $controller_path . '\izin_cuti\CutiController@penangguhan')->name('izin-cuti-penangguhan');
Route::get('/izin-cuti/detail/{id}', $controller_path . '\izin_cuti\CutiController@detail')->name('izin-cuti-detail');
Route::post('/izin-cuti/add', $controller_path . '\izin_cuti\CutiController@addCuti')->name('izin-cuti-add');
Route::get('izin-cuti/updateYearly', $controller_path . '\izin_cuti\CutiController@updateLeaveYearly')->name('izin-cuti-yearly');
Route::post('/izin-cuti/approve', $controller_path . '\izin_cuti\CutiController@approve')->name('izin-cuti-approve');
Route::get('\izin-cuti\generate-cuti\{id}', $controller_path . '\izin_cuti\CutiController@generateCuti')->name('izin-cuti-generate');

Route::post('/change-user-role', $controller_path . '\layouts\HomeController@changeUserRole')->name('change-user-role');

Route::get('/layanan-pkp', $controller_path . '\pkp\KinerjaController@index')->name('layanan-pkp');
Route::post('/layanan-pkp/buat-pkp', $controller_path . '\pkp\KinerjaController@buatPKP')->name('buat-pkp');
Route::get('/layanan-pkp/pengajuan-indikator-pck', $controller_path . '\pkp\KinerjaController@indexIndikatorPCK')->name('pengajuan-indikator-pck');
Route::get('/layanan-pkp/pengajuan-indikator-pkp', $controller_path . '\pkp\KinerjaController@indexIndikatorPKP')->name('pengajuan-indikator-pkp');
Route::post('/layanan-pkp/tambah-indikator-pkp', $controller_path . '\pkp\KinerjaController@tambahIndikatorPKP')->name('tambah-indikator-pkp');
Route::post('/layanan-pkp/tambah-indikator-pck', $controller_path . '\pkp\KinerjaController@tambahIndikatorPCK')->name('tambah-indikator-pck');
Route::post('/layanan-pkp/tambah-pkp', $controller_path . '\pkp\KinerjaController@tambahPKP')->name('tambah-pkp');
Route::get('/layanan-pkp/penilaian-kinerja/{id}', $controller_path . '\pkp\KinerjaController@penilaian_kinerja')->name('penilaian-kinerja');
Route::get('/layanan-kp/sasaran-kegiatan/{id}', $controller_path . '\pkp\KinerjaController@sasaran_kegiatan')->name('sasaran-kegiatan');
Route::get('/layanan-pkp/capaian-kinerja/{id}', $controller_path . '\pkp\KinerjaController@capaian_kinerja')->name('capaian-kinerja');
Route::get('/layanan-pkp/capaian-kinerja-new/', $controller_path . '\pkp\KinerjaController@capaian_kinerja_new')->name('capaian-kinerja-new');
Route::post('/layanan-pkp/tambah-perjanjian-kinerja', $controller_path . '\pkp\KinerjaController@tambahPerjanjian')->name('tambah-perjanjian');
Route::post('layanan-pkp/simpan-capaian-kinerja', $controller_path . '\pkp\KinerjaController@simpan_capaian')->name('simpan-capaian');
Route::post('layanan-pkp/simpan-periode-capaian-kinerja', $controller_path . '\pkp\KinerjaController@simpan_periode_capaian')->name('simpan-periode-capaian');
Route::get('layanan-pkp/capaian-kinerja/detail/{id}', $controller_path . '\pkp\KinerjaController@detail_capaian_kinerja')->name('detail-capaian-kinerja');
Route::post('layanan-pkp/simpan-detail', $controller_path . '\pkp\KinerjaController@simpan_detail')->name('simpan-detail');

Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');

});


