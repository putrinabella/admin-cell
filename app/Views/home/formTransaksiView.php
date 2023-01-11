<?= $this->extend('template/main'); ?>
<?= $this->section("content"); ?>
<title>Form Transaksi</title>

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app-dark.css">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.svg" type="image/x-icon">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png" type="image/png">

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/extensions/toastify-js/src/toastify.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/pages/filepond.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/extensions/choices.js/public/assets/styles/choices.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

<body>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Transaksi</h3>
                    <p class="text-subtitle text-muted">Selamat Datang, <?= session()->get('role'); ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Transaksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between ">
                        Form Transaksi
                        <a href="#" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm"><i data-feather="edit"></i> Add Data</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" id="form-simpan">
                                <div class="row">
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <h4 class="card-title">Transaksi Pembelian</h4>
                                            </br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>ID Transaksi</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="idTransaksi" class="form-control" name="idTransaksi" placeholder="ID Transaksi" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>NO. HP</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="number" id="noId" class="form-control" name="noId" placeholder="No.ID" />
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <label>Jenis Kelamin</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select id="jenisKelamin" name="jenisKelamin" class="form-control">
                                                        <option value="" selected disabled hidden>Jenis Kelamin</option>
                                                        <option value="Laki-laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <label>No. Telpon</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="number" id="noHp" class="form-control" name="noHp" placeholder="Nomor Telpon" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-12">
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <h4 class="card-title">Alat Transportasi Pelanggar</h4>
                                            </br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Jenis Kendaraan</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select id="jenisKendaraan" name="jenisKendaraan" class="form-control">
                                                        <option value="" selected disabled hidden>Jenis Kendaraan</option>
                                                        <option value="Sepeda Motor">Sepeda Motor</option>
                                                        <option value="Mobil">Mobil</option>
                                                        <option value="Bus">Bus</option>
                                                        <option value="Angkutan Umum">Angkutan Umum</option>
                                                        <option value="Angkutan Barang">Angkutan Barang</option>
                                                        <option value="Kendaraan Tidak Bermotor">Kendaraan Tidak Bermotor</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Merek</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select id="merek" name="merek" class="form-control">
                                                        <option value="" selected disabled hidden>Merek Kendaraan</option>
                                                        <option value="Honda">Honda</option>
                                                        <option value="Yamaha">Yamaha</option>
                                                        <option value="Toyota">Toyota</option>
                                                        <option value="Suzuki">Suzuki</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nomor Kendaraan</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="number" id="plat" class="form-control" name="plat" placeholder="Nomor Kendaraan" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nomor Rangka</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="number" id="noRangka" class="form-control" name="noRangka" placeholder="Nomor Rangka" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nomor Mesin</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="number" id="noMesin" class="form-control" name="noMesin" placeholder="Nomor Mesin" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            </br>
                                            <h4 class="card-title">Bentuk Pelanggaran</h4>
                                            </br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Bentuk Pelanggaran</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <div class="form-group mb-3">
                                                        <div class="form-group">
                                                            <select class="choices form-select" id="bentukPelanggaran" name="bentukPelanggaran" onchange="getselected()">
                                                                <option value="" selected disabled hidden>Bentuk Pelanggaran</option>
                                                            </select>
                                                        </div>
                                                        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nominal Denda</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="denda" id="denda" class="form-control" placeholder="Denda" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-12">
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            </br>
                                            <h4 class="card-title">Bukti Pelanggaran</h4>
                                            </br>
                                            <div class="row">
                                                <div class="col-md-0">
                                                    <input type="file" class="multiple-files-filepond" multiple id="foto">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <div class="card-body">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-11 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="<?= base_url(); ?>/public/assets/js/bootstrap.js"></script>
<script src="<?= base_url(); ?>/public/assets/js/app.js"></script>
<script src="<?= base_url(); ?>/public/assets/extensions/jquery/jquery.min.js"></script>

<script src="<?= base_url(); ?>/public/assets/extensions/filepond/filepond.js"></script>
<script src="<?= base_url(); ?>/public/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="<?= base_url(); ?>/public/assets/js/pages/filepond.js"></script>

<script src="<?= base_url(); ?>/public/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="<?= base_url(); ?>/public/assets/js/pages/form-element-select.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        rupiah = rupiah.split('', rupiah.length - 1).reverse().join('');
        return 'Rp. ' + (rupiah.length < 1 ? '0' : rupiah) + ',-';
    }

    function getselected() {
        var tmp = document.getElementById('bentukPelanggaran').value;
        document.getElementById("denda").value = convertToRupiah(tmp);
    }

    function simpan() {
        var data_input = $('#form-simpan').serialize();
        $.ajax({
                method: "POST",
                url: "<?= base_url('public/Home/simpanform'); ?>",
                data: data_input,
                dataType: "json"
            })
            .done(function(res) {
                // alert(res.msg);
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
        $('#username').val('');
        $('#password').val('');
        $('#nama').val('');
        $('#role').val('');
    }
</script>

<?= $this->endSection(); ?>