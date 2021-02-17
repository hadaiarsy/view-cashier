@extends('admin.temp.template')

@section('site-title', 'Transaksi')

@section('main-contents')

    <div class="main-card mb-3 card" style="display: none">
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
    <div class="row">
        <div class="col-lg">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Data Transaksi</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <form class="form-inline">
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <label for="exampleEmail22" class="mr-sm-2">Kode Barang</label>
                                    <div class="input-group">
                                        <input name="email" id="exampleEmail22" placeholder="" type="text"
                                            class="form-control" autofocus autocomplete="off">
                                        <button type="button" class="input-group-text input-group-prepend btn btn-dark"
                                            id="inputGroupPrepend"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <input name="password" id="examplePassword22" placeholder="Nama Barang" type="text"
                                        class="form-control" disabled>
                                </div>
                                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container ps--active-y">
                                    <table class="mb-0 table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Item</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <h4>OK</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>


    </script>

@endsection
