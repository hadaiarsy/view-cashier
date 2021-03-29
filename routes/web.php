<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailPiutangController;
use App\Http\Controllers\JenisBarangController;
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

        Route::get('pembelian', [TransaksiController::class, '__pembelian'])->name('pembelian');

        Route::get('get-no-dpb', function () {
            return response()->json([
                'no_dpb' => Transaksi::generateDpb()
            ]);
        });

        Route::get('piutang', [DetailPiutangController::class, 'index'])->name('piutang');

        Route::get('hutang', [DetailPiutangController::class, 'hutang'])->name('hutang');

        Route::get('get-piutang/{any}', [DetailPiutangController::class, 'show']);

        Route::post('store-piutang', [DetailPiutangController::class, 'store']);

        Route::get('struk-piutang/{resi}/{idPiutang}/{saldoAwal}/{sisa}', function ($resi, $idPiutang, $saldoAwal, $sisa) {
            $transaksi = Transaksi::with(['detail', 'kasir', 'member', 'piutang'])->where('no_resi', $resi)->get();
            return view('admin.transaksi.strukpiutang', [
                'data' => $transaksi,
                'idPiutang' => $idPiutang,
                'saldoAwal' => $saldoAwal,
                'sisa' => $sisa
            ]);
        });

        Route::get('show-barang-transaksi/{any}', [TransaksiController::class, 'showBarang']);

        Route::post('simpan-transaksi', [TransaksiController::class, 'store']);

        Route::get('check-id-member/{kode}', function ($kode) {
            return \App\Models\Member::where(['kode_member' => $kode])->first();
        });

        Route::get('getall-member', [TransaksiController::class, 'getMember']);

        Route::get('getall-supplier', [TransaksiController::class, 'getSupplier']);

        Route::get('getall-barang', [TransaksiController::class, 'getBarang']);

        Route::get('daftar-transaksi', [TransaksiController::class, 'list'])->name('laporan');

        Route::get('daftar-transaksi-pembelian', [TransaksiController::class, 'listPembelian'])->name('daftar-pembelian');

        Route::get('show-transaksi/{any}', [TransaksiController::class, 'show']);

        Route::get('download-transaksi', [TransaksiController::class, '']);

        Route::get('transaksi-pdf/{member}', [PDFController::class, 'laporan'])->name('download-pdf');
        Route::get('laporan-transaksi/{member}', function ($kodeMember) {
            $member = \App\Models\Member::where(['kode_member' => $kodeMember])->first();
            $transaksi = Transaksi::with(['kasir', 'detail', 'piutang'])->where(['member_id' => $kodeMember])->get();
            return view('admin.transaksi.laporan', [
                'member' => $member,
                'transaksi' => $transaksi,
                'num' => 1
            ]);
        });

        Route::get('pdf-pembelian/{resi}', [PDFController::class, 'pembelian']);

        Route::get('get-member-piutang/{kode}', [TransaksiController::class, 'member_piutang']);

        Route::get('get-member-search', [MemberController::class, 'member_search']);

        Route::get('get-supplier-search', [MemberController::class, 'supplier_search']);

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

        Route::get('json-laporan-harian', function () {
            return response()->json([
                'data' => Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->whereDate('tanggal', now())->get()
            ]);
        });

        Route::get('laporan-harian-penjualan', [PDFController::class, 'lpj_harian'])->name('lpj-harian');

        Route::get('laporan-harian-pembelian', [PDFController::class, 'lpb_harian'])->name('lpb-harian');

        Route::get('daftar-piutang', [TransaksiController::class, 'daftar_piutang'])->name('d-piutang');

        Route::get('laporan-piutang', [PDFController::class, 'lp_piutang'])->name('lp-piutang');

        Route::get('mutasi-piutang', [PDFController::class, 'm_piutang'])->name('m-piutang');

        Route::get('transaksi-retail', [TransaksiController::class, '__retail'])->name('retail');

        Route::get('surat-jalan/{any?}', [PDFController::class, 's_jalan'])->name('s-jalan');
    });

    Route::get('jenis-barang', [JenisBarangController::class, 'index'])->name('jenis');
    Route::get('show-jenis-barang/{id}', [JenisBarangController::class, 'show']);
    Route::post('store-jenis-barang', [JenisBarangController::class, 'store']);
    Route::post('update-jenis-barang', [JenisBarangController::class, 'update']);

    Route::get('stok', [PDFController::class, 'son']);

    Route::get('stok-pdf', [PDFController::class, 'stok']);

    Route::get('test-stok', function () {
        return view('admin.stok.testlaporan');
    });

    // Route Barang
    Route::group([''], function () {
        Route::get('daftar-barang', [BarangController::class, 'index'])->name('barang');
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

    // Route Supplier
    Route::get('daftar-supplier', [MemberController::class, 'supplier'])->name('supplier');

    Route::get('faktur-piutang/{any?}', function ($resi = null) {
        $resi = $resi == null ? 'WY-220321002' : $resi;
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['no_resi' => $resi])->first();
        // $tawal = $total * 100 / (100 - $diskon);
        // $kembali = $data->uang - $data->total;
        return view('admin.transaksi.fakturpiutang', [
            'data' => $data
        ]);
    });

    Route::get('faktur-retail/{any?}', function ($resi = null) {
        $resi = $resi == null ? 'WY-220321002' : $resi;
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['no_resi' => $resi])->first();
        // $tawal = $total * 100 / (100 - $diskon);
        // $kembali = $data->uang - $data->total;
        return view('admin.transaksi.fakturretail', [
            'data' => $data
        ]);
    });

    // Route Member
    Route::group([''], function () {
        Route::get('daftar-member', [MemberController::class, 'index'])->name('member');
        Route::post('store-member', [MemberController::class, 'store']);
        Route::delete('delete-member/{any}', [MemberController::class, 'delete']);
        Route::get('show-member/{any}', [MemberController::class, 'show']);
        Route::post('update-member', [MemberController::class, 'update']);
        Route::get('getname-member', function () {
            // return response()->json([
            //     \App\Models\Transaksi::whereDate('tanggal', '>=', Carbon::parse('2021-02-01')->format('Y-m-d'))
            //         ->whereDate('tanggal', '<=', Carbon::parse('2021-02-05')->format('Y-m-d'))
            //         ->get()
            // ]);
            return response()->json([
                // \App\Models\Transaksi::whereYear('tanggal', '=', '2021')->whereMonth('tanggal', '=', '02')->get()
                // \App\Models\Transaksi::whereDay('tanggal', '=', date('d'))->get()
                // \App\Models\Transaksi::generateDpb()
                // 'sata' => App\Models\Member::select('unit')->distinct('unit')->get(),
                'data' => date('my', strtotime('29-03-2020')) == date('my') ? date('my') : NULL
            ]);
            // return Carbon::now('Asia/Bangkok')->format('Y-m-d H:i:s');

            // return csrf_token();

            // $data = \App\Models\Transaksi::with(['kasir', 'member', 'detail'])->offset(2)->first()->member->nama;
            // $data = \App\Models\Transaksi::with(['kasir', 'member', 'detail'])->select('member_id')->distinct('member_id')->get();

            // return \Illuminate\Support\Facades\DB::select(\Illuminate\Support\Facades\DB::raw('SELECT * FROM user_level'));
        });
    });

    // Route User
    Route::middleware('auth')->group(function () {
        Route::get('daftar-user', [UserController::class, 'index'])->name('user');
        Route::post('store-user', [UserController::class, 'store']);
        Route::delete('delete-user/{any}', [UserController::class, 'delete']);
        Route::get('show-user/{any}', [UserController::class, 'show']);
        Route::post('update-user', [UserController::class, 'update']);
        Route::post('repassword-user', [UserController::class, '_repassword']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
