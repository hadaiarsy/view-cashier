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

        $pdf = PDF::loadView('admin.transaksi.testlaporan', $data);

        return $pdf->stream('transaksi_laporan.pdf');
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
}
