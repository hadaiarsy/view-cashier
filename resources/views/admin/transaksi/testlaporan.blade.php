<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        tr.list-item th {
            text-align: left
        }

        tr.head-list td {
            text-align: center
        }

        table {
            width: 50%;
            border: 1px solid black;
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

    </style>

    <title>Laporan Transaksi</title>
</head>

<body>
    <table>
        <tr class="border-bottom">
            <td colspan="5" style="text-align: center;">
                <h4>Laporan Transaksi</h4>
            </td>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">No. Resi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Pemasukan</th>
        </tr>
        <tr class="border-bottom">
            <td colspan="5"></td>
        </tr>
        <tr class="head-list">
            <td rowspan="8" class="border-right">1</td>
            <td>PJ-2101060001</td>
            <td>06-01-2021</td>
            <td>Rp 100000</td>
        </tr>
        <tr class="border-bottom">
            <td colspan="4"></td>
        </tr>
        <tr class="list-item">
            <th scope="col">Item</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
        </tr>
        <tr class="border-bottom">
            <td colspan="4"></td>
        </tr>
        <tr>
            <td>Gula Pasir</td>
            <td>15 kg</td>
            <td>Rp 55000</td>
        </tr>
        <tr>
            <td>Gula Merah</td>
            <td>10 kg</td>
            <td>Rp 45000</td>
        </tr>
        <tr class="border-bottom">
            <td colspan="5"></td>
        </tr>
        <tr class="">
            <td colspan="3">Total</td>
            <td>Rp 100000</td>
        </tr>
        <tr class="border-bottom">
            <td colspan="5"></td>
        </tr>
        {{-- <tr class="head-list">
            <td rowspan="7" class="border-right">2</td>
            <td>PJ-2101060001</td>
            <td>06-01-2021</td>
            <td>Rp 100000</td>
        </tr>
        <tr class="border-bottom">
            <td colspan="4"></td>
        </tr>
        <tr class="list-item">
            <th scope="col">Item</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col" colspan="2"></th>
        </tr>
        <tr class="border-bottom">
            <td colspan="4"></td>
        </tr>
        <tr>
            <td>Gula Pasir</td>
            <td>8 kg</td>
            <td>Rp 35000</td>
        </tr>
        <tr class="border-bottom">
            <td colspan="5"></td>
        </tr>
        <tr class="">
            <td colspan="3">Total</td>
            <td>Rp 35000</td>
        </tr>
        <tr class="border-bottom">
            <td colspan="5"></td>
        </tr> --}}
        <tr>
            <td colspan="4">Total Semua</td>
            <td>Rp 100000</td>
        </tr>
    </table>
</body>

</html>
