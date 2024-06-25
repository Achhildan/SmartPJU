<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
//adddata location
use App\Http\Controllers\LocateController;
use App\Http\Controllers\AddpjuController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\LifetimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/locations/{id}/edit', [LocateController::class, 'edit'])->name('edit.location');
// Route::delete('/locations/{id}', [LocateController::class, 'destroy'])->name('delete.location');
Route::post('/store-location', [App\Http\Controllers\LocationController::class, 'store'])->name('store.location')->middleware('auth.custom');

//change data
Route::get('/locate', [LocateController::class, 'index'])->name('index.location')->middleware('auth.custom');
Route::get('/locate/{id}/edit', [LocateController::class, 'edit'])->name('edit.location')->middleware('auth.custom');
Route::put('/locate/{id}', [LocateController::class, 'update'])->name('update.location')->middleware('auth.custom');
Route::delete('/locate/{id}', [LocateController::class, 'destroy'])->name('delete.location')->middleware('auth.custom');

// Route::get('/markers', [LocationController::class, 'index'])->name('markers.index');

Route::get('/addpju', [AddpjuController::class, 'index'])->name('addpju.index')->middleware('auth.custom');
Route::post('/addpju', [AddpjuController::class, 'store'])->name('addpju.store')->middleware('auth.custom');
Route::get('/addpju/{id}/edit', [AddpjuController::class, 'edit'])->name('edit.addpju')->middleware('auth.custom');
Route::put('/addpju/{id}', [AddpjuController::class, 'update'])->name('update.addpju')->middleware('auth.custom');
Route::post('/store-addpju', [App\Http\Controllers\AddpjuUPController::class, 'store'])->name('store.addpju')->middleware('auth.custom');
Route::delete('/addpju/{id}', [AddpjuController::class, 'destroy'])->name('delete.addpju')->middleware('auth.custom');



// use App\Http\Controllers\PowerController;

// Route::get('/power', [PowerController::class, 'index'])->name('power.index');
// Route::post('/power/calculate', [PowerController::class, 'calculate'])->name('power.calculate');

// use App\Http\Controllers\PowerController;

// Route::get('/power', [PowerController::class, 'index'])->name('power.index');
// Route::post('/power/calculate', [PowerController::class, 'calculate'])->name('power.calculate');
// Route untuk menghitung dan menampilkan daya
// Route::post('/power/calculate', [PowerController::class, 'calculate'])->name('power.calculate');
// Route untuk menghitung dan menampilkan biaya

// Route untuk menampilkan halaman dengan default tabel total
Route::get('/power', [PowerController::class, 'index'])->name('power.index')->middleware('auth.custom');
// Route untuk menangani form submission dari dropdown
Route::post('/power', [PowerController::class, 'index'])->name('power.calculate')->middleware('auth.custom');
Route::get('/total', [PowerController::class, 'showTotal'])->name('showTotal')->middleware('auth.custom');

Route::get('/cost', [CostController::class, 'index'])->name('cost.index')->middleware('auth.custom');
Route::post('/cost/calculate', [CostController::class, 'index'])->name('cost.calculate')->middleware('auth.custom');

// Route::get('/dashboard', [PowerController::class, 'index'])->name('dashboard.index');
// Route::get('/cost', [PowerController::class, 'costIndex'])->name('cost.index');

Route::get('/tables', [TablesController::class, 'index'])->name('tables.index')->middleware('auth.custom');
Route::get('/pdf_creator', [TablesController::class, 'pdfCreator'])->name('pdf_creator'); // Tambahkan sesuai dengan kebutuhan
Route::get('/export_table', [TablesController::class, 'exportTable'])->name('export_table'); // Tambahkan sesuai dengan kebutuhan

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\DashboardController;

// // Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// // Route::post('/login', [AuthController::class, 'login']);
// // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/lifetime', [LifetimeController::class, 'index'])->name('lifetime.index')->middleware('auth.custom');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth.custom');

// Route::get('locatemaps', function (){
//     return view('locatemaps');
// });

// Route::get('/maps/xml', function () {
//     $markers = DB::table('pju')->get();

//     return response()->view('maps.xml', compact('markers'))->header('Content-Type', 'application/xml');
// });
Route::get('/locatemaps', [MapController::class, 'index']);

Route::get('/maps/xml',[MapController::class,'getUser'])->name('map.get.user');
Route::get('/maps/gateaway',[MapController::class,'getGateaway'])->name('map.get.gateaway');
Route::get('/tables/exportExcel', [TablesController::class, 'exportExcel'])->name('tables.exportExcel');



// Route::get('/', function (){
//     return view('/login');
// });

