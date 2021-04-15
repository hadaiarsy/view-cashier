@extends('admin.temp.template')

@section('site-title', 'Daftar Hutang')

@section('main-contents')
    <style>
        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

    </style>

    <div class="loading" id="loading">Loading&#8230;</div>

    <div class="row">
        <div class="col-sm-3">
            <h4>Daftar Hutang</h4>
            <hr class="divider">
        </div>
    </div>

    <div class="row mt-3 d-none">
        {{-- <div class="d-none"> --}}
        <div class="col-lg-5 form-inline d-flex">
            {{-- <input type="date" class="form-control mr-2" name="" id="tanggal_awal" value="{{ date('Y-m-d') }}"> --}}
            {{-- <span class="d-inline-block mr-2"><i class="fas fa-arrow-alt-circle-right"></i></span> --}}
            {{-- <input type="date" class="form-control d-inline" name="" id="tanggal_akhir" value="{{ date('Y-m-d') }}"> --}}
            {{-- <button type="button" class="btn btn-success ml-2" id="kirim">Kirim</button> --}}

            <span>
                <select name="birth_month">
                    <?php for ($m = 1; $m <= 12; ++$m) { $month_label=date('F', mktime(0, 0, 0, $m, 1)); ?> <option value="<?php echo $month_label; ?>"><?php echo $month_label; ?></option>
                        <?php
                        } ?>
                </select>
            </span>
            {{-- <span>
                <select name="birth_day">
                    <?php
                    $start_date = 1;
                    $end_date = 31;
                    for ($j = $start_date; $j <= $end_date; $j++) {
                        echo '<option value=' . $j . '>' . $j . '</option>';
                    }
                    ?> </select>
            </span> --}}
            <span>
                <select name="birth_year">
                    <?php
                    $year = date('Y');
                    $min = $year - date('y');
                    $max = $year;
                    for ($i = $max; $i >= $min; $i--) {
                    echo '<option value=' . $i . '>' . $i . '</option>';
                    }
                    ?>
                </select>
            </span>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <table class="table" id="tableTrans">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Resi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">ID Kasir</th>
                        <th scope="col">ID Supplier</th>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Batas Waktu</th>
                        <th scope="col">Ket</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $t)
                        <tr>
                            <th scope="col">{{ $loop->iteration }}</th>
                            <td>{{ $t->no_resi }}</td>
                            <td>{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                            <td>{{ $t->kasir->name }}</td>
                            <td>{{ $t->member->kode_member }}</td>
                            <td>{{ $t->member->nama }}</td>
                            <td>{{ date('d/m/y', strtotime('+30 days', strtotime($t->tanggal))) }}</td>
                            <td>-</td>
                            <td>
                                @if ($level != 5)
                                    <button class="btn btn-sm btn-danger btnHapus" data-dataid="{{ $t->no_resi }}"
                                        data-bs-toggle="modal" data-bs-target="#hapusModal"><i
                                            class='fas fa-trash-alt'></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        {{-- </div> --}}
        <div class="col-lg d-flex flex-row-reverse">
            <div class="d-block m-2">
                <a href="{{ route('lp-hutang') }}" target="_blank"><button type="button" class="btn btn-success pl-2"
                        id="laporanPiutang">Generate
                        Laporan</button></a>
            </div>
            <div class="d-block m-2">
                <a href="{{ route('m-hutang') }}" target="_blank"><button type="button"
                        class="btn btn-success pl-2">Mutasi
                        Hutang</button></a>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    {{-- Modal Hapus Transaksi --}}
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusModalLabel">Hapus Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hapus-transaksi') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_hapus" id="idHapus">
                        <input type="hidden" name="jenis_hapus" id="jenisHapus" value="penjualan">
                        <h6>Apa anda yakin akan menghapus transaksi <strong><span id="transaksi_edit"></span></strong>?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // window.onbeforeunload = confirmExit;

        // function confirmExit() {
        //     return 'HEY!!!';
        // }

        $(document).ready(function() {
            $("#tableTrans").DataTable();
            $('#loading').addClass('d-none');

            let d = new Date();
            let month = d.getMonth() + 1;
            let day = d.getDate();
            let year = d.getFullYear();
            let outputDate = year + '-' + (month < 10 ? '0' : '') + month + (day < 10 ? '0' : '') + '-' +
                day;
            // $('#tanggal_awal').val(outputDate);

            $('#tanggal_awal').on('change', function(e) {
                let taw = $(this).val();
                let tak = $('#tanggal_akhir').val();
                if (taw > outputDate)
                    $(this).val(outputDate);
                if (taw > tak)
                    $(this).val(tak);
                console.log($(this).val());
            });
            $('#tanggal_akhir').on('change', function(e) {
                let tak = $(this).val();
                let taw = $('#tanggal_awal').val();
                if (tak > outputDate)
                    $(this).val(outputDate);
                if (tak < taw)
                    $(this).val(taw);
                console.log($(this).val());
            });

            let totalRow = $('td.total-row');
            for (let i = 0; i < totalRow.length; i++) {
                let total = $(totalRow[i]).html();
                $(totalRow[i]).html(currencyIdr(total, 'Rp '));
            }

            $('#kirim').on('click', function(e) {
                kirim();
            });

            let kirim = () => {
                let tawal = $('#tanggal_awal').val();
                let tahir = $('#tanggal_akhir').val();
                console.log(tawal + ' -> ' + tahir);
            }

            $('div#tableTrans_filter label input').on('change paste keyup', function(event) {
                // console.log($(this).val());
            });

            $('#laporan').on('click', function(event) {
                let idMember = $('div#tableTrans_filter label input').val();
                axios.get(globalUrl + 'check-id-member/' + (idMember == '' ? 'null' : idMember))
                    .then((response) => {
                        let data = response.data;
                        if (data.length == 0) {
                            alert('Data Member Tidak Ada');
                        } else {
                            console.log(data);
                            window.open(globalUrl + 'laporan-transaksi/' + data.kode_member);
                        }
                    }).catch((error) => {
                        console.log(error.response);
                    })
            });

            const fHapus = () => {
                let btnHapus = $('.btnHapus');
                for (let i = 0; i < btnHapus.length; i++) {
                    $(btnHapus[i]).on('click', function(e) {
                        let kode = $(this).data('dataid');
                        $('#transaksi_edit').html(kode);
                        $('#idHapus').val(kode);
                    });
                }
            }
            setInterval(function() {
                fHapus();
            }, 1000);

            let is_delete = $('#msg_delete').data('datahapus');
            if (is_delete === 'succesful') {
                Swal.fire(
                    'Data berhasil dihapus!',
                    'success!',
                    'success'
                ).then((result) => {})
            } else if (is_delete === 'unsuccess') {
                Swal.fire(
                    'Data gagal dihapus!',
                    'failed!',
                    'error'
                ).then((result) => {})
            }
        });

    </script>
@endsection
