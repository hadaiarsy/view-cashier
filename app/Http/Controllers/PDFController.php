<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Transaksi;
use App\Models\CetakLaporan;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan($kodeMember)
    {
        $data = [
            'title' => 'Laporan Transaksi',
            'date' => date('m/d/Y'),
            'member' => \App\Models\Member::where(['kode_member' => $kodeMember])->first(),
            'transaksi' => Transaksi::with(['kasir', 'detail', 'piutang'])->where(['member_id' => $kodeMember])->get(),
            'num' => 1
        ];

        $pdf = PDF::loadView('admin.transaksi.testlaporan', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('transaksi_laporan' . date('d-m-y_h-i-s') . '.pdf');
    }

    public function stok()
    {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('admin.stok.testlaporan', $data);

        return $pdf->stream('stok_laporan.pdf');
    }

    public function pembelian($noResi)
    {
        $transaksi = Transaksi::with(['kasir', 'member', 'detail'])->where(['jenis_transaksi' => 'pembelian', 'no_resi' => $noResi])->first();

        $data = [
            'transaksi' => $transaksi,
            'total' => 0
        ];

        $pdf = PDF::loadView('admin.transaksi.pdfpembelian', $data);

        return $pdf->stream('laporan-pembelian' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function lpj_harian()
    {
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['jenis_transaksi' => 'penjualan'])->whereDate('tanggal', now())->get();

        $pdf = PDF::loadView('admin.transaksi.laporanharian', [
            'data' => $data,
            'number' => CetakLaporan::generateNumber(['lpj_harian', date('Y-m-d')])
        ])->setPaper('a4', 'landscape');

        $cetak = new CetakLaporan;
        $cetak->id_kasir = Auth::user()->id;
        $cetak->tanggal = now();
        $cetak->jenis_laporan = 'lpj_harian';
        $cetak->no_cetak = CetakLaporan::generateNumber(['lpj_harian', date('d-m-Y')]);
        $cetak->save();

        return $pdf->stream('lpj_harian_' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function lpb_harian()
    {
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['jenis_transaksi' => 'pembelian'])->whereDate('created_at', now())->get();

        $pdf = PDF::loadView('admin.transaksi.laporanharianpembelian', [
            'data' => $data,
            'number' => CetakLaporan::generateNumber(['lpb_harian', date('Y-m-d')])
        ])->setPaper('a4', 'landscape');

        $cetak = new CetakLaporan;
        $cetak->id_kasir = Auth::user()->id;
        $cetak->tanggal = now();
        $cetak->jenis_laporan = 'lpb_harian';
        $cetak->no_cetak = CetakLaporan::generateNumber(['lpb_harian', date('d-m-Y')]);
        $cetak->save();

        return $pdf->stream('lpb_harian_' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function lp_piutang()
    {
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['jenis_transaksi' => 'penjualan'])->whereMonth('created_at', date('m'))->get();

        $pdf = PDF::loadView('admin.transaksi.laporanpiutang', [
            'data' => $data,
            'number' => CetakLaporan::generateNumber(['lpb_harian', date('m')])
        ])->setPaper('a4', 'landscape');

        $cetak = new CetakLaporan;
        $cetak->id_kasir = Auth::user()->id;
        $cetak->tanggal = now();
        $cetak->jenis_laporan = 'lp_piutang';
        $cetak->no_cetak = CetakLaporan::generateNumber(['lp_piutang', date('d-m-Y')]);
        $cetak->save();

        return $pdf->stream('lp_piutang_' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function s_jalan($resi = null)
    {
        $resi = null ? 'WY-190321001' : $resi;
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['no_resi' => $resi])->first();

        $pdf = PDF::loadView('admin.transaksi.suratjalan', [
            'data' => $data
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('wy_spb_' . date('d-m-Y_h-i-s') . '.pdf');
    }
}
