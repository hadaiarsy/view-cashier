@extends('admin.temp.template')

@section('site-title', 'Transaksi')

@section('main-contents')

    <!-- daftar tab -->
    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-penjualan">
                <span>Penjualan</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-pembelian">
                <span>Pembelian</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <!-- transaksi penjualan -->
        <div class="tab-pane tabs-animation fade show active" id="tab-content-penjualan" role="tabpanel">
            <div class="main-card mb-3 card" style="display: none">
                <div class="card-body">
                    <h5 class="card-title">Data Member</h5>
                    <form class="needs-validation">
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
                            <h5 class="card-title">Data Penjualan</h5>
                            <div class="row">
                                <div class="col-8">
                                    <div class="row d-flex flex-row-reverse">
                                        <div class="col">
                                            <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <fieldset disabled="disabled">
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            placeholder="Nama Barang">
                                                    </fieldset>
                                                </div>
                                                <label for="diskonItem" class="col-sm-2 col-form-label">Disc</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control pay-section"
                                                            data-dataps="ps-1" id="diskonItem" value="">
                                                        <button type="button" class="input-group-text"
                                                            id="btnDiskonItem">%</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-4 col-form-label">Barcode</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="kodeBarang" id="kodeBarang">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control trans-section"
                                                            data-datats="ts-1" id="barcode" name="barcode">
                                                        <button type="button" class="input-group-text"
                                                            data-bs-toggle="modal" data-bs-target="#barangModal"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row d-flex">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label">Harga</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control trans-section" data-datats="ts-2"
                                                        value="" id="harga" name="harga">
                                                </div>
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Qty</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" value="" id="stok" name="stok"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row d-flex">
                                                <div class="col-sm-5">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control trans-section ts-3"
                                                            data-datats="ts-3" id="jumlah" name="jumlah" value="">
                                                        <button type="button" class="input-group-text"
                                                            id="btnJumlah">#</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <fieldset disabled="disabled">
                                                        <input type="text" class="form-control" value="" id="total"
                                                            name="total">
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-2 col-form-label">
                                                    <button class="btn btn-info btn-sm text-light" id="tambah"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                </div>
                                <div class="col-4">
                                    <div class="row d-flex flex-row-reverse">
                                        <div class="col-8 d-flex justify-content-end">
                                            <h4 class="text-danger border-bottom border-danger" id="totalText">Rp 0</h4>
                                        </div>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-1"
                                                id="diskon" value="">
                                            <button type="button" class="input-group-text" id="btnDiskon"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Kode Member :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-1"
                                                id="diskon" value="">
                                            <button type="button" class="input-group-text" id="btnDiskon">%</button>
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Diskon :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <button type="button" class="input-group-text" id="btnDiskon">Rp</button>
                                            <input type="text" class="form-control pay-section" data-dataps="ps-1"
                                                id="diskon" value="">
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Uang :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <button type="button" class="input-group-text" id="btnDiskon">Rp</button>
                                            <input type="text" class="form-control pay-section" data-dataps="ps-1"
                                                id="diskon" value="">
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Kembalian :</label>
                                    </div>
                                    <div class="row d-flex justify-content-end mt-2">
                                        <div class="col-4 d-flex justify-content-end">
                                            <button class="btn btn-info text-light" id="slsPrintTransc"><i
                                                    class="fas fa-save"></i> Selesai</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- transaksi pembelian -->
        <div class="tab-pane tabs-animation fade" id="tab-content-pembelian" role="tabpanel">
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
                            <h5 class="card-title">Data Pembelian</h5>
                            <div class="row mb-4">
                                <div class="col">
                                    <form class="form-inline">
                                        <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                            <label for="exampleEmail22" class="mr-sm-2">Kode Barang</label>
                                            <div class="input-group">
                                                <input name="email" id="exampleEmail22" placeholder="" type="text"
                                                    class="form-control" autofocus autocomplete="off">
                                                <button type="button" id="srcBtnItem"
                                                    class="input-group-text input-group-prepend btn btn-dark"
                                                    id="inputGroupPrepend"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                            <input name="password" id="examplePassword22" placeholder="Nama Barang"
                                                type="text" class="form-control" disabled>
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
        </div>

    </div>

    <script>
        $(document).ready(function() {
            // invert logo
            // $('#srcBtnItem').on('click', function(e) {
            //     console.log('ok')
            //     $('#fotoLogo').toggleClass('invert-img')
            // })
        })

    </script>

@endsection
