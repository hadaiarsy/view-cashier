<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"
        integrity="sha512-NFUcDlm4V+a2sjPX7gREIXgCSFja9cHtKPOL1zj6QhnE0vcY695MODehqkaGYTLyL2wxe/wtr4Z49SvqXq12UQ=="
        crossorigin="anonymous"></script>

    <title>Test Struk</title>
</head>

<body>
    <table
        style="font-size: 0.8rem; max-width: 184px; border-top: 1px dashed black; border-bottom; border-spacing: 8px">
        <tr>
            <td colspan="3" style="text-align: center">Cashier Shop</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center">Tgl: 06-01-2021</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;">IDC: 001</td>
            <td colspan="2" style="border-bottom: 1px solid black; text-align: right">No. Resi: PJ-2001060001</td>
        </tr>
        {{-- <tr>
            <th scope="col">Item</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
        </tr> --}}
        <tr>
            <td>Gula</td>
            <td style="text-align: center">1 kg</td>
            <td style="text-align: right">Rp 8000</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid black;">Total</td>
            <td colspan="2" style="border-top: 1px solid black; text-align: right">Rp 8000</td>
        </tr>
        <tr>
            <td>Uang</td>
            <td colspan="2" style="text-align: right">Rp 10000</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td colspan="2" style="text-align: right">Rp 2000</td>
        </tr>
        <tr>
            <td colspan="3" style="border-top: 1px solid black; text-align: center">Terima Kasih</td>
        </tr>
        <tr>
            <td colspan="3" style="border-top: 1px solid black; text-align: center">
                <div id="qrcode"></div>
            </td>
        </tr>
    </table>
    <script>
        $(document).ready(function() {
            let d = new Date();
            let month = d.getMonth() + 1;
            let day = d.getDate();
            let outputDate = (day < 10 ? '0' : '') + day + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                d.getFullYear();
            console.log(outputDate);

            $('#qrcode').qrcode({
                width: 100,
                height: 100,
                text: 'https://www.yamughnibandung.org/'
            });
            console.log($('#qrcode').html())
        })

    </script>
</body>

</html>
