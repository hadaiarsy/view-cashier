<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\DetailPiutang;
use App\Models\Member;
use App\Models\Barang;
use App\Models\SatuanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noResi = Transaksi::incrementId();
        $barang = Barang::with('satuan')->get();
        $sideTitle = "transaksi";
        return view('admin.transaksi.transaksi', [
            'noResi' => $noResi,
            'barang' => $barang,
            'sideTitle' => $sideTitle
        ]);
    }

    public function __pembelian()
    {
        $noResi = Transaksi::incrementId();
        $barang = Barang::with('satuan')->get();
        $sideTitle = "pembelian";
        return view('admin.transaksi.pembelian', [
            'noResi' => $noResi,
            'barang' => $barang,
            'sideTitle' => $sideTitle
        ]);
    }

    public function showBarang($barcode)
    {
        $barang = Barang::with('satuan')
            ->where('barcode', $barcode)
            ->orWhere('kode_barang', $barcode)
            ->get();
        if ($barang->count() > 0) {
            return response()->json([
                'message' => 'success',
                'barang' => $barang
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed'
            ], 500);
        }
    }

    public function getBarang()
    {
        return response()->json([
            'barang' => Barang::with('satuan')->get()
        ]);
    }

    public function getMember()
    {
        return response()->json([
            'member' => Member::where('jenis_member', 'customer')->where('nama', 'not like', '%general-%')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->jenis_transaksi == 'penjualan') { // penjualan
            $data = $request->all();
            $loopData = count(collect($request)->get('detail_transaksi'));
            $noResi = Transaksi::incrementId();
            $idKasir = Auth::user()->id;
            $tanggal = now();

            // Member
            if ($request->kode_member == "") {
                $member = true;
                $memberId = 'U-00-01';
            } else {
                $member = true;
                $memberId = $request->kode_member;
            }
            // End

            // Transaksi
            $transaksi = new Transaksi;
            $transaksi->no_resi = $noResi;
            $transaksi->tanggal = $tanggal;
            $transaksi->jenis_transaksi = $request->jenis_transaksi;
            $transaksi->kasir_id = $idKasir;
            $transaksi->member_id = $memberId;
            $transaksi->total = $request->total;
            $transaksi->diskon = $request->diskon;
            $transaksi->is_lunas = $request->is_lunas;
            // End


            if ($data && $transaksi && $member) {

                $transaksi->save();

                // Detail Transaksi
                for ($i = 0; $i < $loopData; $i++) {
                    $detail = new DetailTransaksi;
                    $detail->transaksi_id = $noResi;
                    $detail->kode_barang = $request->detail_transaksi[$i]['kode'];
                    $detail->nama_barang = $request->detail_transaksi[$i]['nama'];
                    $detail->jumlah = $request->detail_transaksi[$i]['jumlah'];
                    $detail->satuan = $request->detail_transaksi[$i]['satuan'];
                    $detail->harga = $request->detail_transaksi[$i]['harga'];
                    $detail->save();

                    // edit stok barang
                    $barang = new Barang;
                    $stok = $barang->where('kode_barang', $request->detail_transaksi[$i]['kode'])->first()->stok;
                    $barang->where('kode_barang', $request->detail_transaksi[$i]['kode'])
                        ->update([
                            'stok' => floatval(floatval($stok) - floatval($request->detail_transaksi[$i]['jumlah']))
                        ]);
                }
                // End

                // piutang
                if ($request->is_lunas == '0' && (int)$request->uang > 0) {
                    $piutang = new DetailPiutang;
                    $piutang->transaksi_id = $noResi;
                    $piutang->tanggal = $tanggal;
                    $piutang->kasir_id = $idKasir;
                    $piutang->uang = $request->uang;
                    $piutang->save();
                }
                // end

                return response()->json([
                    'message' => 'success',
                    'data' => $data,
                    'no_resi' => $noResi,
                    'id_kasir' => $idKasir
                ], 200);
            } else {
                return response()->json([
                    'message' => 'failed'
                ], 500);
            }
        } else if ($request->jenis_transaksi == 'pembelian') { // pembelian
            $noResi = Transaksi::incrementId();
            $idKasir = Auth::user()->id;
            $memberId = 'U-00-02';
            $loopData = count(collect($request)->get('detail_transaksi'));

            // member
            // end

            // Transaksi
            $transaksi = new Transaksi;
            $transaksi->no_resi = $noResi;
            $transaksi->tanggal = now();
            $transaksi->jenis_transaksi = $request->jenis_transaksi;
            $transaksi->kasir_id = $idKasir;
            $transaksi->member_id = $memberId;
            $transaksi->total = $request->total;
            $transaksi->diskon = null;
            $transaksi->is_lunas = true;
            $transaksi->save();
            // End

            // Detail Transaksi
            for ($i = 0; $i < $loopData; $i++) {
                $detail = new DetailTransaksi;
                $detail->transaksi_id = $noResi;

                // edit stok barang
                if ($request->detail_transaksi[$i]['baru'] == 'false') {
                    $detail->kode_barang = $request->detail_transaksi[$i]['kode'];

                    $barang = new Barang;
                    $stok = $barang->where('kode_barang', $request->detail_transaksi[$i]['kode'])->first()->stok;
                    $barang->where('kode_barang', $request->detail_transaksi[$i]['kode'])
                        ->update([
                            'stok' => floatval(floatval($stok) + floatval($request->detail_transaksi[$i]['jumlah'])),
                        ]);
                    $satuan = new SatuanBarang;
                    $satuan->where([
                        'kode_barang' => $request->detail_transaksi[$i]['kode'],
                        'nama_satuan' => $request->detail_transaksi[$i]['satuan']
                    ])
                        ->update([
                            'harga_beli' => $request->detail_transaksi[$i]['harga'],
                        ]);
                } else {
                    $kodeBarang = Barang::incrementId();
                    $detail->kode_barang = $kodeBarang;

                    $barang = new Barang;
                    $barang->kode_barang = $kodeBarang;
                    $barang->barcode = $request->detail_transaksi[$i]['barcode'];
                    $barang->nama = $request->detail_transaksi[$i]['nama'];
                    $barang->stok = $request->detail_transaksi[$i]['jumlah'];
                    $barang->save();
                    $satuan = new SatuanBarang;
                    $satuan->kode_barang = $kodeBarang;
                    $satuan->nama_satuan = $request->detail_transaksi[$i]['satuan'];
                    $satuan->rasio = 1;
                    $satuan->harga_beli = $request->detail_transaksi[$i]['harga'];
                    $satuan->harga_jual = $request->detail_transaksi[$i]['harga'];
                    $satuan->save();
                }
                // end

                $detail->nama_barang = $request->detail_transaksi[$i]['nama'];
                $detail->jumlah = $request->detail_transaksi[$i]['jumlah'];
                $detail->satuan = $request->detail_transaksi[$i]['satuan'];
                $detail->harga = $request->detail_transaksi[$i]['total'];
                $detail->save();
            }
            // End

            if ($transaksi && $detail && $barang) {
                return response()->json([
                    'message' => 'success',
                    'data' => Transaksi::where('no_resi', $noResi)->get()
                ], 200);
            } else {
                return response()->json([
                    'message' => 'failed',
                ], 500);
            }
        }
    }

    /**
     * Display the all resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function list(Transaksi $transaksi)
    {
        return view('admin.transaksi.daftar', [
            'transaksi' => $transaksi->with(['member', 'kasir'])->where('jenis_transaksi', 'penjualan')->get(),
            'sideTitle' => 'laporan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi, $kode)
    {
        $transaksi = $transaksi->with(['detail', 'kasir', 'member'])->find(['no_resi', $kode])->first();
        return response()->json([
            'transaksi' => $transaksi
        ], 500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function member_piutang($kode)
    {
        $transaksi = Transaksi::with(['member', 'kasir', 'detail', 'piutang'])->where(['member_id' => $kode, 'is_lunas' => '0'])->get();
        return response()->json([
            'message' => 'success',
            'data' => $transaksi
        ]);
    }
}
