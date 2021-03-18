<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Transaksi;

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

        $pdf = PDF::loadView('admin.transaksi.testlaporan', $data)->setPaper('a4', 'landscape');;

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
}
