<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
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
            'member' => Member::where('nama', 'not like', '%Customer-%')->get()
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

            // Member
            if (Member::checkName($request->nama_member) == false) {
                $memberId = Member::incrementId();
                $member = new Member;
                $member->kode_member = $memberId;
                $member->jenis_member = $request->jenis_member;
                $member->nama = ($request->nama_member == null) ? $member->getName() : $request->nama_member;
                $member->unit = $request->unit_member;
                $member->telepon = $request->telepon_member;
                $member->alamat = $request->alamat_member;
                $memberSave = true;
            } else {
                $member = true;
                $memberId = Member::checkName($request->nama_member);
                $memberSave = false;
            }
            // End

            // Transaksi
            $transaksi = new Transaksi;
            $transaksi->no_resi = $noResi;
            $transaksi->tanggal = now();
            $transaksi->jenis_transaksi = $request->jenis_transaksi;
            $transaksi->kasir_id = $idKasir;
            $transaksi->member_id = $memberId;
            $transaksi->total = $request->total;
            $transaksi->diskon = $request->diskon;
            $transaksi->is_lunas = $request->is_lunas;
            // End


            if ($data && $transaksi && $member) {

                if ($memberSave) $member->save();

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
            $memberId = Member::incrementId();
            $loopData = count(collect($request)->get('detail_transaksi'));

            // // member
            // $member = new Member;
            // $member->kode_member = $memberId;
            // $member->jenis_member = 'supplier';
            // $member->nama = $member->getName();
            // $member->unit = '';
            // $member->telepon = '';
            // $member->alamat = '';
            // // end

            // // Transaksi
            // $transaksi = new Transaksi;
            // $transaksi->no_resi = $noResi;
            // $transaksi->tanggal = now();
            // $transaksi->jenis_transaksi = $request->jenis_transaksi;
            // $transaksi->kasir_id = $idKasir;
            // $transaksi->member_id = $memberId;
            // $transaksi->total = $request->total;
            // $transaksi->diskon = $request->diskon;
            // $transaksi->is_lunas = $request->is_lunas;
            // $transaksi->save();
            // // End

            // // Detail Transaksi
            // for ($i = 0; $i < $loopData; $i++) {
            //     $detail = new DetailTransaksi;
            //     $detail->transaksi_id = $noResi;
            //     $detail->kode_barang = $request->detail_transaksi[$i]['kode'];
            //     $detail->nama_barang = $request->detail_transaksi[$i]['nama'];
            //     $detail->jumlah = $request->detail_transaksi[$i]['jumlah'];
            //     $detail->satuan = $request->detail_transaksi[$i]['satuan'];
            //     $detail->harga = $request->detail_transaksi[$i]['total'];
            //     $detail->save();

            //     // edit stok barang
            //     if ($request->detail_transaksi[$i]['baru'] == false) {
            //         $barang = new Barang;
            //         $stok = $barang->where('kode_barang', $request->detail_transaksi[$i]['kode'])->first()->stok;
            //         $barang->where('kode_barang', $request->detail_transaksi[$i]['kode'])
            //             ->update([
            //                 'stok' => floatval(floatval($stok) + floatval($request->detail_transaksi[$i]['jumlah']))
            //             ]);
            //     } else {
            //         $kodeBarang = Barang::incrementId();
            //         $barang = new Barang;
            //         $barang->kode_barang = $kodeBarang;
            //         $barang->barcode = $request->detail_transaksi[$i]['barcode'];
            //         $barang->nama = $request->detail_transaksi[$i]['nama'];
            //         $barang->stok = $request->detail_transaksi[$i]['jumlah'];
            //         $barang->save();
            //         $satuan = new SatuanBarang;
            //         $satuan->kode_barang = $kodeBarang;
            //         $satuan->nama_satuan = $request->detail_transaksi[$i]['satuan'];
            //         $satuan->rasio = 1;
            //         $satuan->harga = $request->detail_transaksi[$i]['harga'];
            //         $satuan->save();
            //     }
            //     // end

            // }
            // // End

            return response()->json([
                'data' => $request->all()
            ]);
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
            'transaksi' => $transaksi->with(['member', 'kasir'])->where('jenis_transaksi', 'penjualan')->get()
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
}
