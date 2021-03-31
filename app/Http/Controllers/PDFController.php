<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Transaksi;
use App\Models\CetakLaporan;
use App\Models\DetailPiutang;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\Member;

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
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where('jenis_transaksi', 'penjualan')->orWhere('jenis_transaksi', 'pengiriman')->get();

        $pdf = PDF::loadView('admin.transaksi.laporanharian', [
            'data' => $data,
            'number' => CetakLaporan::generateNumber(['lpj_harian', date('Y-m-d')]),
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
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['jenis_transaksi' => 'pembelian'])->get();

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
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['jenis_transaksi' => 'penjualan'])->orWhere(['jenis_transaksi' => 'pengiriman'])->whereMonth('created_at', date('m'))->get();

        $pdf = PDF::loadView('admin.transaksi.laporanpiutang', [
            'data' => $data,
            'number' => CetakLaporan::generateNumber(['lp_piutang', date('m')])
        ])->setPaper('a4', 'landscape');

        $cetak = new CetakLaporan;
        $cetak->id_kasir = Auth::user()->id;
        $cetak->tanggal = now();
        $cetak->jenis_laporan = 'lp_piutang';
        $cetak->no_cetak = CetakLaporan::generateNumber(['lp_piutang', date('d-m-Y')]);
        $cetak->save();

        return $pdf->stream('lp_piutang_' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function lp_hutang()
    {
        $data = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where(['jenis_transaksi' => 'pembelian'])->whereMonth('created_at', date('m'))->get();

        $pdf = PDF::loadView('admin.transaksi.laporanhutang', [
            'data' => $data,
            'number' => CetakLaporan::generateNumber(['lp_hutang', date('m')])
        ])->setPaper('a4', 'landscape');

        $cetak = new CetakLaporan;
        $cetak->id_kasir = Auth::user()->id;
        $cetak->tanggal = now();
        $cetak->jenis_laporan = 'lp_hutang';
        $cetak->no_cetak = CetakLaporan::generateNumber(['lp_hutang', date('d-m-Y')]);
        $cetak->save();

        return $pdf->stream('lp_hutang_' . date('d-m-Y_h-i-s') . '.pdf');
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

    public function son()
    {
        $jenis = JenisBarang::with(['barang'])->get();
        $transaksi = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->whereMonth('tanggal', date('m'))->get();

        $pdf = PDF::loadView('admin.barang.stockopname', [
            'jenis' => $jenis,
            'transaksi' => $transaksi,
            'satuan' => SatuanBarang::all(),
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('son_' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function m_piutang()
    {
        $transaksi = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where('jenis_transaksi', 'penjualan')->orWhere('jenis_transaksi', 'pengiriman')->get();

        $pdf = PDF::loadView('admin.transaksi.mpiutang', [
            'transaksi' => $transaksi,
            'member' => Member::all(),
            'unit' => Member::select('unit')->where('unit', '!=', 0)->distinct('unit')->get(),
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('mpiutang_' . date('d-m-Y_h-i-s') . '.pdf');
    }

    public function m_hutang()
    {
        $transaksi = Transaksi::with(['kasir', 'member', 'detail', 'piutang'])->where('jenis_transaksi', 'pembelian')->get();

        $pdf = PDF::loadView('admin.transaksi.mhutang', [
            'transaksi' => $transaksi,
            'member' => Member::all(),
            'unit' => Member::select('unit')->where('unit', 0)->distinct('unit')->get(),
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('mhutang_' . date('d-m-Y_h-i-s') . '.pdf');
    }
}
