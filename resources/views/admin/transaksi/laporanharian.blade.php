<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="url-global" content="{{ config('app.url') }}">

    <style>
        * {
            font-family: arial, Calibri;
            font-size: 0.88rem;
        }

        body {
            font-size: 0.1rem;
        }

        /* div.container {
            background-color: rgb(39, 38, 38);
        } */

        tr.list-item th {
            text-align: left
        }

        tr.head-list td {
            text-align: center
        }

        table#dataTransaksi {
            width: 100%;
            border-collapse: collapse;
        }

        table#dataTransaksi,
        table#dataTransaksi th,
        table#dataTransaksi td {
            border: 1px solid black;
            font-size: 0.9rem;
        }

        table#dataMember {
            width: 100%;
            margin-bottom: 20px;
        }

        table#dataMember td {
            width: 50%;
        }

        tr.border-bottom td {
            border-bottom: 1px solid black;
        }

        tr.border-full td {
            border: 1px solid black;
        }

        td.border-right {
            vertical-align: top;
            border-right: 1px solid black;
        }

        div#laporanLand {
            width: 80%;
            margin: auto;
            margin-top: 40px;
            border: 1px solid black;
            padding: 12px;
        }

        div.row-button {
            width: 80%;
            margin: auto;
            margin-top: 40px;
        }

        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
        }

        p {
            page-break-after: always;
        }

        p:last-child {
            page-break-after: never;
        }

    </style>

    <title>Laporan Penjualan Harian</title>
</head>

<body>
    {{-- <footer>Aplikasi Kasir &#169; Beegency 2021</footer>
    <footer>Aplikasi Kasir &#169; Beegency 2021</footer> --}}

    <div class="container">
        <div id="">
            <table id="dataMember">
                <thead>
                    <tr class="head-list">
                        <th colspan="2">
                            <h4>NOTA INKASO PENJUALAN</h4>
                            <h4 style="margin-top: -16px">KOPERASI YAMUGHNI</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tanggal Penerimaan : {{ date('d-m-Y') }}</td>
                        <td>No. Cetak : {{ $number }}</td>
                    </tr>
                    <tr>
                        <td>Kelompok Pembeli : {{ strtoupper($kelompok) }}</td>
                        <td>ID User : {{ $username }}</td>
                    </tr>
                </tbody>
            </table>
            <table id="dataTransaksi">
                <thead>
                    <tr style="height: 30px;">
                        <th scope="col" rowspan="2" style="width: 3%">NO.</th>
                        <th scope="col" colspan="2" style="width: 14%">FAKTUR</th>
                        <th scope="col" rowspan="2">NAMA PEMBELI</th>
                        <th scope="col" rowspan="2">UNIT</th>
                        <th scope="col" rowspan="2">NO ANGGOTA</th>
                        <th scope="col" rowspan="2">PENJUALAN TUNAI (Rp.)</th>
                        <th scope="col" rowspan="2">UMUM (Rp.)</th>
                        <th scope="col" rowspan="2">DONASI (Rp. )</th>
                        <th scope="col" rowspan="2">PENJUALAN KREDIT (Rp.)</th>
                        <th scope="col" rowspan="2">JATUH TEMPO</th>
                        <th scope="col" rowspan="2">KET.</th>
                    </tr>
                    <tr style="height: 30px;">
                        <th scope="col">TGL</th>
                        <th scope="col">NOMOR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 0;
                    $tp = 0;
                    $tk = 0;
                    $tc = 0;
                    $tdonasi = 0;
                    ?>
                    @foreach ($data as $transaksi)
                        @if (date('dmy', strtotime($transaksi->tanggal)) == date('dmy'))
                            <?php
                            $tcicilan = 0;
                            $tscicilan = 0;
                            ?>
                            <tr class="head-list">
                                <th scope="col" rowspan="{{ count($transaksi->detail) }}">{{ $num += 1 }}
                                </th>
                                <td rowspan="{{ count($transaksi->detail) }}">
                                    {{ date('d/m/y', strtotime($transaksi->tanggal)) }}</td>
                                <td rowspan="{{ count($transaksi->detail) }}">{{ $transaksi->no_resi }}</td>
                                <td rowspan="{{ count($transaksi->detail) }}">{{ $transaksi->member->nama }}</td>
                                <td rowspan="{{ count($transaksi->detail) }}">{{ $transaksi->member->unit }}</td>
                                <td rowspan="{{ count($transaksi->detail) }}">
                                    {{ $transaksi->member->no_mmt == '' ? '-' : $transaksi->member->no_mmt }}
                                </td>
                                @if ($transaksi->is_lunas == '1' && count($transaksi->piutang) == 0)
                                    <td rowspan="{{ count($transaksi->detail) }}">{{ $transaksi->total }}</td>
                                    <td rowspan="{{ count($transaksi->detail) }}">-</td>
                                    <td rowspan="{{ count($transaksi->detail) }}">
                                        {{ $transaksi->donasi > 0 ? $transaksi->donasi : '-' }}
                                        <?php $tdonasi += $transaksi->donasi; ?>
                                    </td>
                                    <td rowspan="{{ count($transaksi->detail) }}">-</td>
                                    <?php $tp += $transaksi->total; ?>
                                @else
                                    <td rowspan="{{ count($transaksi->detail) }}">-</td>
                                    @foreach ($transaksi->piutang as $piutang)
                                        <?php $tscicilan += $piutang->uang; ?>
                                        @if (date('dmy', strtotime($piutang->tanggal)) == date('dmy'))
                                            <?php $tcicilan += $piutang->uang; ?>
                                        @endif
                                    @endforeach
                                    <?php $tcicilan = $tcicilan - ($tscicilan - $transaksi->total < 0 ? 0
                                        : $tscicilan - $transaksi->total); ?> <td
                                            rowspan="{{ count($transaksi->detail) }}">
                                            {{ $tcicilan == 0 ? '-' : $tcicilan }}
                                        </td>
                                        <?php
                                        $tk += $transaksi->total;
                                        $tc += $tcicilan;
                                        ?>
                                        <td rowspan="{{ count($transaksi->detail) }}">
                                            {{ $transaksi->donasi > 0 ? $transaksi->donasi : '-' }}
                                            <?php $tdonasi += $transaksi->donasi; ?>
                                        </td>
                                        <td rowspan="{{ count($transaksi->detail) }}">
                                            {{ $helper->money_format($transaksi->total) }}</td>
                                @endif
                                <td rowspan="{{ count($transaksi->detail) }}">
                                    {{ $transaksi->is_lunas != 1 ? date('d/m/y', strtotime('+30 days', strtotime($transaksi->tanggal))) : '-' }}
                                </td>
                                <td rowspan="{{ count($transaksi->detail) }}">
                                    {{ $transaksi->is_lunas == 1 ? 'L' : '' }}
                                </td>
                            </tr>
                        @endif
                        @if ($loop->last)
                            <tr>
                                <th colspan="6" style="text-align: right">TOTAL PENJUALAN (Rp. )</th>
                                <td style="text-align: center">{{ $tp == 0 ? '-' : $tp }}</td>
                                <td style="text-align: center">{{ $tc == 0 ? '-' : $tc }}</td>
                                <td style="text-align: center">{{ $tdonasi == 0 ? '-' : $tdonasi }}</td>
                                <td style="text-align: center">{{ $tk == 0 ? '-' : $helper->money_format($tk) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
