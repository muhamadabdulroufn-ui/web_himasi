<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProfilesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailGalleryController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeBackgroundController;
use App\Http\Controllers\Admin\MemberDivisiController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\ProkerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InformationController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);


// route for front
Route::group([], function () {
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('/tentang', [InformationController::class, 'tentang']);
  Route::get('/artikel', [InformationController::class, 'indexNews']);
  Route::get('/artikel/{slug}', [InformationController::class, 'showNews']);
  Route::get('/divisi', [InformationController::class, 'divisi']);
  Route::get('/program-kerja', [InformationController::class, 'proker']);
  Route::get('/galeri', [InformationController::class, 'gallery']);
  Route::get('/galeri/{id}/detail', [InformationController::class, 'galleryDetail']);
  Route::get('/agenda', [InformationController::class, 'agenda']);
  Route::get('/agendaDetail', [InformationController::class, 'agendaShow'])->name('agendaDetail');
  Route::get('/kontak-kami', [InformationController::class, 'contact']);
});

// route for admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkRole:admin,pembina,pengurus']], function () {
  Route::get('/dashboard', [DashboardController::class, 'index']);
  Route::resource('/program-kerja', ProkerController::class);
  Route::resource('/periode', PeriodeController::class);
  Route::post('/comment/{id}', [CommentController::class, 'store'])->name('addComment');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkRole:admin']], function () {
  Route::get('/home-background', [HomeBackgroundController::class, 'index'])->name('home-background.index');
  Route::post('/home-background', [HomeBackgroundController::class, 'update'])->name('home-background.update');
  Route::get('/profile/{id}', [ProfilesController::class, 'index']);
  Route::post('/profile/{id}', [ProfilesController::class, 'update']);
  Route::resource('/divisi', DivisiController::class);
  Route::resource('/member-divisi', MemberDivisiController::class);
  Route::resource('/kategori-berita', NewsCategoryController::class);
  Route::resource('/berita', NewsController::class);
  Route::resource('/galeri', GalleryController::class);
  Route::resource('/agenda', AgendaController::class);
  Route::resource('/users', UserController::class);

  // Detail Gallery
  Route::get('/detail-galeri/{id}', [DetailGalleryController::class, 'index']);
  Route::get('/detail-galeri/{id}/create', [DetailGalleryController::class, 'create']);
  Route::post('/detail-galeri/{id}', [DetailGalleryController::class, 'store']);
  Route::get('/detail-galeri/{id}/{galeri_id}/edit', [DetailGalleryController::class, 'edit']);
  Route::put('/detail-galeri/{id}/{galeri_id}/edit', [DetailGalleryController::class, 'update']);
  Route::delete('/detail-galeri/{id}/{galeri_id}', [DetailGalleryController::class, 'destroy']);
});
