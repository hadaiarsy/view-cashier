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
        @if ($level != 2)
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-pembelian">
                    <span>Pembelian</span>
                </a>
            </li>
        @endif
    </ul>

    <div class="tab-content">

        <!-- transaksi penjualan -->
        <div class="tab-pane tabs-animation fade show active" id="tab-content-penjualan" role="tabpanel">
            <div class="row">
                <div class="col-lg">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Data Penjualan</h5>
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
                                                <table class="mb-0 table table-striped" id="tableItem">
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
                                            <h4 class="text-danger border-bottom border-danger" id="totalText">Rp 0</h4>
                                        </div>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-1"
                                                id="kodeMember" value="">
                                            <button type="button" class="input-group-text" id="btnKodeMember"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                        <label for="" class="col-4 col-form-label">Kode Member :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-2"
                                                id="diskon" name="diskon">
                                            <button type="button" class="input-group-text" id="btnDiskon">%</button>
                                        </div>
                                        <label for="diskon" class="col-4 col-form-label">Diskon :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <button type="button" class="input-group-text" id="btnUang">Rp</button>
                                            <input type="text" class="form-control pay-section" data-dataps="ps-3"
                                                id="uangTotal" value="">
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
                                            <input type="text" class="form-control pay-section" data-dataps="ps-4"
                                                id="kmblTotal" value="">
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Kembalian :</label>
                                    </div>
                                    <div class="row d-flex justify-content-end mt-2">
                                        <div class="col d-flex justify-content-end">
                                            <button type="button" class="btn btn-warning btn-sm mr-2" id="batal"><i
                                                    class="fas fa-times"></i> Batal</button>
                                            <button class="btn btn-info btn-sm text-light" id="slsPrintTransc"><i
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
        @if ($level != 2)
            @include('admin.transaksi.penjualan')
        @endif

    </div>

@endsection

