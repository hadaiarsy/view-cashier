@extends('admin.temp.template')

@section('site-title', 'Transaksi')

@section('main-contents')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Data Member</h5>
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label for="kodeMember">Kode Member</label>
                        <input type="text" class="form-control" id="kodeMember" placeholder="0.0000eg" value="">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
