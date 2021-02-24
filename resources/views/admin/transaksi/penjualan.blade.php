<div class="tab-pane tabs-animation fade" id="tab-content-pembelian" role="tabpanel">
    <div class="row">
        <div class="col-lg">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Data Pembelian</h5>
                    <div class="row alert-row-penjualan" style="display: none">
                        <div class="alert alert-danger alert-row" data-start="true" role="alert">
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
                                                <input type="hidden" name="kodeBarangPenjualan"
                                                    id="kodeBarangPenjualan">
                                                <input type="text" class="form-control" id="barcodePenjualan"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="barcodePenjualan">Barcode</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="namaBarangPenjualan"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="namaBarangPenjualan">Nama Barang</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="hargaPenjualan"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="hargaPenjualan">Harga</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mt-3">
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="jumlahPenjualan"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="jumlahPenjualan">Qty</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="namaSatuanPenjualan"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="namaSatuanPenjualan">Nama Satuan</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="totalPenjualan"
                                                    placeholder="0,000.eg" autofocus>
                                                <label for="totalPenjualan">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-2 justify-content-center">
                                            <button class="btn btn-info btn-sm text-light" id="tambahPenjualan"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container ps--active-y">
                                        <table class="mb-0 table table-striped" id="tablePenjualan">
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
                                    <h4 class="text-danger border-bottom border-danger" id="totalTextPenjualan">Rp 0
                                    </h4>
                                </div>
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

@section('modal-e')
    {{-- Modal hapus item --}}
    <div class="modal fade" id="hapusItemPenjualanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusItemModalLabel">Peringatan!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hapusItemPenjualan" id="hapusItemPenjualan" value="">
                    <p>Anda yakin akan menghapus item ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="hapusBtnPenjualanModal"
                        data-bs-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
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
        $('#barcodePenjualan').on('change paste keyup', function(e) {
            let barcode = $(this).val();
            axios.get('/show-barang-transaksi/' + barcode)
                .then((response) => {
                    let data = response.data.barang[0];
                    console.log(data);
                    $('#kodeBarangPenjualan').val(data.kode_barang);
                    $('#namaBarangPenjualan').val(data.nama);
                    $('#hargaPenjualan').val(currencyIdr(String(data.satuan[0].harga), 'Rp '));
                    $('#namaSatuanPenjualan').val(data.satuan[0].nama_satuan);
                    $('.alert-row-penjualan').hide();
                }).catch((error) => {
                    console.log(error.response);
                    $('.alert-row-penjualan').show();
                })
        });
        // end

        // input qty(jumlah)
        $('#jumlahPenjualan').on('change paste keyup', function(e) {
            let jml = $(this).val();
            let harga = $('#hargaPenjualan').val();
            hitungTotalPenjualan(jml, replaceCurrency(harga));
        })

        // input harga
        $('#hargaPenjualan').on('change paste keyup', function(e) {
            let harga = $(this).val();
            let jml = $('#jumlahPenjualan').val();
            $(this).val(currencyIdr($(this).val(), 'Rp '));
            hitungTotalPenjualan(jml, replaceCurrency(harga));
        })

        // input total
        $('#totalPenjualan').on('change paste keyup', function(e) {
            $(this).val(currencyIdr($(this).val(), 'Rp '));
        })

        // fungsi hitung total penjualan
        function hitungTotalPenjualan(a, b) {
            let total = a * b;
            $('#totalPenjualan').val(currencyIdr(String(total), 'Rp '));
        }
        // end

        // tambah row penjualan
        $('#tambahPenjualan').on('click', function(e) {
            let data = {
                kodeBarang: $('#kodeBarangPenjualan').val(),
                barcode: $('#barcodePenjualan').val(),
                namaBarang: $('#namaBarangPenjualan').val(),
                harga: $('#hargaPenjualan').val(),
                jumlah: $('#jumlahPenjualan').val(),
                namaSatuan: $('#namaSatuanPenjualan').val(),
                total: $('#totalPenjualan').val(),
                isBarangBaru: barangBaru(),
            };
            console.log(data);
            let numInt = $("#tablePenjualan").find("tbody").children().length + 1;
            let childTable =
                "<tr class='itemRow' id='itemPenjualanRow[" + numInt +
                "]'><td class='barang-baru' style='display: none'>" +
                data.isBarangBaru + "</td><td class='kode-barang-penjualan' style='display: none'>" +
                data.kodeBarang + "</td><td class='barcode-barang-penjualan'>" +
                data
                .barcode +
                "</td><td class='nama-barang-penjualan' id='namaItm" + numInt + "'>" +
                data
                .namaBarang +
                "</td><td class='harga-barang' id='hargaItm" + numInt + "'>" +
                data
                .harga +
                "</td><td id='jumlahItm" + numInt + "'>" + data.jumlah +
                " <span class='jumlah-barang'>" + data.namaSatuan +
                "</span></td><td class='totalHrgPenjualan harga-barang' id='totalItm" + numInt + "'>" +
                data
                .total +
                "</td><td><a class='btn btn-danger btn-sm btn-hapus-penjualan' data-id='itemPenjualanRow[" +
                numInt +
                "]' data-bs-toggle='modal' data-bs-target='#hapusItemPenjualanModal' data-dataid='item" +
                numInt + "'><i class='fas fa-trash-alt'></i></a></td></tr>";
            $("#tablePenjualan").find("tbody").append(childTable);
            hapusRowPenjualan(true);
            totalHargaPenjualan();
            $('.alert-row-penjualan').hide();
            $('#isBarangBaru').prop('checked', false);
            $('#kodeBarangPenjualan').val('');
            $('#barcodePenjualan').focus();
            $('#barcodePenjualan').val('');
            $('#namaBarangPenjualan').val('');
            $('#hargaPenjualan').val('');
            $('#jumlahPenjualan').val('');
            $('#namaSatuanPenjualan').val('');
            $('#totalPenjualan').val('');
        })

        // set value hapus
        function hapusRowPenjualan(check = false) {
            if (check) {
                let btnHapus = $('.btn-hapus-penjualan');
                for (let i = 0; i < btnHapus.length; i++) {
                    $(btnHapus[i]).on('click', function(event) {
                        $('#hapusItemPenjualan').val($(this).data('id'));
                    });
                }
            }
        }
        // end

        // hapus row
        $("#hapusBtnPenjualanModal").on("click", function(e) {
            let itemID = $("#hapusItemPenjualan").val();
            document.getElementById(itemID).remove();
            totalHargaPenjualan();
        });
        // end

        // hitung total harga transaksi
        function totalHargaPenjualan() {
            $("#totalTextPenjualan").html(function() {
                var a = 0;
                $(".totalHrgPenjualan").each(function() {
                    a += parseInt(Number(replaceCurrency($(this).html())));
                });
                return currencyIdr(String(a), 'Rp ');
            });
            if (Number(replaceCurrency($('#totalTextPenjualan').html())) == 0) {

            }
            return $("#totalTextPenjualan").html();
        };
        // end

    })

</script>
