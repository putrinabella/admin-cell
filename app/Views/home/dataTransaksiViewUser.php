<?= $this->extend('template/main'); ?>
<?= $this->section("content"); ?>
<title>Transaksi</title>

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app-dark.css">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.svg" type="image/x-icon">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png" type="image/png">

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/pages/fontawesome.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/pages/datatables.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<body>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Transaksi</h3>
                    <p class="text-subtitle text-muted">Selamat Datang, <?= $username = session()->get('username'); ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Database</li>
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
                Transaksi
                <a href="#" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm"><i data-feather="edit"></i> Tambah Transaksi</a>
            </div>
            <div class="card-body px-4 pt-4 pb-4">
                <div class="table">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>No HP</th>
                                <th>Operator</th>
                                <th>Nama Paket</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#idOperator').select2({
            theme: 'bootstrap-5'
        });

        $('#idPaket').select2({
            theme: 'bootstrap-5',
            ajax: {
                url: "<?= base_url('public/Transaksi/loadPaket'); ?>",
                dataType: 'json',
                delay: 250,
                data: function(data) {
                    return {
                        idOperator: $('#idOperator').val(),
                        searchTerm: data.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
        });

        var table;
        $(document).ready(function() {
            table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                // lengthChange: false,
                ajax: {
                    url: '<?= base_url('public/Transaksi/dataUser'); ?>',
                    type: 'POST'
                },
                columns: [{
                        data: 'idTransaksi'
                    },
                    {
                        data: 'nohp',
                    },
                    {
                        data: 'namaOperator',
                    },
                    {
                        data: 'namaPaket',
                    },
                    {
                        render: function(data, type, row) {
                            return `${buttonDelete(row.idTransaksi)} ${buttonUpdate(row.idTransaksi, row.nohp, row.idOperator, row.idPaket)}`;
                        }
                    },
                ]
            });
        });

        function buttonDelete(data) {
            return `<a href="#" class="btn icon btn-danger" data-id="${data}" onclick="js_hapus($(this))"> <i class="bi bi-trash"></i></a>`;
        }

        function buttonUpdate(idTransaksi, nohp, idOperator, idPaket) {
            return `<a href="#" class="btn icon btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate" data-id="${idTransaksi}" onclick="getData('${idTransaksi}','${nohp}', '${idOperator}','${idPaket}')"> <i class="bi bi-pencil"></i></a>`;
        }

        let idTransaksiUpdate = null;

        function getData(idTransaksi, nohp, idOperator, idPaket) {
            idTransaksiUpdate = idTransaksi;
            $('#nohpUpdate').val(nohp);
            $('#idOperatorUpdate').val(idOperator);
            $('#idPaketUpdate').val(idPaket);
        }

        function update() {
            var data_input = $('#formUpdate').serialize();
            $.ajax({
                    method: "POST",
                    url: "<?= base_url('public/transaksi/update'); ?>" + '/' + idTransaksiUpdate,
                    data: data_input,
                    dataType: "json"
                })
                .done(function(res) {
                    if (res.status) {
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
                    url: "<?= base_url('public/Transaksi/hapus'); ?>",
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
                    url: "<?= base_url('public/Transaksi/simpandata'); ?>",
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
            $('#idTransaksi').val('');
            $('#nohp').val('');
            $('#keuntungan').val('');
        }
    </script>
    <!--form Input -->
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
                        <label>ID Transaksi</label>
                        <input type="text" class="form-control" id="idTransaksi" name="idTransaksi">
                        <label>No. HP</label>
                        <input type="number" class="form-control" id="nohp" name="nohp">
                        <label>Operator</label>
                        <select id="idOperator" name="idOperator" class="form-control">
                            <?php foreach ($operatorM as $key => $value) : ?>
                                <option value="<?= $value->idOperator ?>"><?= $value->namaOperator ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <label>Paket</label>
                        <select id="idPaket" name="idPaket" class="form-control">
                            <option value=""></option>
                        </select>
                        <label>User</label>
                        <input type="" class="form-control" value="<?= $username ?>" id="username" name="username" readonly="readonly">
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
                        <input type="hidden" class="form-control" id="idTransaksiUpdate" name="idTransaksi">
                        <label>No. HP</label>
                        <input type="number" class="form-control" id="nohpUpdate" name="nohp">
                        <label>Operator</label>
                        <select id="idOperatorUpdate" name="idOperator" class="form-control">
                            <?php foreach ($operatorM as $key => $value) : ?>
                                <option value="<?= $value->idOperator ?>"><?= $value->namaOperator ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <label>Paket</label>
                        <select id="idPaketUpdate" name="idPaket" class="form-control">
                            <option value=""></option>
                        </select>
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

    <script>
        $('#idOperatorUpdate').select2({
            theme: 'bootstrap-5'
        });

        $('#idPaketUpdate').select2({
            theme: 'bootstrap-5',
            ajax: {
                url: "<?= base_url('public/Transaksi/loadPaket'); ?>",
                dataType: 'json',
                delay: 250,
                data: function(data) {
                    return {
                        idOperator: $('#idOperatorUpdate').val(),
                        searchTerm: data.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
        });

        $('#idOperator').select2({
            theme: 'bootstrap-5'
        });

        $('#idPaket').select2({
            theme: 'bootstrap-5',
            ajax: {
                url: "<?= base_url('public/Transaksi/loadPaket'); ?>",
                dataType: 'json',
                delay: 250,
                data: function(data) {
                    return {
                        idOperator: $('#idOperator').val(),
                        searchTerm: data.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
        });
    </script>
    <?= $this->endSection(); ?>