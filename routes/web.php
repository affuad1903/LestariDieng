<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\SocmedController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LegalityController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\DaftarDestinasiController;
use App\Http\Controllers\DaftarFasilitasController;
use App\Http\Controllers\DestinationUniqController;
use App\Http\Controllers\DetailItineraryController;
use App\Http\Controllers\DestinationSectionController;
use App\Http\Controllers\ReviewController;


// Route::get('/sitemap.xml', function () {
//     return response()->view('sitemap')->header('Content-Type', 'text/xml');
// });

// Authentication Routes - Prevent authenticated users from accessing login/register
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class,'showregister'])->name('register');
    Route::post('/register', [AuthController::class,'register']);
    Route::get('/login', [AuthController::class,'showlogin'])->name('login');
    Route::post('/login', [AuthController::class,'login']);
});

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Temporary alias route for 'home.index' to fix redirect issue
Route::get('/home', function () {
    return redirect()->route('dashboard.home.index');
})->name('home.index');


Route::get('/', [PageController::class,'homeIndex']);
Route::get('/destinasi-index', [PageController::class,'destinasiIndex']);
Route::get('/destinasi-show', [PageController::class,'destinasiShow']);
Route::get('/paket-index', [PageController::class,'paketIndex']);
Route::get('/paket-show', [PageController::class,'paketShow']);
Route::get('/paket-jeep-index', [PageController::class,'paketJeepIndex']);
Route::get('/paket-jeep-show', [PageController::class,'paketJeepShow']);
Route::get('/galeri-index', [PageController::class,'galeriIndex']);
Route::get('/galeri-show', [PageController::class,'galeriShow']);
Route::get('/kontak-index', [PageController::class,'kontakIndex']);

// Public Review Routes
Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

// Protected Dashboard Routes - Require Authentication
Route::middleware(['admin.auth'])->group(function () {
    Route::resource('dashboard/home', HomeController::class)->names([
        'index' => 'dashboard.home.index',
        'create' => 'dashboard.home.create',
        'store' => 'dashboard.home.store',
        'show' => 'dashboard.home.show',
        'edit' => 'dashboard.home.edit',
        'update' => 'dashboard.home.update',
        'destroy' => 'dashboard.home.destroy',
    ]);
    Route::resource('dashboard/home/legality', LegalityController::class);
    Route::resource('dashboard/home/socmed', SocmedController::class);
    Route::resource('dashboard/home/contact', ContactController::class);

    Route::resource('dashboard/destinasi', DestinasiController::class);
    Route::resource('dashboard/destinasi/section', DestinationSectionController::class);
    Route::resource('dashboard/destinasi/uniq', DestinationUniqController::class);

    Route::resource('dashboard/paket', PaketController::class);
    Route::resource('dashboard/daftar-d', DaftarDestinasiController::class);
    Route::resource('dashboard/daftar-fasilitas', DaftarFasilitasController::class);
    Route::resource('dashboard/detail-itinerary', DetailItineraryController::class);

    Route::resource('dashboard/galery', GaleryController::class);
    Route::post('/dashboard/galery/{id}/add-images', [GaleryController::class, 'addImages'])->name('galery.addImages');
    Route::delete('/dashboard/galery/image/{id}', [GaleryController::class, 'deleteImage'])->name('galery.deleteImage');

    Route::get('/dashboard/review', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/dashboard/review/link', [ReviewController::class, 'generateLink'])->name('review.generate-link');
    Route::delete('/dashboard/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});
