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
                    <p class="text-subtitle text-muted">Selamat Datang, <?= session()->get('username'); ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" id="form-simpan">
                        <div class="row">
                            <!-- <div class="col-md-5 col-12"> -->
                            <div class="form-group">
                                <h4 class="card-title">Transaksi Pembelian</h4>
                                </br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>ID Transaksi</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <input type="text" id="idTransaksi" class="form-control" name="idTransaksi" placeholder="ID Transaksi" />
                                    </div>
                                    <div class="col-md-2">
                                        <label>NO. HP</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <input type="number" id="nohp" class="form-control" name="nohp" placeholder="No HP" />
                                    </div>
                                    <div class="col-md-2">
                                        <label>Operator</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <select id="idOperator" name="idOperator" class="form-control">
                                            <option value="" selected disabled hidden>Select Here</option>
                                            <?php foreach ($operatorM as $key => $value) : ?>
                                                <option value="<?= $value->idOperator ?>"><?= $value->namaOperator ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Paket</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <select id="idPaket" name="idPaket" class="form-control">
                                            <option value="" selected disabled hidden>Select Here</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>User</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <input type="text" id="username" class="form-control" name="username" value="<?= session()->get('username'); ?>" readonly="readonly" />
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                            <!-- <div class="col-md-1 col-12">
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="form-group">
                                    <h4 class="card-title">Whats Here!</h4>
                                    </br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="<?= base_url(); ?>/public/assets/images/Logo.jpeg" height="300">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1" onclick="simpan();">Submit </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1"> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between ">
                Transaksi
                <a href="#" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm"><i data-feather="edit"></i> Tambah Data</a>
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
                                <th>Keuntungan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->

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
        // $(document).ready(function() {
        //     table = $('#myTable').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         // lengthChange: false,
        //         ajax: {
        //             url: '<?= base_url('public/Transaksi/data'); ?>',
        //             type: 'POST'
        //         },
        //         columns: [{
        //                 data: 'idTransaksi'
        //             },
        //             {
        //                 data: 'nohp',
        //             },
        //             {
        //                 data: 'namaOperator',
        //             },
        //             {
        //                 data: 'namaPaket',
        //             },
        //             {
        //                 data: 'keuntungan',
        //                 render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
        //             },
        //             {
        //                 data: 'idTransaksi',
        //                 render: function(data) {
        //                     return `${buttonDelete(data)}  ${buttonUpdate(data)}`;
        //                 }
        //             },
        //         ]
        //     });
        // });

        function buttonDelete(data) {
            return `<a href="#" class="btn icon btn-danger" data-id="${data}" onclick="js_hapus($(this))"> <i class="bi bi-trash"></i></a>`;
        }

        function buttonUpdate(data) {
            return `<a href="#" class="btn icon btn-primary" data-id="${data}" onclick=""> <i class="bi bi-pencil"></i></a>`;
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
                    url: "<?= base_url('public/Transaksi/simpan'); ?>",
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

    <?= $this->endSection(); ?>