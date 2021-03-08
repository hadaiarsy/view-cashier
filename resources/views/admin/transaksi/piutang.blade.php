@extends('admin.temp.template')

@section('site-title', 'Pembayaran Piutang')

@section('main-contents')

    <div class="tab-content">

        <!-- pembayaran piutang -->
        <div class="tab-pane tabs-animation fade show active" id="tab-content-penjualan" role="tabpanel">
            <div class="row">
                <div class="col-lg">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Data Piutang</h5>
                            <div class="row alert-row" style="display: none">
                                <div class="alert alert-danger alert-row" data-start="true" role="alert">
                                    Data Piutang <strong>Tidak</strong> Tersedia! Harap cek kembali form
                                    <strong>Piutang</strong> di bawah!
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="row d-flex">
                                        <div class="col-6">
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-4 col-form-label">INVOICE</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="hidden" name="noResiHidden" id="noResiHidden">
                                                        <input type="text" class="form-control trans-section"
                                                            data-datats="ts-1" id="noResi" name="noResi">
                                                        <button type="button" class="input-group-text" id="btnResi">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
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
                                        <div class="col d-flex justify-content-end">
                                            <p><strong>sisa piutang</strong></p>
                                        </div>
                                    </div>
                                    <div class="row d-flex flex-row-reverse">
                                        <div class="col d-flex justify-content-end">
                                            <h4 class="text-danger border-bottom border-danger" id="totalText">Rp 0</h4>
                                        </div>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-1"
                                                id="kodeMember" value="" disabled>
                                        </div>
                                        <label for="" class="col-4 col-form-label">Kode Member :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-3"
                                                id="uangTotal" value="">
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Uang :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-4"
                                                id="kmblTotal" value="" disabled>
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Kembalian :</label>
                                    </div>
                                    <div class="row d-flex flex-row-reverse mt-2">
                                        <input type="hidden" name="isLunas" id="isLunas">
                                        <div class="col-6 input-group">
                                            <input type="text" class="form-control pay-section" data-dataps="ps-4"
                                                id="sisaPiutang" value="" disabled>
                                        </div>
                                        <label for="inputPassword3" class="col-4 col-form-label">Sisa Piutang :</label>
                                    </div>
                                    <div class="row flex-row-reverse mt-2 text-alert-lunas" style="display: none">
                                        <div class="col mt-2 text-end">
                                            <h3 class="badge badge-success">Lunas</h3>
                                        </div>
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

    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            const globalUrl = 'http://waroeng-yamughni.com/';
            $('#btnResi').on('click', function() {
                let inv = $('#noResi').val();
                axios.get(globalUrl + 'get-piutang/' + inv)
                    .then((response) => {
                        let data = response.data.data[0];
                        console.log(data);
                        $('#noResiHidden').val(data.no_resi);
                        $('#kodeMember').val(data.member_id);
                        tableItem(data.detail, data.total, data.diskon);
                        sumPiutang(data.piutang, data.total);
                        $('.alert-row').hide();
                    }).catch((error) => {
                        console.log(error.response);
                        $('.alert-row').show();
                    })
            });

            function tableItem(data, total, diskon) {
                $('table#tableItem').find('tbody').empty();
                for (let i = 0; i < data.length; i++) {
                    let dataLoop =
                        "<tr class='item-row'><td>" + data[i].kode_barang + "</td><td>" + data[i].nama_barang +
                        "</td><td>" + data[i].jumlah + " " + data[i].satuan + "</td><td>" +
                        currencyIdr(String(data[i].harga), 'Rp ') + "</td></tr>";
                    $('#tableItem').find('tbody').append(dataLoop);
                }
                let dataTotal = "<tr class='item-row'><td colspan='3'><strong>DISKON</strong></td><td><strong>" +
                    diskon +
                    " %</strong></td></tr><tr class='item-row'><td colspan='3'><strong>TOTAL</strong></td><td><strong>" +
                    currencyIdr(String(total),
                        'Rp ') +
                    "</strong></td></tr>";
                $('#tableItem').find('tbody').append(dataTotal);
            }

            function sumPiutang(data, totaltr) {
                var total = 0;
                for (let i = 0; i < data.length; i++) {
                    total += data[i].uang;
                }
                totals = totaltr - total;
                $('#totalText').html(currencyIdr(String(totals), 'Rp '));
                let dataPiutang =
                    "<tr class='item-row'><td colspan='3'><strong>Pembayaran Sebelumnya</strong></td><td><strong>" +
                    currencyIdr(String(total),
                        'Rp ') +
                    "</strong></td></tr>";
                $('#tableItem').find('tbody').append(dataPiutang);
            }

            // hitung uang
            $("#uangTotal").on("change paste keyup", function() {
                $(this).val(currencyIdr($(this).val(), 'Rp '));
                let uang = Number($(this).val().split(".").join("").split("Rp").join(""));
                let total = Number($("#totalText").html().split(".").join("").split("Rp").join(""));
                let kmbl = uang - total;
                if (kmbl < 0) {
                    $("#kmblTotal").val('');
                    let sisa = total - uang;
                    $('#sisaPiutang').val(currencyIdr(String(sisa), 'Rp '));
                    $('.text-alert-lunas').hide();
                    $('#isLunas').val('0');
                } else {
                    $("#kmblTotal").val(currencyIdr(String(kmbl), 'Rp '));
                    $('#slsPrintTransc').prop('disabled', false);
                    $('.text-alert-total').hide();
                    $(this).removeClass('text-danger');
                    $('#sisaPiutang').val('');
                    $('.text-alert-lunas').show();
                    $('#isLunas').val('1');
                }
            });
            // end

            // btn selesai
            $('#slsPrintTransc').on('click', function() {
                let noResi = $('#noResiHidden').val();
                let uang = $('#uangTotal').val();
                let kmbl = $('#kmblTotal').val();
                let sisa = $('#sisaPiutang').val();
                let isLunas = $('#isLunas').val();
                let saldoAwal = $('#totalText').html();

                // proses ajax simpan
                let token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post(globalUrl + 'store-piutang', {
                        no_resi: noResi,
                        uang: replaceCurrency(uang),
                        is_lunas: isLunas
                    })
                    .then((response) => {
                        let data = response.data.data;
                        console.log(response.data.data.id);
                        console.log(replaceCurrency(saldoAwal));
                        console.log(replaceCurrency(sisa));
                        let dataStruk = {
                            noResi: data.transaksi_id,
                            piutangId: data.id,
                            saldoAwal: replaceCurrency(saldoAwal),
                            sisaPiutang: replaceCurrency(sisa)
                        };
                        printStruk(dataStruk);
                        // $('#batal').click();
                    })
                    .catch((error) => {
                        console.log(error)
                        console.log(error.response)
                    });
                // end

            });
            // end

            // proses print strik
            function printStruk(data) {
                let printStruk = window.open(globalUrl + 'struk-piutang/' + data.noResi + '/' + data.piutangId +
                    '/' + data.saldoAwal + '/' + data.sisaPiutang);
                let tmout = setTimeout(function() {
                    printStruk.close()
                }, 3000);
            }
            // end

            // btn batal
            $('#batal').on('click', function() {
                $('#noResi').val('');
                $('#noResiHidden').val('');
                $('#totalText').html('Rp 0');
                $('#kodeMember').val('');
                $('#uangTotal').val('');
                $('#kmblTotal').val('');
                $('#sisaPiutang').val('');
                $('#isLunas').val('');
                $('.text-alert-lunas').hide();
                $('.item-row').remove();
            });
            // end

        })

    </script>
@endsection
