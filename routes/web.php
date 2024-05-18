<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;

use App\Http\Controllers\DCnhapxuatController;
use App\Http\Controllers\PhieunhapxuatController;
use App\Http\Controllers\KhoController;
use App\Http\Controllers\LoaispController;
use App\Http\Controllers\NhacungcapController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\TrangthaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\dashboard;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware(['auth'])->name('trangchu');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Multi input 
// Route::get('/student-form', [TestController::class, 'index']);
// Route::post('/store-input-fields', [TestController::class, 'store']);

// Route::get('/test', function () {
//     return Auth::id();
// })->middleware(['auth']);

// use App\Models\User;
// Route::get('/model', function () {
//     foreach (User::all() as $flight) {
//         dd($flight);
//     }
// })->middleware(['auth', 'admin']); // đã gọi Model thành công và check phân quyền thành công


require __DIR__.'/auth.php';



Route::prefix('phieunhapxuat')->as('phieunhapxuat.')->group(function () {

    Route::get('/index', [PhieunhapxuatController::class, 'index'])->middleware(['auth'])->name('index');
    Route::get('/create', [PhieunhapxuatController::class, 'create'])->middleware(['auth', 'user'])->name('create');
    Route::post('/store', [PhieunhapxuatController::class, 'store'])->middleware(['auth', 'user'])->name('store');
    Route::get('/show/{id}', [PhieunhapxuatController::class, 'show'])->middleware(['auth'])->name('show');
    Route::get('/edit/{id}', [PhieunhapxuatController::class, 'edit'])->middleware(['auth', 'user'])->name('edit');
    Route::post('/update', [PhieunhapxuatController::class, 'update'])->middleware(['auth', 'user'])->name('update');
    Route::post('/destroy', [PhieunhapxuatController::class, 'destroy'])->middleware(['auth', 'user'])->name('destroy');
    Route::post('/index', [PhieunhapxuatController::class, 'select'])->middleware(['auth'])->name('select');

    Route::get('/pdf/{id}', [PhieunhapxuatController::class, 'exportPDF'])->middleware(['auth'])->name('pdf');

}); // kiet

Route::prefix('trangthai')->as('trangthai.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', [TrangthaiController::class, 'index'])->name('index');
    Route::get('/create', [TrangthaiController::class, 'create'])->name('create');
    Route::post('/store', [TrangthaiController::class, 'store'])->name('store');
    Route::get('/show/{id}', [TrangthaiController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [TrangthaiController::class, 'edit'])->name('edit');
    Route::post('/update', [TrangthaiController::class, 'update'])->name('update');
    Route::post('/destroy', [TrangthaiController::class, 'destroy'])->name('destroy');

}); // kiet

Route::prefix('diachinhapxuat')->as('diachinhapxuat.')->group(function () {

    Route::get('/index', [DCnhapxuatController::class, 'index'])->middleware(['auth'])->name('index');
    Route::get('/create', [DCnhapxuatController::class, 'create'])->middleware(['auth', 'user'])->name('create');
    Route::post('/store', [DCnhapxuatController::class, 'store'])->middleware(['auth', 'user'])->name('store');
    Route::get('/edit/{id}', [DCnhapxuatController::class, 'edit'])->middleware(['auth', 'user'])->name('edit');
    Route::post('/update', [DCnhapxuatController::class, 'update'])->middleware(['auth', 'user'])->name('update');
    Route::post('/destroy', [DCnhapxuatController::class, 'destroy'])->middleware(['auth', 'user'])->name('destroy');

}); // kiet

Route::prefix('sanpham')->as('sanpham.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', [SanphamController::class, 'index'])->name('index');
    Route::get('/create', [SanphamController::class, 'create'])->name('create');
    Route::post('/store', [SanphamController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SanphamController::class, 'edit'])->name('edit');
    Route::post('/update', [SanphamController::class, 'update'])->name('update');
    Route::post('/destroy', [SanphamController::class, 'destroy'])->name('destroy');

    Route::get('/tonkho', [SanphamController::class, 'thongke'])->name('tonkho');
    Route::post('/tonkho', [SanphamController::class, 'thongkeDate'])->name('tonkhoDate');
    Route::post('/pdf/thongke', [SanphamController::class, 'exportPDF'])->name('pdfthongke');

}); // kiet

Route::prefix('taikhoan')->as('taikhoan.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::post('/destroy', [UserController::class, 'destroy'])->name('destroy');

}); // kiet

Route::get('dashboard/index', [dashboard::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('loaisp')->as('loaisp.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', [LoaispController::class, 'index'])->name('index');
    Route::get('/create', [LoaispController::class, 'create'])->name('create');
    Route::post('/store', [LoaispController::class, 'store'])->name('store');
    Route::post('/destroy/{id}', [LoaispController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [LoaispController::class, 'edit'])->name('edit');
    Route::post('/update', [LoaispController::class, 'update'])->name('update');

});//d
Route::prefix('kho')->as('kho.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', [KhoController::class, 'index'])->name('index');
    Route::get('/create', [KhoController::class, 'create'])->name('create');
    Route::post('/store', [KhoController::class, 'store'])->name('store');
    Route::post('/destroy/{id}', [KhoController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [KhoController::class, 'edit'])->name('edit');
    Route::post('/update', [KhoController::class, 'update'])->name('update');

});//d
Route::prefix('nhacungcap')->as('nhacungcap.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', [NhacungcapController::class, 'index'])->name('index');
    Route::get('/create', [NhacungcapController::class, 'create'])->name('create');
    Route::post('/store', [NhacungcapController::class, 'store'])->name('store');
    Route::post('/destroy/{id}', [NhacungcapController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [NhacungcapController::class, 'edit'])->name('edit');
    Route::post('/update', [NhacungcapController::class, 'update'])->name('update');

});//d





// testing

use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('qr-code', function () {
    $data = "array(1, 2)";
    return QrCode::size(500)->generate($data);
});


// bật lên sẽ làm local ko hoạt động
// add URL to use https: can use css, js file
// use Illuminate\Support\Facades\URL;
// URL::forceScheme('https');