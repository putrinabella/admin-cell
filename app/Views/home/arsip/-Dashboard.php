<?= $this->extend('template/main'); ?>
<?= $this->section("content"); ?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> -->
<link href="<?= base_url(); ?>/public/assets/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<!-- <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" /> -->

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Account</h4>
                <!-- <p class="card-description">
                    Daftar user yang terdaftar
                </p> -->
                <div class="btnAdd">
                    <!-- <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#mymodal">
                        Insert Data
                    </button> -->
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <link href="<?= base_url(); ?>/public/assets/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js" rel="stylesheet" />
    <script src="<?= base_url(); ?>/public/assets/DataTables/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var table;
        $(document).ready(function() {
            table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                ajax: {
                    url: '<?= base_url('public/Home/dataAjax'); ?>',
                    type: 'POST'
                },
                columns: [{
                        data: 'username'
                    },
                    {
                        data: 'password',
                        render: function(data, type, row) {
                            return '********';
                        }
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'role'
                    }, {
                        data: 'username',
                        render: function(data, type, row) {
                            return '<a href="#" class="btn btn-danger" data-id="' + data + '" onclick="js_hapus($(this))">Hapus </a>';
                        }
                    }
                ]
            });
        });

        function js_hapus(id) {
            var id_delete = id.data('id');

            $.ajax({
                    method: "POST",
                    url: "<?= base_url('public/Home/hapus'); ?>",
                    data: {
                        id: id_delete
                    },
                    dataType: "json"
                })
                .done(function(res) {
                    // alert(res.msg);
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
                    url: "<?= base_url('public/Home/simpan'); ?>",
                    data: data_input,
                    dataType: "json"
                })
                .done(function(res) {
                    // alert(res.msg);
                    if (res.status) {
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
    </script>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input user</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-simpan">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <label>Password</label>
                            <input type="password   " class="form-control" id="password" name="password">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            <label>Role</label>
                            <input type="text" class="form-control" id="role" name="role">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-primary" onclick="simpan();">Save</button>
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>