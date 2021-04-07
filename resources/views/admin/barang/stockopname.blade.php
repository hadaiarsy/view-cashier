<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="url-global" content="{{ config('app.url') }}">

    <style>
        * {
            font-family: arial, sans-serif;
            font-size: 1rem;
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

        table#dataTransaksi tr {
            border: 1px solid black;
            border-width: thick;
        }

        table#dataMember {
            width: 100%;
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

    </style>

    <title>DAFTAR STOCK OPNAME</title>
</head>

<body>
    <div class="container">
        <div id="">
            <table id="dataMember">
                <thead>
                    <tr class="head-list">
                        <th colspan="2">
                            <h4>DAFTAR STOCK OPNAME</h4>
                            <h4 style="margin-top: -16px">KOPERASI YAMUGHNI</h4>
                            <h4 style="margin-top: -16px">
                                <?php
                                $date = date('m');
                                $dateString = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI',
                                'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
                                for ($i = 0; $i <= count($dateString); $i++) { if ($date==$i) { echo $dateString[$i - 1]
                                    . ' ' . date('Y'); } } ?> </h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <table id="dataTransaksi">
                <thead>
                    <tr style="height: 30px;">
                        <th scope="col" style="width: 5%">NO.</th>
                        <th scope="col" style="width: 50%">Nama Barang</th>
                        <th scope="col" style="width: ">Harga Beli</th>
                        <th scope="col" style="width: ">Stock Akhir</th>
                        <th scope="col" style="width: ">Jumlah Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenis as $j)
                        @if (count($j->barang) > 0)
                            <tr>
                                <th scope="col">{{ $loop->iteration }}</th>
                                <td colspan="4" style="text-align: left">
                                    <strong>{{ strtoupper($j->nama_jenis) }}</strong>
                                </td>
                            </tr>
                            @foreach ($j->barang as $barang)
                                <tr>
                                    <td style="text-align: right">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ strtoupper($barang->nama) }}</td>
                                    <td style="text-align: right">
                                        @foreach ($satuan as $s)
                                            @if ($s->kode_barang == $barang->kode_barang)
                                                {{ $helper->money_format($hb = $s->harga_beli) }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="text-align: right">
                                        {{ $helper->money_format($stok = $barang->stok) }}
                                    </td>
                                    <td style="text-align: right">{{ $helper->money_format($hb * $stok) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
