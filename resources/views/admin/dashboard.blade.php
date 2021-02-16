@extends('admin.temp.template')

@section('site-title', 'Dashboard')

@section('contents')
    <div class="row">
        <div class="col-sm-2">
            <h4>Dashboard</h4>
            <hr class="divider">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="card-title">380</h5>
                    <p class="card-text">Transaksi Bulan Januari</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="card-title">Rp100.000.000,-</h5>
                    <p class="card-text">Pemasukkan Bulan Januari</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="card-title">Rp10.000.000,-</h5>
                    <p class="card-text">Pengeluaran Bulan Januari</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="card-title">150</h5>
                    <p class="card-text">Pembelian Bulan Januari</p>
                </div>
            </div>
        </div>
    </div>
@endsection