// use App\Http\Controllers\LocationController;
// use App\Models\DataplatformModel;
// use App\Models\Tabeldatamodif;

// Route::get('/locations', [LocationController::class, 'index'])->name('location.index');
// Route::get('/locations/create', [LocationController::class, 'create'])->name('location.create');
// Route::post('/locations', [LocationController::class, 'store'])->name('location.store');
// Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('location.edit');
// Route::put('/locations/{id}', [LocationController::class, 'update'])->name('location.update');
// Route::delete('/locations/{id}', [LocationController::class, 'destroy'])->name('location.destroy');


// Route::get('/', function () {
//     return view('tables');
// });

// Route::get('/buku', 'BukuController@bukutampil');

// Route::get('dashboard', function (){
//     return view('dashboard');
// });

// Route::get('power', function (){
//     return view('power');
// });

// Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Route::get('/fetch-and-convert', function () {
//     DataplatformModel::fetchDataFromApi();
//     Tabeldatamodif::convertAndSave();
//     return 'Data fetched from API and converted successfully.';
// });


// Route::get('index', function (){
//     return view('index');
// });

// Route::get('backend_db', function (){
//     return view('backend_db');
// });


// Route::get('locate', function (){
//     return view('locate');
// });

// use App\Http\Controllers\DashboardController;
// // Route::get('/locate', 'LocateController@index')->name('locate.index');
// // Route::get('/dashboard', 'DashboardController@showDashboard')->name('dashboard.showDashboard');
// Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');








// Route::get('/addpju', [AddpjuController::class, 'index'])->name('index.addpju');
// Route::put('/addpju/{id}', [AddpjuController::class, 'update'])->name('update.addpju');

// routes/web.php

// use App\Http\Controllers\LocateEditController;

// Route::get('/locateedit', [LocateEditController::class, 'datatampil'])->name('locateedit.datatampil');
// Route::post('/locateedit/tambah', [LocateEditController::class, 'locatetambah'])->name('locateedit.tambah');
// Route::delete('/locateedit/hapus/{id}', [LocateEditController::class, 'locatehapus'])->name('locateedit.hapus');
// Route::put('/locateedit/edit/{id}', [LocateEditController::class, 'locateedit'])->name('locateedit.edit');


// // Route untuk menampilkan halaman index
// Route::get('/locate', [LocateController::class, 'index'])->name('index.location');

// // Route untuk menampilkan form edit
// Route::get('/locate/{id}/edit', [LocateController::class, 'edit'])->name('edit.location');

// // Route untuk menyimpan perubahan pada data
// Route::put('/locate/{id}', [LocateController::class, 'update'])->name('update.location');

// // Route untuk menghapus data
// Route::delete('/locate/{id}', [LocateController::class, 'destroy'])->name('delete.location');



// Route::get('xml', function (){
//     return view('xml');
// });

// Route::get('tables', function (){
//     return view('tables');
// });

// Route::get('pdf_creator', function (){
//     return view('pdf_creator');
// });

// Route::get('tables2', function (){
//     return view('tables2');
// });

// Route::get('layoutdash', function (){
//     return view('layoutdash');
// });

// Route::get('ceklay', function (){
//     return view('ceklay');
// });

// Route::get('welcomedbmysql', function (){
//     return view('welcomedbmysql');
// });

// Route::get('testerupdate', function (){
//     return view('testerupdate');
// });

// Route::get('tester', function (){
//     return view('tester');
// });

// Route::get('pdftable', function (){
//     return view('pdftable');
// });

// Route::get('tcpdf', function (){
//     return view('tcpdf');
// });

// Route::get('welcome', function (){
//     return view('welcome');
// });



// Route::get('/login', function (){
//     return view('login');
// });

// Route::get('/registration', function (){
//     return view('registration');
// });

// use App\Http\Controllers\PjuController;
// Route::get('/addpju', [PjuController::class, 'index'])->name('addpju.index');
// Route::post('/addpju', [PjuController::class, 'store'])->name('addpju.store');

// Route::get('addspju', function (){
//     return view('addspju');
// });

// use App\Http\Controllers\PjuController;

// Route::get('/addpju', [PjuController::class, 'showForm']);
// Route::post('/pju/store', [PjuController::class, 'store'])->name('pju.store');


// use App\Http\Controllers\PjuController;
// Route::get('/pju/add', [PjuController::class, 'showForm'])->name('pju.add');
// Route::post('/pju', [PjuController::class, 'store'])->name('pju.store');

// Route::post('/addpjumonitoring', function () {
//     // Masukkan kode pengiriman formulir Anda di sini
// });








// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

















