<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi;
use Carbon\Carbon;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('login', function () {
        return view('admin.login');
    });

    Route::get('dashboard', function () {
        // return view('admin.dashboard');
        return redirect('/transaksi');
    });

    // Route Transaksi
    Route::group([''], function () {
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
        Route::get('show-barang-transaksi/{any}', [TransaksiController::class, 'showBarang']);
        Route::post('simpan-transaksi', [TransaksiController::class, 'store']);
        Route::get('generate-member-id', function () {
            return \App\Models\Member::incrementId();
        });

        Route::get('getall-member', [TransaksiController::class, 'getMember']);

        Route::get('getall-barang', [TransaksiController::class, 'getBarang']);

        Route::get('daftar-transaksi', [TransaksiController::class, 'list']);

        Route::get('show-transaksi/{any}', [TransaksiController::class, 'show']);

        Route::get('download-transaksi', [TransaksiController::class, '']);

        Route::get('transaksi-pdf', [PDFController::class, 'laporan']);

        Route::get('test-struk/{any}/{total}/{uang}/{kembali}', function ($kode, $total, $uang, $kembali) {
            $data = Transaksi::with(['detail', 'kasir', 'member'])->where('no_resi', $kode)->get();
            return view('admin.transaksi.test', [
                'data' => $data,
                'total' => $total,
                'uang' => $uang,
                'kembali' => $kembali
            ]);
        });

        Route::get('test-laporan', function () {
            return view('admin.transaksi.testlaporan');
        });
    });


    Route::get('stok', function () {
        return view('admin.stok.stok');
    });

    Route::get('stok-pdf', [PDFController::class, 'stok']);

    Route::get('test-stok', function () {
        return view('admin.stok.testlaporan');
    });

    // Route Barang
    Route::group([''], function () {
        Route::get('daftar-barang', [BarangController::class, 'index']);
        Route::post('store-barang', [BarangController::class, 'store']);
        Route::get('show-barang/{any}', [BarangController::class, 'show']);
        Route::post('update-barang', [BarangController::class, 'update']);
        Route::delete('delete-barang/{any}', [BarangController::class, 'delete']);
    });

    // Route Satuan Barang
    Route::group([''], function () {
        Route::post('store-satuan', [SatuanBarangController::class, 'store']);
        Route::get('show-satuan/{any}', [SatuanBarangController::class, 'show']);
        Route::post('update-satuan', [SatuanBarangController::class, 'update']);
        Route::delete('delete-satuan/{any}', [SatuanBarangController::class, 'delete']);
    });

    Route::get('daftar-supplier', function () {
        return view('admin.stok.daftarsupplier');
    });

    // Route Member
    Route::group([''], function () {
        Route::get('daftar-member', [MemberController::class, 'index']);
        Route::post('store-member', [MemberController::class, 'store']);
        Route::delete('delete-member/{any}', [MemberController::class, 'delete']);
        Route::get('show-member/{any}', [MemberController::class, 'show']);
        Route::post('update-member', [MemberController::class, 'update']);
        Route::get('getname-member', function () {
            // return \App\Models\Transaksi::incrementId();
            // return view('admin.transaksi.test');
            // return response()->json([
            //     \App\Models\Transaksi::whereDate('tanggal', '>=', Carbon::parse('2021-02-01')->format('Y-m-d'))
            //         ->whereDate('tanggal', '<=', Carbon::parse('2021-02-05')->format('Y-m-d'))
            //         ->get()
            // ]);
            // return response()->json([
            //     \App\Models\Transaksi::whereYear('tanggal', '=', '2021')->whereMonth('tanggal', '=', '02')->get()
            // ]);
            // return Carbon::now('Asia/Bangkok')->format('Y-m-d H:i:s');

            // return \App\Models\Barang::where('kode_barang', 'B-210114001')->first()->stok;

            // return \App\Models\Member::checkName('asd bambang_M-210127001');

            // return csrf_token();

            // $data = \App\Models\Transaksi::with(['kasir', 'member', 'detail'])->offset(2)->first()->member->nama;
            // $data = \App\Models\Transaksi::with(['kasir', 'member', 'detail'])->select('member_id')->distinct('member_id')->get();
            // return ($data == null ? 'none' : $data);

            // return \App\Models\User::with(['transaksi', 'detailTransaksi'])->get();

            // return \Illuminate\Support\Facades\DB::select(\Illuminate\Support\Facades\DB::raw('SELECT * FROM user_level'));

            // return '';
        });
    });

    // Route User
    Route::middleware('auth')->group(function () {
        Route::get('daftar-user', [UserController::class, 'index']);
        Route::post('store-user', [UserController::class, 'store']);
        Route::delete('delete-user/{any}', [UserController::class, 'delete']);
        Route::get('show-user/{any}', [UserController::class, 'show']);
        Route::post('update-user', [UserController::class, 'update']);
        Route::post('repassword-user', [UserController::class, '_repassword']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
