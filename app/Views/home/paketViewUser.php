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
                            <li class="breadcrumb-item"><a href="#">Menu</a></li>
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
                    }

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
    </script>
    <?= $this->endSection(); ?>