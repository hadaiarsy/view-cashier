<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Jquery cdn -->
    <script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>

    <!-- Jquery QR Code -->
    <script src="{{ asset('assets/js/jquery.qrcode.min.js') }}"></script>

    <title>Test Struk</title>
</head>

<body style="width: 100%">

    @foreach ($data as $transaksi)
        <table id='printStruk'
            style='align-items: center; justify-content: center; font-size: 11px; font-weight: bold; border-top: 1px dashed black; border-bottom: 1px dashed black; border-spacing: 8px; width: 186px'>
            <tr>
                <td colspan='3' style='text-align: center'>
                    <img src='{{ asset('assets/img/icon/logo.png') }}' alt='yamughni img' style='width: 60px'>
                </td>
            </tr>
            <tr>
                <td colspan='3' style='text-align: center'>WAROENG YAMUGHNI</td>
            </tr>
            <tr>
                <td colspan='3' style='text-align: center'>Tgl:
                    {{ date('d-m-Y', strtotime($transaksi->tanggal)) }}</br>Unit:
                    {{ $transaksi->member->kode_member == 'U-00-01' ? '-' : $transaksi->member->kode_member }}
                </td>
            </tr>
            <tr style='margin-bottom: 20px'>
                <td style='border-bottom: 1px solid black;'>ID Kasir:</br>{{ $transaksi->kasir->id }}</td>
                <td colspan='2' style='border-bottom: 1px solid black; text-align: right'>No.
                    Resi:</br>{{ $transaksi->no_resi }}
                </td>
            </tr>
            @if ($transaksi->is_lunas == '0')
                <tr>
                    <td colspan='3' style='border-bottom: 1px dashed black; text-align: center;'>
                        PIUTANG
                    </td>
                </tr>
            @endif
            @foreach ($transaksi->detail as $detail)
                <tr>
                    <td>{{ $detail->nama_barang }}</td>
                    <td style='text-align: center'>{{ $detail->jumlah . ' ' . $detail->satuan }}</td>
                    <td class='harga-item-struk' style='text-align: right'>Rp {{ $detail->harga }}</td>
                </tr>
            @endforeach
            @if ($transaksi->diskon > 0)
                <tr>
                    <td style='border-top: 1px solid black;'>Total</td>
                    <td colspan='2' id='totalStruk' style='border-top: 1px solid black; text-align: right'>
                        {{ $total }}
                    </td>
                </tr>
                <tr>
                    <td>Diskon</td>
                    <td colspan='2' style='text-align: right'>{{ $transaksi->diskon }} %</td>
                </tr>
            @endif
            <tr>
                @if ($transaksi->is_lunas == '1')
                    <td style='border-top: 1px solid black;'>Grand Total</td>
                @else
                    <td style='border-top: 1px solid black;'>Total Piutang</td>
                @endif
                <td colspan='2' id='grandTotalStruk' style='border-top: 1px solid black; text-align: right'>
                    {{ $transaksi->total }}
                </td>
            </tr>
            <tr>
                <td>Uang</td>
                <td colspan='2' id='uangStruk' style='text-align: right'>{{ $uang }}</td>
            </tr>
            @if ($transaksi->is_lunas == '1')
                <tr>
                    <td>Kembali</td>
                    <td colspan='2' id='kembaliStruk' style='text-align: right'>
                        {{ $kembali }}
                    </td>
                </tr>
            @else
                <tr>
                    <td>Sisa Piutang</td>
                    <td colspan='2' id='kembaliStruk' style='text-align: right'>
                        {{ (int) $transaksi->total - (int) $uang }}</td>
                </tr>
                <tr>
                    <td colspan='3' style='border-top: 1px solid black; text-align: center;'>Struk
                        PIUTANG!</br>Jangan sampai hilang!
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan='3' style='border-top: 1px solid black; text-align: center'>Terima Kasih</td>
            </tr>
            <tr>
                <td colspan='3' style='border-top: 1px solid black; text-align: center;'>
                    <div id='qrcodeStruk'></div>
                </td>
            </tr>
        </table>
    @endforeach

    <script>
        $(document).ready(function() {
            function currencyIdr(angka, prefix) {
                let number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }
                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
            }

            $('.harga-item-struk').each(function(e) {
                $(this).html(currencyIdr(String($(this).html()), 'Rp '))
            })

            $('#totalStruk').html(function() {
                return currencyIdr(String($(this).html()), 'Rp ')
            })

            $('#grandTotalStruk').html(function() {
                return currencyIdr(String($(this).html()), 'Rp ')
            })

            $('#uangStruk').html(function() {
                return currencyIdr(String($(this).html()), 'Rp ')
            })

            $('#kembaliStruk').html(function() {
                return currencyIdr(String($(this).html()), 'Rp ')
            })

            let d = new Date();
            let month = d.getMonth() + 1;
            let day = d.getDate();
            let outputDate = (day < 10 ? '0' : '') + day + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                d.getFullYear();

            $('#qrcodeStruk').qrcode({
                width: 60,
                height: 60,
                text: 'https://www.yamughnibandung.org/'
            });

            window.print();

        })

    </script>
</body>

</html>
