<div class="tab-pane tabs-animation fade" id="tab-content-pembelian" role="tabpanel">
    <div class="row">
        <div class="col-lg">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Data Pembelian</h5>
                    <div class="row alert-row" style="display: none">
                        <div class="alert alert-danger alert-row" data-start="true" role="alert">
                            Data Barang <strong>Tidak</strong> Tersedia! Harap cek kembali form
                            <strong>Transaksi</strong> di bawah!
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="row d-flex flex-row-reverse">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <fieldset disabled="disabled">
                                                <input type="text" class="form-control" name=""
                                                    placeholder="Nama Barang">
                                            </fieldset>
                                        </div>
                                        <label for="diskonItem" class="col-sm-2 col-form-label">Disc</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="">
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
                                            <input type="hidden" name="" id="kodeBarang">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="">
                                                <button type="button" class="input-group-text"><i
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
                                            <input type="text" class="form-control" value="" name="">
                                        </div>
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Qty</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="" name="" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row d-flex">
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="" value="">
                                                <button type="button" class="input-group-text">#</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <fieldset disabled="disabled">
                                                <input type="text" class="form-control" value="" name="">
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <button class="btn btn-info btn-sm text-light"><i
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
                                                    <th scope="col">Kode</th>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">#</th>
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
                                    <h4 class="text-danger border-bottom border-danger">Rp 0</h4>
                                </div>
                            </div>
                            <div class="row d-flex flex-row-reverse mt-2">
                                <div class="col-6 input-group">
                                    <input type="text" class="form-control" value="">
                                    <button type="button" class="input-group-text"><i
                                            class="fas fa-search"></i></button>
                                </div>
                                <label for="inputPassword3" class="col-4 col-form-label">Kode Member :</label>
                            </div>
                            <div class="row d-flex flex-row-reverse mt-2">
                                <div class="col-6 input-group">
                                    <input type="text" class="form-control" value="">
                                    <button type="button" class="input-group-text">%</button>
                                </div>
                                <label for="inputPassword3" class="col-4 col-form-label">Diskon :</label>
                            </div>
                            <div class="row d-flex flex-row-reverse mt-2">
                                <div class="col-6 input-group">
                                    <button type="button" class="input-group-text">Rp</button>
                                    <input type="text" class="form-control" value="">
                                </div>
                                <label for="inputPassword3" class="col-4 col-form-label">Uang :</label>
                            </div>
                            <div class="row flex-row-reverse mt-2 text-alert-total" style="display: none">
                                <div class="row mt-2 text-end">
                                    <p class="text-danger text-alert-total">Uang anda tidak cukup!</p>
                                </div>
                            </div>
                            <div class="row d-flex flex-row-reverse mt-2">
                                <div class="col-6 input-group">
                                    <button type="button" class="input-group-text" id="btnKmbl">Rp</button>
                                    <input type="text" class="form-control" value="">
                                </div>
                                <label for="inputPassword3" class="col-4 col-form-label">Kembalian :</label>
                            </div>
                            <div class="row d-flex justify-content-end mt-2">
                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning btn-sm mr-2"><i
                                            class="fas fa-times"></i> Batal</button>
                                    <button class="btn btn-info btn-sm text-light"><i class="fas fa-save"></i>
                                        Selesai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
