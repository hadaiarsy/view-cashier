@extends('admin.temp.template')

@section('site-title', 'Daftar Barang')

@section('contents')
    <div class="row">
        <div class="col-sm-2">
            <h4>Daftar Barang</h4>
            <hr class="divider">
        </div>
    </div>

    <div class="row d-flex justify-content-between">
        <div class="col-md-3 border p-2">
            <h5 class="mt-2 mb-3"><i class="fas fa-plus"></i> Tambah Barang</h5>
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Kode :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="noResi" value="{{ $date }}">
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Barcode :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control enter-pass" id="barcode" data-nextid="sc-1">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6>
                        <small class="text-muted">Data Barang</small>
                    </h6>
                    <hr class="divider">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control enter-pass" id="namaBrg" name="namaBrg" data-nextid="sc-2">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputtext3" class="col-sm-4 col-form-label">Stok :</label>
                {{-- <div class="col-sm-8">
                    <input type="text" class="form-control" id="jumlahBrg" name="jumlahBrg" placeholder="">
                </div> --}}
                <div class="input-group col-sm-8">
                    <input type="text" aria-label="First name" class="form-control enter-pass" id="jumlahBrg"
                        name="jumlahBrg" data-nextid="sc-3" placeholder="jumlah">
                    <input type="text" class="form-control enter-pass" id="satuanBrg" name="satuanBrg" data-nextid="sc-4"
                        placeholder="satuan(kg/liter)">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputtext3" class="col-sm-4 col-form-label">Harga :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control enter-pass" id="hargaBrg" name="hargaBrg" data-nextid="sc-5">
                </div>
            </div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="tmbhBtn"><i class="fas fa-plus"></i>
                Tambah</button>
        </div>

        <div class="col-md-8 border">
            <div class="p-2">
                <div class="row">
                    <h5 class="mt-2 mb-3"><i class="fas fa-cart-plus"></i> Detail Barang</h5>
                </div>
                <div class="row mt-3 overflow-auto">
                    <table class="table table-striped table-hover" id="tableItem">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->stok . ' ' . $item->satuan[0]->nama_satuan }}</td>
                                    <td class="harga-barang">{{ $item->satuan[0]->harga }}</td>
                                    <td>
                                        <a href='show-barang/{{ $item->kode_barang }}' class='btn btn-primary btn-sm'><i
                                                class='far fa-eye'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".enter-pass[data-nextid=sc-1]").focus();
        $(document).ready(function() {
            $("#tableItem").DataTable();
            let hargaBrg = $(".harga-barang");
            for (let i = 0; i < hargaBrg.length; i++) {
                let valThis = $(hargaBrg[i]).html();
                $(hargaBrg[i]).html(currencyIdr(valThis, 'Rp '));
            }

            $("#hargaBrg").on("keyup", function(e) {
                let valThis = $(this).val();
                $(this).val(currencyIdr(valThis, 'Rp '));
            });

            let enterPass = $(".enter-pass");
            for (let i = 0; i < enterPass.length; i++) {
                $(enterPass[i]).on("keydown", function(event) {
                    if (event.keyCode === 13) {
                        let idNo = $(this).data("nextid");
                        idNo = idNo.replace("sc-", "");
                        idNo = parseInt(idNo) + 1;
                        let nextID = $(".enter-pass[data-nextid=sc-" + idNo + "]");
                        if (nextID.length) {
                            idNum = idNo;
                        } else {
                            idNum = 1;
                            $("#tmbhBtn").click();
                        };
                        $(".enter-pass[data-nextid=sc-" + idNum + "]").focus();
                    }
                });
            };

            $("#tmbhBtn").on("click", function() {
                let noResi = $("#noResi").val();
                let barcode = $("#barcode").val();
                let nama = $("#namaBrg").val();
                let jumlah = Number($("#jumlahBrg").val());
                let satuan = $("#satuanBrg").val();
                let harga = $("#hargaBrg").val();
                let token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post('/store-barang', {
                        kode_barang: noResi,
                        barcode: barcode,
                        nama: nama,
                        stok: jumlah,
                        nama_satuan: satuan,
                        rasio: 1,
                        harga: Number(harga.split(".").join("").split("Rp").join(""))
                    })
                    .then((response) => {
                        console.log(response)
                        let numInt = $("#tableItem").find("tbody").children().length + 1;
                        let childTable =
                            "<tr id='itemRow[" + numInt + "]'><td>" + numInt +
                            "</td><td>" + noResi +
                            "</td><td>" + nama +
                            "</td><td>" + jumlah + ' ' + satuan +
                            "</td><td class='harga-barang'>" + harga +
                            "</td><td><a href='show-barang/" + noResi +
                            "' class='btn btn-primary btn-sm'><i class='far fa-eye'></i></a></td></tr>";
                        $("#tableItem").find("tbody").append(childTable);
                        noResi = noResi.replace("B-", "");
                        $("#noResi").val("B-" + (parseInt(noResi) + 1));
                        $("#barcode").val("");
                        $("#namaBrg").val("");
                        $("#jumlahBrg").val("");
                        $("#hargaBrg").val("");
                    }).catch((error) => {
                        console.log(error.response.data)
                    })
            });
        });

    </script>
@endsection