@section('modals')
    {{-- Modal Data Barang --}}
    <div class="modal fade" id="barangModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barangModalLabel">Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <table class="table table-striped table-hover table-data-barang" id="tableItems">
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $b)
                                    <tr>
                                        <td>
                                            <p>{{ $b->kode_barang }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $b->barcode }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $b->nama }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $b->stok . ' ' . $b->satuan[0]->nama_satuan }}</p>
                                        </td>
                                        <td>
                                            <p>Rp {{ $b->satuan[0]->harga . ' / ' . $b->satuan[0]->nama_satuan }}</p>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm text-light add-item" data-bs-dismiss="modal"
                                                aria-label="Close" id="addItem[]" data-datakode="{{ $b->kode_barang }}"
                                                data-databarcode="{{ $b->barcode }}" data-datanama="{{ $b->nama }}"
                                                data-datastok="{{ $b->stok * $b->satuan[0]->rasio }}"
                                                data-datasatuan="{{ $b->satuan[0]->nama_satuan }}"
                                                data-datarasio="{{ $b->satuan[0]->rasio }}"
                                                data-dataharga="{{ $b->satuan[0]->harga }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal hapus item --}}
    <div class="modal fade" id="hapusItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusItemModalLabel">Peringatan!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hapusItem" id="hapusItem" value="">
                    <p>Anda yakin akan menghapus item ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="hapusBtnModal" data-bs-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    @yield('modal-e')
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            let globalUrl = 'http://127.0.0.1:8000/';
            $("#tableItems").DataTable();
            $('.alert-row').hide();
            $('.text-alert-total').hide();
            $('button#tambah').prop('disabled', true);
            let alertCheck = $('#tambah').data('start');
            (alertCheck) ? $('#tambah').prop('disabled', true): $('#tambah').prop('disabled', false);
            $('#batal').click();

            $('div#tableItems_length label select').on('change', function(e) {
                btnModalTambah();
            });

            $('div#tableItems_filter label input').on('change paste keyup', function(e) {
                btnModalTambah();
            });

            // set focus
            $('.trans-section[data-datats=ts-1]').focus();
            // end

            // window press f2
            $(this).on('keydown', function(event) {
                if (event.keyCode === 113) {
                    $('.pay-section[data-dataps=1]').focus();
                }
            });
            // end

            // get data member
            let getMember = () => axios.get(globalUrl + 'getall-member/')
                .then((response) => {
                    $('#namaCustList').empty();
                    let data = response.data.member;
                    let datalist = '';
                    for (let i = 0; i < data.length; i++) {
                        datalist = "<option value='" + data[i].nama + '__' + data[i].kode_member + "'>";
                        $('#namaCustList').append(datalist);
                    }
                }).catch((error) => {
                    console.log(error);
                })
            getMember();
            // end

            // get data barang
            let getBarang = () => axios.get(globalUrl + 'getall-barang/')
                .then((response) => {
                    $('table.table-data-barang').find('tbody').empty();
                    let data = response.data.barang;
                    for (let i = 0; i < data.length; i++) {
                        let dataLoop =
                            "<tr><td><p>" +
                            data[i].kode_barang +
                            "</p></td><td><p>" +
                            (data[i].barcode == null ? '-' : data[i].barcode) +
                            "</p></td><td><p>" + data[i].nama +
                            "</p></td><td><p>" + data[i].stok + ' ' + data[i].satuan[0].nama_satuan +
                            "</p></td><td><p>" + currencyIdr(String(data[i].satuan[0].harga), 'Rp ') + ' / ' +
                            data[i]
                            .satuan[
                                0].nama_satuan +
                            "</p></td><td><button class='btn btn-info btn-sm text-light add-item' data-bs-dismiss='modal'aria-label='Close' id='addItem[]' data-datakode='" +
                            data[i].kode_barang + "' data-databarcode='" + data[i].barcode +
                            "' data-datanama='" + data[i].nama + "' data-datastok='" + data[i].stok * data[i]
                            .satuan[0].rasio + "' data-datasatuan='" + data[i].satuan[0].nama_satuan +
                            "' data-datarasio='" + data[i].satuan[0].rasio +
                            "' data-dataharga='" + data[i].satuan[0].harga +
                            "'><i class='fas fa-plus text-light'></i></button></td></tr>";
                        $('.table-data-barang').find('tbody').append(dataLoop);
                        btnModalTambah();
                    }
                }).catch((error) => {
                    console.log(error);
                })
            getBarang();
            // end

            // button batal
            $('#batal').on('click', function(e) {
                $('#namaCust').val('');
                $('#unitCust').val('');
                $('#teleponCust').val('');
                $('#alamatCust').val('');
                $('#kodeBarang').val('');
                $('#barcode').val('');
                $('#nama').val('');
                $('#harga').val('');
                $('#stok').val('');
                $('#jumlah').val('');
                $('#btnJumlah').html('#');
                $('#total').val('');
                $('.itemRow').remove();
                $('#diskon').val('');
                $('#uangTotal').val('');
                $('#kmblTotal').val('');
                totalHarga();
                $('#barcode').focus();
                $('#slsPrintTransc').prop('disabled', true);
            });
            // end

            // loop pay section
            let paySection = $('.pay-section');
            for (let i = 0; i < paySection.length; ++i) {
                $(paySection[i]).on('keydown', function(e) {
                    if (event.keyCode === 13) {
                        let loop = $(this).data('dataps');
                        loop = loop.replace('ps-', '')
                        loop = parseInt(loop) + 1;
                        let nextID = $(".pay-section[data-dataps=ps-" + loop + "]");
                        if (nextID.length) {
                            idNum = loop;
                        } else {
                            idNum = 1;
                            let totalText = replaceCurrency($('#totalText').html());
                            if (totalText != 0)
                                $('#slsPrintTransc').click();
                        }
                        $(".pay-section[data-dataps=ps-" + idNum + "]").focus();
                    } else if (event.keyCode === 113) {
                        $('.trans-section[data-datats=ts-1]').focus();
                    }
                });
            }

            // loop focus enter
            let transSect = $('.trans-section');
            for (let i = 0; i < transSect.length; i++) {
                $(transSect[i]).on("keydown", function(event) {
                    if (event.keyCode === 13) {
                        let loop = $(this).data('datats');
                        loop = loop.replace('ts-', '');
                        loop = parseInt(loop) + 1;
                        let nextID = $(".trans-section[data-datats=ts-" + loop + "]");
                        if (nextID.length) {
                            idNum = loop;
                            $(".trans-section[data-datats=ts-" + idNum + "]").focus();
                        } else {
                            idNum = 1;
                            let kodeCheck = $('#kodeBarang').val();
                            let jumlah = Number($(this).val());
                            let stok = Number($('#stok').val());
                            let totalCheck = (jumlah > stok) ? true : false;
                            if (kodeCheck == '' || totalCheck) {
                                $('#tambah').prop('disabled', true);
                                $(".trans-section[data-datats=ts-" + transSect.length + "]").focus();
                            } else {
                                $('#tambah').click();
                                $('#tambah').prop('disabled', false);
                                $(".trans-section[data-datats=ts-" + idNum + "]").focus();
                            }
                        };
                    } else if (event.keyCode == 113) {
                        $('.pay-section[data-dataps=ps-1]').focus();
                    }
                });
            }
            // end

            // check tombol selesai
            $('#slsPrintTransc').attr('disabled', true);
            $('#uangTotal').keyup(function() {
                if ($(this).val().length != 0)
                    $('#slsPrintTransc').attr('disabled', false);
                else
                    $('#slsPrintTransc').attr('disabled', true);
            })
            // end

            // check barcode
            $('#barcode').on('change paste', function(e) {
                let barcode = $(this).val();
                axios.get(globalUrl + 'show-barang-transaksi/' + barcode)
                    .then((response) => {
                        let data = response.data.barang[0];
                        $('#kodeBarang').val(data.kode_barang);
                        $('#nama').val(data.nama);
                        $('#harga').val(currencyIdr(String(data.satuan[0].harga), 'Rp '));
                        $('#stok').val(data.stok);
                        $('#jumlah').val(1);
                        $('#btnJumlah').html(data.satuan[0].nama_satuan);
                        $('#total').val(currencyIdr(String(data.satuan[0].harga * 1), 'Rp '));
                        $('.alert-row').hide();
                        $('#tambah').prop('disabled', false);
                    }).catch((error) => {
                        console.log(error.response);
                        let brcd = $(this).val();
                        $('#kodeBarang').val('');
                        $('#nama').val('');
                        $('#harga').val('');
                        $('#stok').val('');
                        $('#jumlah').val('');
                        $('#total').val('');
                        $('#btnJumlah').html('#');
                        $('#tambah').prop('disabled', true);
                        if (brcd != '') {
                            $('.alert-row').show();
                        } else {
                            $('.alert-row').hide();
                            $('#tambah').prop('disabled', false);
                        }
                    })
            });
            // end

            // diskon per-item
            $('#diskonItem').on('change paste keyup', function(e) {
                let val = Number($(this).val());
                if (val < 0 || val > 20)
                    $(this).val('0');
                hitungTotal();
            });

            // check kepastian harga
            $('#harga').on('change paste keyup', function(e) {
                $(this).val(currencyIdr(String($(this).val()), 'Rp '));
                let jumlah = Number($('#jumlah').val());
                let stok = Number($('#stok').val());
                let harga = Number($(this).val().split(".").join("").split("Rp").join(""));
                hitungTotal();
            });
            // end

            // check kesediaan jumlah
            $('#jumlah').on('keyup', function(e) {
                let jumlah = Number($(this).val());
                let stok = Number($('#stok').val());
                let harga = Number($('#harga').val().split(".").join("").split("Rp").join(""));
                let total = (jumlah > stok) ? true : false;
                if (total || jumlah <= 0) {
                    jumlah = Number($(this).val());
                    stok = Number($('#stok').val());
                    hitungTotal();
                    $('.alert-row').show();
                    $('#tambah').prop('disabled', true);
                    $(this).addClass('text-danger');
                } else {
                    hitungTotal(jumlah, harga);
                    $('.alert-row').hide();
                    $('#tambah').prop('disabled', false);
                    $(this).removeClass('text-danger');
                }
            });
            // end

            // fungsi hitung total
            function hitungTotal() {
                let diskon = Number($('#diskonItem').val());
                let harga = Number(replaceCurrency($('#harga').val()));
                let jumlah = Number($('#jumlah').val());
                let total = jumlah * harga;
                if (diskon > 0)
                    total = total - (total * (diskon / 100));
                $('#total').val(currencyIdr(String(total), 'Rp '));
            }
            // end

            // isi form transaksi tombol modal tambah
            let btnModalTambah = () => $("button.add-item").on("click", function(e) {
                var data = {
                    kode: $(this).data('datakode'),
                    barcode: $(this).data('databarcode'),
                    nama: $(this).data('datanama'),
                    stok: $(this).data('datastok'),
                    harga: $(this).data('dataharga'),
                    namaSatuan: $(this).data('datasatuan'),
                };
                let kode = $("#kodeBarang").val(data.kode);
                let barcode = $("#barcode").val(data.barcode);
                let nama = $("#nama").val(data.nama);
                let stok = $("#stok").val(data.stok);
                let harga = $("#harga").val(currencyIdr(String(data.harga), 'Rp '));
                let namaSatuan = $("#btnJumlah").html(data.namaSatuan);
                let jumlah = $("#jumlah").val(1);
                let ttl = data.harga * 1;
                let total = $("#total").val(currencyIdr(String(ttl), 'Rp '));
                $('.alert-row').hide();
                $('#tambah').prop('disabled', false);
                $('#diskon').change();
            });
            // end

            // tambah row transaksi
            $("#tambah").on("click", function(e) {
                let data = {
                    kode: $("#kodeBarang").val(),
                    nama: $("#nama").val(),
                    jumlah: $("#jumlah").val(),
                    btnJumlah: $("#btnJumlah").html(),
                    total: $("#total").val(),
                };
                let numInt = $("#tableItem").find("tbody").children().length + 1;
                let childTable =
                    "<tr class='itemRow' id='itemRow[" + numInt + "]'><td class='kode-barang'>" + data
                    .kode +
                    "</td><td class='nama-barang' id='namaItm" + numInt + "'>" +
                    data
                    .nama +
                    "</td><td id='jumlahItm" + numInt + "'><span class='jumlah-barang'>" + data.jumlah +
                    "</span> <span class='satuan-barang'>" + data.btnJumlah +
                    "</td><td class='totalHrg harga-barang' id='totalItm" + numInt + "'>" + data.total +
                    "</td><td><a class='btn btn-danger btn-sm btn-hapus' data-id='itemRow[" +
                    numInt +
                    "]' data-bs-toggle='modal' data-bs-target='#hapusItemModal' data-dataid='item" +
                    numInt + "'><i class='fas fa-trash-alt'></i></a></td></tr>";
                $("#tableItem").find("tbody").append(childTable);
                totalHarga();
                hapusRow(true);
                $('#barcode').focus();
                $('#kodeBarang').val('');
                $('#barcode').val('');
                $('#nama').val('');
                $('#harga').val('');
                $('#stok').val('');
                $('#jumlah').val('');
                $('#btnJumlah').html('#');
                $('#total').val('');
                $('#diskon').change();
            });
            // end

            // set value hapus
            function hapusRow(check = false) {
                if (check) {
                    let btnHapus = $('.btn-hapus');
                    for (let i = 0; i < btnHapus.length; i++) {
                        $(btnHapus[i]).on('click', function(event) {
                            $('#hapusItem').val($(this).data('id'));
                        });
                    }
                }
            }
            // end

            // hapus row
            $("#hapusBtnModal").on("click", function(e) {
                let itemID = $("#hapusItem").val();
                document.getElementById(itemID).remove();

                totalHarga();
                $('#diskon').change();
                $('#barcode').focus();
            });
            // end

            // hitung total harga transaksi
            function totalHarga() {
                $("#totalText").html(function() {
                    var a = 0;
                    $(".totalHrg").each(function() {
                        a += parseInt(Number($(this).html().split(".").join("").split("Rp").join(
                            "")));
                    });
                    return currencyIdr(String(a), 'Rp ');
                });
                if (Number($('#totalText').html().split(".").join("").split("Rp").join("")) == 0) {
                    $('#diskon').val('');
                    $('#uangTotal').val('');
                    $('#kmblTotal').val('');
                }
                return $("#totalText").html();
            };
            // end

            // hitung diskon
            $('#diskon').on('change paste keyup', function(e) {
                let diskon = $('#diskon').val();
                (Number(diskon) > 20) ? diskon = true: diskon = false;
                (diskon) ? $('#diskon').val(0): $('#diskon').val($('#diskon').val());
                let total = Number(totalHarga().split(".").join("").split("Rp").join(""));
                diskon = Number($('#diskon').val());
                let uang = Number($('#uangTotal').val().split(".").join("").split("Rp").join(""));
                total = total - (total * (diskon / 100));
                if (total > 0) {
                    $('#totalText').html(currencyIdr(String(Math.ceil(Math.floor(total))), 'Rp '));
                }
                if (uang > 0) {
                    let kmbl = uang - total;
                    $("#kmblTotal").val(currencyIdr(String(kmbl), 'Rp '));
                }
            });
            // end

            // hitung kembalian (uang) transaksi
            $("#uangTotal").on("change paste keyup", function() {
                $(this).val(currencyIdr($(this).val(), 'Rp '));
                let uang = Number($(this).val().split(".").join("").split("Rp").join(""));
                let total = Number($("#totalText").html().split(".").join("").split("Rp").join(""));
                let kmbl = uang - total;
                if (kmbl < 0) {
                    $("#kmblTotal").val('');
                    $('#slsPrintTransc').prop('disabled', true);
                    $('.text-alert-total').show();
                    $(this).addClass('text-danger');
                } else {
                    $("#kmblTotal").val(currencyIdr(String(kmbl), 'Rp '));
                    $('#slsPrintTransc').prop('disabled', false);
                    $('.text-alert-total').hide();
                    $(this).removeClass('text-danger');
                }
            });
            // end

            // proses simpan ke database
            $("#slsPrintTransc").on("click", function() {
                let idKasir = $('#idKasir').val();
                let namaMember = $('#namaCust').val();
                let unitMember = $('#unitCust').val();
                let teleponMember = $('#teleponCust').val();
                let alamatMember = $('#alamatCust').val();
                let isLunas = 'true';
                let d = new Date();
                let month = d.getMonth() + 1;
                let day = d.getDate();
                let outputDate = (day < 10 ? '0' : '') + day + '-' +
                    (month < 10 ? '0' : '') + month + '-' +
                    d.getFullYear();
                let noResi = $("#noResi").val();
                let ttlSm = $("#totalText").html();
                let diskon = Number($("#diskon").val());
                let uang = $("#uangTotal").val();
                let kmbl = $("#kmblTotal").val();
                let row = $('.itemRow');
                let dataBarang = [];
                for (let i = 0; i < row.length; i++) {
                    dataBarang.push({
                        kode: $(row[i]).find('td.kode-barang').html(),
                        nama: $(row[i]).find('td.nama-barang').html(),
                        jumlah: $(row[i]).find('span.jumlah-barang').html(),
                        satuan: $(row[i]).find('span.satuan-barang').html(),
                        harga: replaceCurrency($(row[i]).find('td.harga-barang').html())
                    });
                }
                let data = {
                    outputDate: outputDate,
                    ttlSm: ttlSm,
                    isLunas: isLunas,
                    diskon: diskon,
                    uang: uang,
                    kmbl: kmbl,
                    dataBarang: dataBarang
                };
                // proses ajax simpan
                let token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post(globalUrl + 'simpan-transaksi', {
                        no_resi: noResi,
                        tanggal: outputDate,
                        jenis_transaksi: 'penjualan',
                        kasir_id: idKasir,
                        nama_member: namaMember,
                        unit_member: unitMember,
                        telepon_member: teleponMember,
                        alamat_member: alamatMember,
                        jenis_member: 'customer',
                        total: replaceCurrency(ttlSm),
                        diskon: diskon,
                        is_lunas: isLunas,
                        detail_transaksi: dataBarang
                    })
                    .then((response) => {
                        console.log(response.data);
                        data['idKasir'] = response.data.id_kasir;
                        data['noResi'] = response.data.no_resi;
                        getMember();
                        getBarang();
                        printStruk(data);
                        $('#batal').click();
                    })
                    .catch((error) => {
                        console.log(error)
                    });
                // end
            });
            // end

            // proses print strik
            function printStruk(data) {
                let total = 0;
                $(".totalHrg").each(function() {
                    total += parseInt(Number(replaceCurrency($(this).html())));
                });
                let printStruk = window.open(globalUrl + 'test-struk/' + data.noResi + '/' + total + '/' + data
                    .uang + '/' + data.kmbl);
                let tmout = setTimeout(function() {
                    printStruk.close()
                }, 3000);
            }
            // end

            $('#piutangCheck').on('change', function() {
                let piutang;
                if ($(this).is(':checked')) {
                    piutang = 'ok';
                    $('#slsPrintTransc').prop('disabled', false);
                } else {
                    piutang = 'nope';
                }
                console.log(piutang)
            });
        });

    </script>
@endsection
