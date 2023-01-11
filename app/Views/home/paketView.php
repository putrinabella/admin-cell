<?= $this->extend('template/main'); ?>
<?= $this->section("content"); ?>
<title>Paket Internet</title>

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app-dark.css">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.svg" type="image/x-icon">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png" type="image/png">

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/pages/fontawesome.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/pages/datatables.css">

<body>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Paket Internet</h3>
                    <p class="text-subtitle text-muted">Selamat Datang, <?= session()->get('username'); ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Paket Internet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between ">
                Paket Internet
                <a href="#" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm"><i data-feather="edit"></i> Tambah Data</a>
            </div>
            <div class="card-body px-4 pt-4 pb-4">
                <div class="table">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Operator</th>
                                <th>Nama Paket Internet</th>
                                <th>Harga Modal</th>
                                <th>Harga Jual</th>
                                <th>Keuntungan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->

    <script src="<?= base_url(); ?>/public/assets/js/bootstrap.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/app.js"></script>
    <script src="<?= base_url(); ?>/public/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/pages/datatables.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var table;
        $(document).ready(function() {
            table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                // lengthChange: false,
                ajax: {
                    url: '<?= base_url('public/Operator/dataPaket'); ?>',
                    type: 'POST'
                },
                columns: [{
                        data: 'idPaket'
                    }, {
                        data: 'namaOperator'
                    }, {
                        data: 'namaPaket'
                    },
                    {
                        data: 'harga',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'hargaJual',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'keuntungan',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        render: function(data, type, row) {
                            return `${buttonDelete(row.idPaket)} ${buttonUpdate(row.idPaket, row.namaPaket, row.harga, row.hargaJual)}`;
                        }
                    },
                ]
            });
        });

        function buttonDelete(data) {
            return `<a href="#" class="btn icon btn-danger" data-id="${data}" onclick="js_hapus($(this))"> <i class="bi bi-trash"></i></a>`;
        }

        function buttonUpdate(idPaket, namaPaket, harga, hargaJual) {
            return `<a href="#" class="btn icon btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate" data-id="${idPaket}" onclick="getData('${idPaket}','${namaPaket}', '${harga}','${hargaJual}')"> <i class="bi bi-pencil"></i></a>`;
        }

        let idPaketUpdate = null;

        function getData(idPaket, namaPaket, harga, hargaJual) {
            idPaketUpdate = idPaket;
            $('#namaPaketUpdate').val(namaPaket);
            $('#hargaUpdate').val(harga);
            $('#hargaJualUpdate').val(hargaJual);
            $('#keuntungan').val(keuntungan);
        }

        function update() {
            var data_input = $('#formUpdate').serialize();
            $.ajax({
                    method: "POST",
                    url: "<?= base_url('public/operator/updatePaket'); ?>" + '/' + idPaketUpdate,
                    data: data_input,
                    dataType: "json"
                })
                .done(function(res) {
                    if (res.status) {
                        resetUpdate();
                        Swal.fire({
                            title: 'Success!',
                            text: res.msg,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                        table.ajax.reload();
                        $('#button-close2').trigger('click')
                    } else {
                        Swal.fire({
                            title: 'Fail!',
                            text: res.msg,
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }
                });
        }

        function js_hapus(id) {
            var id_delete = id.data('id');
            $.ajax({
                    method: "POST",
                    url: "<?= base_url('public/Operator/hapusPaket'); ?>",
                    data: {
                        id: id_delete
                    },
                    dataType: "json"
                })
                .done(function(res) {
                    Swal.fire({
                        title: 'Success!',
                        text: res.msg,
                        icon: 'success',
                        confirmButtonText: 'Cool'
                    })
                    table.ajax.reload();
                });
        }

        function simpan() {
            var data_input = $('#form-simpan').serialize();
            $.ajax({
                    method: "POST",
                    url: "<?= base_url('public/Operator/simpanPaket'); ?>",
                    data: data_input,
                    dataType: "json"
                })
                .done(function(res) {
                    if (res.status) {
                        reset();
                        Swal.fire({
                            title: 'Success!',
                            text: res.msg,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: res.msg,
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }
                    table.ajax.reload();
                });
        }

        function reset() {
            $('#idPaket').val('');
            $('#namaPaket').val('');
            $('#deskripsi').val('');
            $('#harga').val('');
            $('#hargaJual').val('');
            $('#keuntungan').val('');
        }

        function resetUpdate() {
            $('#keuntunganUpdate').val('');
        }

        function getvalue() {
            var harga = document.getElementById('harga').value;
            var hargaJual = document.getElementById('hargaJual').value;
            var Hasilkeuntungan = hargaJual - harga;
            document.getElementById("keuntungan").value = Hasilkeuntungan;
        }

        function getvalueUpdate() {
            var harga = document.getElementById('hargaUpdate').value;
            var hargaJual = document.getElementById('hargaJualUpdate').value;
            var Hasilkeuntungan = hargaJual - harga;
            document.getElementById("keuntunganUpdate").value = Hasilkeuntungan;
        }

        // var rupiah = document.getElementById("harga");
        // rupiah.addEventListener("keyup", function(e) {
        //     rupiah.value = formatRupiah(this.value, "Rp. ");
        // });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
    <!-- Modal Input -->
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Data</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-simpan">
                        <label>ID</label>
                        <input type="text" class="form-control" id="idPaket" name="idPaket">
                        <label>Nama Operator</label>
                        <!-- <input type="text" class="form-control" id="idPelaku" name="idPelaku"> -->
                        <select id="idOperator" name="idOperator" class="form-control">
                            <?php foreach ($operatorM as $key => $value) : ?>
                                <option value="<?= $value->idOperator ?>"><?= $value->namaOperator ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <label>Nama Paket Internet</label>
                        <input type="text" class="form-control" id="namaPaket" name="namaPaket">
                        <label>Modal</label>
                        <input type="number" class="form-control" id="harga" name="harga">
                        <label>Harga Jual</label>
                        <input type="number" class="form-control" id="hargaJual" name="hargaJual" onchange="getvalue();">
                        <!-- <label>Keuntungan</label> -->
                        <input type="hidden" class="form-control" id="keuntungan" name="keuntungan" readonly="readonly">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block" onclick="simpan();">Save</span>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--form update -->
    <div class="modal fade text-left" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Data</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdate">
                        <input type="hidden" class="form-control" id="idPaketUpdate" name="idPaket">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control" id="namaPaketUpdate" name="namaPaket">
                        <label>Harga</label>
                        <input type="number" class="form-control" id="hargaUpdate" name="harga">
                        <label>Harga Jual</label>
                        <input type="number" class="form-control" id="hargaJualUpdate" name="hargaJual" onchange="getvalueUpdate();">
                        <!-- <label>Keuntungan</label> -->
                        <input type="hidden" class="form-control" id="keuntunganUpdate" name="keuntungan" readonly="readonly">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block" onclick="update();">Update</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>