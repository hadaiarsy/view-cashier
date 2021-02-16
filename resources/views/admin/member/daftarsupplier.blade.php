@extends('admin.temp.template')

@section('site-title', 'Daftar Supplier')

@section('contents')
    <div class="row">
        <div class="col-sm-2">
            <h4>Daftar Supplier</h4>
            <hr class="divider">
        </div>
    </div>

    <div class="row d-flex justify-content-between">
        <div class="col-md-3 border p-2">
            <h5 class="mt-2 mb-3"><i class="fas fa-plus"></i> Tambah Supplier</h5>
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Kode :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="noResi" value="S0974890001">
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
                    <input type="text" class="form-control" id="namaBrg" name="namaBrg" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputtext3" class="col-sm-4 col-form-label">No HP :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="jumlahBrg" name="jumlahBrg" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputtext3" class="col-sm-4 col-form-label">Alamat :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="hargaBrg" name="hargaBrg" placeholder="">
                </div>
            </div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="tmbhBtn"><i class="fas fa-plus"></i>
                Tambah</button>
        </div>

        <div class="col-md-8 border">
            <div class="p-2">
                <div class="row">
                    <h5 class="mt-2 mb-3"><i class="fas fa-cart-plus"></i> Detail Supplier</h5>
                </div>
                <div class="row mt-3 overflow-auto">
                    <table class="table table-striped table-hover" id="tableItem">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#tmbhBtn").on("click", function() {
                let noResi = $("#noResi").val();
                let nama = $("#namaBrg").val();
                let jumlah = $("#jumlahBrg").val();
                let harga = $("#hargaBrg").val();
                let numInt = $("#tableItem").find("tbody").children().length + 1;
                let childTable =
                    "<tr id='itemRow[" + numInt + "]'><td>" + numInt +
                    "</td><td>" + noResi +
                    "</td><td id='namaItm" + numInt + "'>" + nama +
                    "</td><td id='jumlahItm" + numInt + "'>" + jumlah +
                    "</td><td class='totalHrg' id='totalItm" + numInt + "'>" + harga +
                    "</td></tr>";
                $("#tableItem").find("tbody").append(childTable);
                noResi = noResi.replace("S0", "");
                $("#noResi").val("S0" + (parseInt(noResi) + 1));
            });
        });

    </script>
@endsection
