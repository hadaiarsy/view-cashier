<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailPiutang;
use Illuminate\Support\Facades\Auth;

class DetailPiutangController extends Controller
{
    public function index()
    {
        $sideTitle = "piutang";
        return view('admin.transaksi.piutang', [
            'sideTitle' => $sideTitle
        ]);
    }

    public function show($resi)
    {
        $transaksi = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['no_resi' => $resi, 'is_lunas' => '0'])->get();

        if ($transaksi->count() > 0) {
            return response()->json([
                'message' => 'success',
                'data' => $transaksi
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $noResi = $request->no_resi;
        $tanggal = now();
        $idKasir = Auth::user()->id;

        $piutang = new DetailPiutang;
        $piutang->transaksi_id = $noResi;
        $piutang->tanggal = $tanggal;
        $piutang->kasir_id = $idKasir;
        $piutang->uang = $request->uang;
        $piutang->save();

        if ($piutang) {

            if ($request->is_lunas == '1') {
                Transaksi::where(['no_resi' => $noResi])->update([
                    'is_lunas' => '1'
                ]);
            }

            return response()->json([
                'message' => 'success',
                'data' => $piutang
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed'
            ], 500);
        }
    }
}
