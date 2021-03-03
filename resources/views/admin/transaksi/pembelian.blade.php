<div class="tab-pane tabs-animation fade" id="tab-content-pembelian" role="tabpanel">
    <div class="row">
        <div class="col-lg">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Data Pembelian</h5>
                    <div class="row alert-row-pembelian" style="display: none">
                        <div class="alert alert-danger" data-start="true" role="alert">
                            Data Barang <strong>Tidak</strong> Tersedia! Harap cek kembali form
                            <strong>Transaksi</strong> di bawah! <span>Abaikan jika inign mendaftarkan <strong>Barang
                                    baru</strong></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-2">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" id="isBarangBaru">
                                                    Barang Baru
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="hidden" name="kodeBarangPembelian"
                                                    id="kodeBarangPembelian">
                                                <input type="text" class="form-control" id="barcodePembelian"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="barcodePembelian">Barcode</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="namaBarangPembelian"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="namaBarangPembelian">Nama Barang</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="hargaPembelian"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="hargaPembelian">Harga</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mt-3">
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="jumlahPembelian"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="jumlahPembelian">Qty</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="namaSatuanPembelian"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="namaSatuanPembelian">Nama Satuan</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="totalPembelian"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="totalPembelian">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-2 justify-content-center">
                                            <button class="btn btn-warning btn-sm text-light"
                                                id="searchBarangPembelian"><i class="fas fa-search"></i></button>
                                            <button class="btn btn-info btn-sm text-light ml-4" id="tambahPembelian"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container ps--active-y">
                                        <table class="mb-0 table table-striped" id="tablePembelian">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Barcode</th>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Total</th>
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
                                    <h4 class="text-danger border-bottom border-danger" id="totalTextPembelian">Rp 0
                                    </h4>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end mt-2">
                                <div class="col d-flex justify-content-end">
                                    <button type="button" id="batalPembelian" class="btn btn-warning btn-sm mr-2"><i
                                            class="fas fa-times"></i> Batal</button>
                                    <button class="btn btn-info btn-sm text-light" id="selesaiPembelian"><i
                                            class="fas fa-save"></i>
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

