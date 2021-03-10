<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SatuanBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::with('satuan')->get();
        return view('admin.barang.daftarbarang', [
            'barang' => $barang,
            'date' => Barang::incrementId(),
            'sideTitle' => 'barang'
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
        $barang = new Barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->barcode = $request->barcode;
        $barang->nama = $request->nama;
        $barang->stok = $request->stok;
        $barang->save();
        $satuan = new SatuanBarang;
        $satuan->kode_barang = $request->kode_barang;
        $satuan->nama_satuan = $request->nama_satuan;
        $satuan->rasio = $request->rasio;
        $satuan->harga_beli = $request->harga_beli;
        $satuan->harga_jual = $request->harga_jual;
        $satuan->save();
        if ($barang && $satuan) {
            return response()->json([
                'message' => 'success',
                'data' => [
                    'barang' => $barang,
                    'satuan' => $satuan
                ]
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang, $kode)
    {
        $data = $barang->with('satuan')->find(['kode_barang' => $kode]);
        if ($data->count() > 0) {
            return view('admin.barang.edit', [
                'barang' => $data,
                'sideTitle' => 'barang'
            ]);
        } else {
            return redirect('daftar-barang');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $barang->where('kode_barang', $request->kode_barang)
            ->update([
                'barcode' => $request->barcode,
                'nama' => $request->nama,
                'stok' => $request->stok
            ]);
        if ($barang) {
            return response()->json([
                'message' => 'success',
                'data' => $barang
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    // Soft Delete
    public function delete(Barang $barang, $kode)
    {
        if ($barang->where('kode_barang', $kode)->delete()) {
            return response()->json([
                'message' => 'success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed'
            ], 500);
        }
    }
    // Permanent Delete
    public function destroy(Barang $barang)
    {
        //
    }
}
