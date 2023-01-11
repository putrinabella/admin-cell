<?= $this->extend('template/main'); ?>
<?= $this->section("content"); ?>
<title>Jenis Barang</title>

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
                    <h3>Jenis Barang</h3>
                    <p class="text-subtitle text-muted">Selamat Datang, <?= session()->get('role'); ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Data Master</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Jenis Barang</li>
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
                Jenis Barang
                <a href="#" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm"><i data-feather="edit"></i> Tambah Data</a>
            </div>
            <div class="card-body px-4 pt-4 pb-4">
                <div class="table">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jenis Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
                    url: '<?= base_url('public/barang/datajenis'); ?>',
                    type: 'POST'
                },
                columns: [{
                        data: 'idJenis'
                    },
                    {
                        data: 'jenisBarang'
                    },
                    {
                        data: 'idJenis',
                        render: function(data) {
                            return `${buttonDelete(data)} ${buttonUpdate(data)}`;
                        }
                    },
                ]
            });
        });

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
                    url: "<?= base_url('public/barang/hapusJenis'); ?>",
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
                    url: "<?= base_url('public/barang/simpanJenis'); ?>",
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
            $('#idJenis').val('');
            $('#jenisBarang').val('');
        }
    </script>
    <!--login form Modal -->
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
                        <label>ID Jenis</label>
                        <input type="text" class="form-control" id="idJenis" name="idJenis">
                        <label>Jenis Barang</label>
                        <input type="text   " class="form-control" id="jenisBarang" name="jenisBarang">
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
    <?= $this->endSection(); ?>