@section('modal-e')
    {{-- Modal hapus item --}}
    <div class="modal fade" id="hapusItemPembelianModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusItemModalLabel">Peringatan!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hapusItemPembelian" id="hapusItemPembelian" value="">
                    <p>Anda yakin akan menghapus item ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="hapusBtnPembelianModal"
                        data-bs-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-e')
    <script>
        $(document).ready(function() {
            const globalUrl = 'http://127.0.0.1:8000/';

            // check barang baru
            function barangBaru() {
                let barangBaru;
                if ($('#isBarangBaru').is(':checked')) {
                    barangBaru = true;
                } else {
                    barangBaru = false;
                }
                return barangBaru;
            };

            // check barcode
            $('#barcodePembelian').on('change paste keyup', function(e) {
                let barcode = $(this).val();
                axios.get(globalUrl + 'show-barang-transaksi/' + barcode)
                    .then((response) => {
                        let data = response.data.barang[0];
                        console.log(data);
                        $('#kodeBarangPembelian').val(data.kode_barang);
                        $('#namaBarangPembelian').val(data.nama);
                        $('#hargaPembelian').val(currencyIdr(String(data.satuan[0].harga_beli), 'Rp '));
                        $('#namaSatuanPembelian').val(data.satuan[0].nama_satuan);
                        $('.alert-row-pembelian').hide();
                    }).catch((error) => {
                        console.log(error.response);
                        $('.alert-row-pembelian').show();
                        if (barcode == '') $('.alert-row-pembelian').hide();
                    })
            });
            // end

            // input qty(jumlah)
            $('#jumlahPembelian').on('change paste keyup', function(e) {
                let jml = $(this).val();
                let harga = $('#hargaPembelian').val();
                hitungTotalPembelian(jml, replaceCurrency(harga));
            })

            // input harga
            $('#hargaPembelian').on('change paste keyup', function(e) {
                let harga = $(this).val();
                let jml = $('#jumlahPembelian').val();
                $(this).val(currencyIdr($(this).val(), 'Rp '));
                hitungTotalPembelian(jml, replaceCurrency(harga));
            })

            // input total
            $('#totalPembelian').on('change paste keyup', function(e) {
                $(this).val(currencyIdr($(this).val(), 'Rp '));
            })

            // fungsi hitung total Pembelian
            function hitungTotalPembelian(a, b) {
                let total = a * b;
                $('#totalPembelian').val(currencyIdr(String(total), 'Rp '));
            }
            // end

            // tambah row Pembelian
            $('#tambahPembelian').on('click', function(e) {
                let data = {
                    kodeBarang: $('#kodeBarangPembelian').val(),
                    barcode: $('#barcodePembelian').val(),
                    namaBarang: $('#namaBarangPembelian').val(),
                    harga_beli: $('#hargaPembelian').val(),
                    jumlah: $('#jumlahPembelian').val(),
                    namaSatuan: $('#namaSatuanPembelian').val(),
                    total: $('#totalPembelian').val(),
                    isBarangBaru: barangBaru(),
                };
                console.log(data);
                let numInt = $("#tablePembelian").find("tbody").children().length + 1;
                let childTable =
                    "<tr class='itemRowPembelian' id='itemPembelianRow[" + numInt +
                    "]'><td class='barang-baru-pembelian' style='display: none'>" +
                    data.isBarangBaru + "</td><td class='kode-barang-pembelian' style='display: none'>" +
                    data.kodeBarang + "</td><td class='barcode-barang-pembelian'>" +
                    data
                    .barcode +
                    "</td><td class='nama-barang-pembelian' id='namaItm" + numInt + "'>" +
                    data
                    .namaBarang +
                    "</td><td class='harga-barang-pembelian' id='hargaItm" + numInt + "'>" +
                    data
                    .harga_beli +
                    "</td><td id='jumlahItm" + numInt + "'><span class='jumlah-barang-pembelian'>" + data
                    .jumlah +
                    "</span> <span class='satuan-barang-pembelian'>" + data.namaSatuan +
                    "</span></td><td class='totalHrgPembelian total-barang-pembelian' id='totalItm" +
                    numInt + "'>" +
                    data
                    .total +
                    "</td><td><a class='btn btn-danger btn-sm btn-hapus-pembelian' data-id='itemPembelianRow[" +
                    numInt +
                    "]' data-bs-toggle='modal' data-bs-target='#hapusItemPembelianModal' data-dataid='item" +
                    numInt + "'><i class='fas fa-trash-alt'></i></a></td></tr>";
                $("#tablePembelian").find("tbody").append(childTable);
                hapusRowPembelian(true);
                totalHargaPembelian();
                $('.alert-row-pembelian').hide();
                $('#isBarangBaru').prop('checked', false);
                $('#kodeBarangPembelian').val('');
                $('#barcodePembelian').focus();
                $('#barcodePembelian').val('');
                $('#namaBarangPembelian').val('');
                $('#hargaPembelian').val('');
                $('#jumlahPembelian').val('');
                $('#namaSatuanPembelian').val('');
                $('#totalPembelian').val('');
            })

            // set value hapus
            function hapusRowPembelian(check = false) {
                if (check) {
                    let btnHapus = $('.btn-hapus-pembelian');
                    for (let i = 0; i < btnHapus.length; i++) {
                        $(btnHapus[i]).on('click', function(event) {
                            $('#hapusItemPembelian').val($(this).data('id'));
                        });
                    }
                }
            }
            // end

            // hapus row
            $("#hapusBtnPembelianModal").on("click", function(e) {
                let itemID = $("#hapusItemPembelian").val();
                document.getElementById(itemID).remove();
                totalHargaPembelian();
            });
            // end

            // hitung total harga transaksi
            function totalHargaPembelian() {
                $("#totalTextPembelian").html(function() {
                    var a = 0;
                    $(".totalHrgPembelian").each(function() {
                        a += parseInt(Number(replaceCurrency($(this).html())));
                    });
                    return currencyIdr(String(a), 'Rp ');
                });
                if (Number(replaceCurrency($('#totalTextPembelian').html())) == 0) {

                }
                return $("#totalTextPembelian").html();
            };
            // end

            // tombol batal pembelian
            $('#batalPembelian').on('click', function() {
                $('.alert-row-pembelian').hide();
                $('#isBarangBaru').prop('checked', false);
                $('#kodeBarangPembelian').val('');
                $('#barcodePembelian').focus();
                $('#barcodePembelian').val('');
                $('#namaBarangPembelian').val('');
                $('#hargaPembelian').val('');
                $('#jumlahPembelian').val('');
                $('#namaSatuanPembelian').val('');
                $('#totalPembelian').val('');
                $('.itemRowPembelian').remove();
                totalHargaPembelian();
            });
            // end

            // tombol selesai pembelian
            $('#selesaiPembelian').on('click', function() {
                let totalPembelian = $('#totalTextPembelian').html();
                let row = $('.itemRowPembelian');
                let dataBarangPembelian = [];

                let d = new Date();
                let month = d.getMonth() + 1;
                let day = d.getDate();
                let outputDate = (day < 10 ? '0' : '') + day + '-' +
                    (month < 10 ? '0' : '') + month + '-' +
                    d.getFullYear();

                for (let i = 0; i < row.length; i++) {
                    dataBarangPembelian.push({
                        baru: $(row[i]).find('td.barang-baru-pembelian').html(),
                        kode: $(row[i]).find('td.kode-barang-pembelian').html(),
                        barcode: $(row[i]).find('td.barcode-barang-pembelian').html(),
                        nama: $(row[i]).find('td.nama-barang-pembelian').html(),
                        jumlah: Number($(row[i]).find('span.jumlah-barang-pembelian').html()),
                        satuan: $(row[i]).find('span.satuan-barang-pembelian').html(),
                        harga: replaceCurrency($(row[i]).find('td.harga-barang-pembelian').html()),
                        total: replaceCurrency($(row[i]).find('td.total-barang-pembelian').html())
                    });
                };

                // proses ajax simpan pembelian
                let token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post(globalUrl + 'simpan-transaksi', {
                        tanggal: outputDate,
                        jenis_transaksi: 'pembelian',
                        total: replaceCurrency(totalPembelian),
                        detail_transaksi: dataBarangPembelian
                    })
                    .then((response) => {
                        console.log(response);
                        $('#batalPembelian').click();
                    })
                    .catch((error) => {
                        console.log(error)
                    });
                // end

            });
            // end

        })

    </script>
@endsection
