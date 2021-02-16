@extends('admin.temp.template')

@section('site-title', 'Stok')

@section('contents')
    <div class="row">
        <div class="col-sm-2">
            <h4>Stok</h4>
            <hr class="divider">
        </div>
    </div>

    <div class="row d-flex justify-content-between">
        <div class="col-md-3 border p-2">
            <h5 class="mt-2 mb-3"><i class="fas fa-info"></i> Info Struk</h5>
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">No. Resi :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="noResi" value="PB-210103001">
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col">
                    <h6>
                        <small class="text-muted">Data Supplier</small>
                    </h6>
                    <hr class="divider">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="namaCust" name="namaCust" placeholder="Jika ada">
                </div>
            </div>
            <button type="button" class="btn btn-warning btn-sm mt-2"><i class="fas fa-times"></i> Batal</button>
        </div>

        <div class="col-md-8 border">
            <div class="p-2">
                <div class="row">
                    <h5 class="mt-2 mb-3"><i class="fas fa-cart-plus"></i> Detail Pembelian</h5>
                </div>
                <div class="row d-flex flex-row-reverse">
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <fieldset disabled="disabled">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Kode Barang :</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="kodeBarang" name="kodeBarang"
                                        data-bs-toggle="modal" data-bs-target="#barangModal">
                                    <button type="button" class="input-group-text" data-bs-toggle="modal"
                                        data-bs-target="#barangModal"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row d-flex flex-row-reverse">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="" id="stok" name="stok" disabled>
                            </div>
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="" id="harga" name="harga">
                            </div>
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row d-flex flex-row-reverse">
                            <div class="col-sm-4">
                                <input type="hidden" name="id" id="id">
                                <button class="btn btn-info btn-sm text-light" id="tambah"><i class="fas fa-plus"></i>
                                    Tambah</button>
                            </div>
                            <div class="col-sm-5">
                                <fieldset disabled="disabled">
                                    <input type="text" class="form-control" value="" id="total" name="total">
                                </fieldset>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="jumlah" name="jumlah" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 overflow-auto">
                    <table class="table table-striped table-hover" id="tableItem">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Item</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="row mt-2">
                    <div class="col d-flex flex-row-reverse border">
                        <h4 class="text-danger" id="totalText">Rp 0</h4>
                    </div>
                </div>
                <div class="row d-flex flex-row-reverse mt-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Uang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="uangTotal" value="">
                            </div>
                        </div>
                        <fieldset class="row mt-2" disabled="disabled">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Kembalian :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kmblTotal" value="">
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row d-flex flex-row-reverse mt-4">
                    <div class="col-sm-2">
                        <button class="btn btn-info text-light" id="slsPrintTransc"><i class="fas fa-save"></i>
                            Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}

    {{-- Modal Data Barang --}}
    <div class="modal fade" id="barangModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barangModalLabel">Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-info btn-sm text-light add-item" data-bs-dismiss="modal"
                                            aria-label="Close" id="addItem[1]" data-dataid="1" data-datakode="B0974890001"
                                            data-datanama="Gula Merah" data-datajumlah="10000" data-dataharga="8000">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <p>B0974890001</p>
                                    </td>
                                    <td>
                                        <p>Gula Merah</p>
                                    </td>
                                    <td>
                                        <p>10000kg</p>
                                    </td>
                                    <td>
                                        <p>Rp8000/kg</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-info btn-sm text-light add-item" data-bs-dismiss="modal"
                                            aria-label="Close" id="addItem[2]" data-dataid="2" data-datakode="B0974890002"
                                            data-datanama="Gula Pasir" data-datajumlah="10000" data-dataharga="8000">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <p>B0974890002</p>
                                    </td>
                                    <td>
                                        <p>Gula Pasir</p>
                                    </td>
                                    <td>
                                        <p>10000kg</p>
                                    </td>
                                    <td>
                                        <p>Rp8000/kg</p>
                                    </td>
                                </tr>
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

    {{-- Modal edit item --}}
    <div class="modal fade" id="editItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="editItemModalLabel">Ubah Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>B0974890001</td>
                                <td>Gula Pasir</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="jumlahEditModal" id="jumlahEditModal"
                                            value="10">
                                        <button type="button" class="input-group-text">kg</i></button>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <button type="button" class="input-group-text">Rp</i></button>
                                        <input type="text" class="form-control" name="hargaEditModal" id="hargaEditModal"
                                            value="100000">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <button type="button" class="input-group-text">Rp</i></button>
                                        <input type="text" class="form-control" name="hargaEditModal" id="totalEditModal"
                                            value="100000" disabled>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Ubah</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#slsPrintTransc').attr('disabled', true);
            $('#uangTotal').keyup(function() {
                if ($(this).val().length != 0)
                    $('#slsPrintTransc').attr('disabled', false);
                else
                    $('#slsPrintTransc').attr('disabled', true);
            })
        });

        let addItem = $(".add-item");
        addItem.on("click", function(e) {
            var data = {
                id: $(this).data('dataid'),
                kode: $(this).data('datakode'),
                nama: $(this).data('datanama'),
                stok: $(this).data('datajumlah'),
                harga: $(this).data('dataharga'),
            };
            add(data);

            function add(data) {
                let id = $("#id").val(data.id);
                let kode = $("#kodeBarang").val(data.kode);
                let nama = $("#nama").val(data.nama);
                let stok = $("#stok").val(data.stok);
                let harga = $("#harga").val(data.harga);
                let jumlah = $("#jumlah").val(1);
                let ttl = parseFloat(harga.val()) * parseFloat(jumlah.val());
                let total = $("#total").val(ttl);
                jumlah.on("change paste keyup", function() {
                    let jml = $(this).val();
                    let ttl = parseFloat(harga.val()) * parseFloat(jml);
                    total.val(ttl);
                });
                harga.on("change paste keyup", function() {
                    let hrg = $(this).val();
                    let ttl = parseFloat(hrg) * parseFloat(jumlah.val());
                    total.val(ttl);
                });
            }
        })

        let tambah = $("#tambah");
        tambah.on("click", function(e) {
            let data = {
                id: $("#id").val(),
                kode: $("#kodeBarang").val(),
                nama: $("#nama").val(),
                jumlah: $("#jumlah").val(),
                total: $("#total").val(),
            };
            let numInt = $("#tableItem").find("tbody").children().length + 1;
            let childTable =
                "<tr id='itemRow[" + numInt + "]'><td>" + data.kode +
                "</td><td id='namaItm" + numInt + "'>" +
                data
                .nama +
                "</td><td id='jumlahItm" + numInt + "'>" + data.jumlah +
                "</td><td class='totalHrg' id='totalItm" + numInt + "'>" + data.total +
                "</td><td><a onclick='hapus(" +
                numInt + ")' class='btn btn-danger btn-sm btn-hapus' id='btnHapusItem[" +
                numInt + "]' data-bs-toggle='modal' data-bs-target='#hapusItemModal' data-dataid='item" +
                numInt + "'><i class='fas fa-trash-alt'></i></a></td></tr>";
            $("#tableItem").find("tbody").append(childTable);
            //  <a href='#' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editItemModal'><i class='fas fa-edit'></i></a>
            totalHarga();
        });

        function hapus(id) {
            $("#hapusItem").val("itemRow[" + id + "]");
        };

        $("#hapusBtnModal").on("click", function(e) {
            let itemID = $("#hapusItem").val();
            let itemRow = document.getElementById(itemID);
            itemRow.remove();

            totalHarga();
        });

        function totalHarga() {
            $("#totalText").html(function() {
                var a = 0;
                $(".totalHrg").each(function() {
                    a += parseInt($(this).html());
                });
                return "Rp " + a;
            });
        };

        $("#uangTotal").on("change paste keyup", function() {
            let total = $("#totalText").html();
            total = total.replace("Rp ", "");
            let uang = $(this).val();
            let kmbl = parseFloat(uang) - parseFloat(total);
            if (kmbl === NaN) kmbl = 0;
            $("#kmblTotal").val(kmbl);
        });

        $("#slsPrintTransc").on("click", function() {
            let d = new Date();
            let month = d.getMonth() + 1;
            let day = d.getDate();
            let outputDate = (day < 10 ? '0' : '') + day + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                d.getFullYear();
            let numInt = $("#tableItem").find("tbody").children().length;
            let noResi = $("#noResi").val();
            let ttlSm = $("#totalText").html();
            ttlSm = ttlSm.replace("Rp ", "");
            let uang = $("#uangTotal").val();
            let kmbl = $("#kmblTotal").val();
            let tablePrint =
                "<tr><td>Gula</td><td style='text-align: center'>1 kg</td><td style='text-align: right'>Rp 8000</td></tr>";
            let printWindow = window.open('', '');
            printWindow.document.write('<html><head><title>Print</title></head>');
            printWindow.document.write('<body>');
            printWindow.document.write(
                "<table style='width: 280; border: 1px dashed black; border-spacing: 8px'><tr><td colspan='3' style='text-align: center'>Cashier Shop</td></tr><tr><td colspan='3' style='text-align: center'>Tgl: " +
                outputDate +
                "</td></tr><tr><td style='border-bottom: 1px solid black;'>IDC: K-202</td><td colspan='2' style='border-bottom: 1px solid black; text-align: right'>No. Resi: " +
                noResi +
                "</td></tr><tr><th scope='col'>Item</th><th scope='col'>Jumlah</th><th scope='col'>Harga</th></tr>"
            );
            for (let index = 1; index <= numInt; ++index) {
                let nama = $("#namaItm" + index);
                let jml = $("#jumlahItm" + index);
                let ttl = $("#totalItm" + index);
                printWindow.document.write("<tr>");
                printWindow.document.write("<td>" + nama.text() + "</td>");
                printWindow.document.write("<td style='text-align: center'>" + jml.text() + " kg</td>");
                printWindow.document.write("<td style='text-align: right'>" + ttl.text() + "</td>");
                printWindow.document.write("</tr>");
            };
            printWindow.document.write(
                "<tr><td style='border-top: 1px solid black;'>Total</td><td colspan='2' style='border-top: 1px solid black; text-align: right'>Rp " +
                ttlSm + "</td></tr><tr><td>Uang</td><td colspan='2' style='text-align: right'>Rp " + uang +
                "</td></tr><tr><td>Kembali</td><td colspan='2' style='text-align: right'>Rp " + kmbl +
                "</td></tr><tr><td colspan='3' style='border-top: 1px solid black; text-align: center'>Terima Kasih</td></tr></table>"
            );
            printWindow.document.write('</body></html>');
            printWindow.print();
            printWindow.close();
        });

    </script>
@endsection
