<?= $this->extend('template/main'); ?>
<?= $this->section("content"); ?>
<title>Dashboard</title>

<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app-dark.css">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.svg" type="image/x-icon">
<link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png" type="image/png">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/shared/iconly.css">


<div class="page-heading">
    <h3>Dashboard</h3>

</div>
<div class="page-content">
    <section class="row">

        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-9 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Mazer Cell - Puas Browsing Tanpa Pusing </h4>
                        </div>
                        <div class="card-body">
                            <!-- <h6>Puas Browsing Tanpa Pusing</h6> -->
                            <h7>Paket data termurah untuk semua operator di Indonesia</h7>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Username</h6>
                                    <h6 class="font-extrabold mb-0"> <?= session()->get('username'); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <center>
                                <h5>Management User</h5>
                            </center>
                            </br>
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Admin</h6>
                                    <h6 class="font-extrabold mb-0"> <?= $countAdmin; ?> </h6>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldUser1"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">User</h6>
                                    <h6 class="font-extrabold mb-0"> <?= $countUser; ?> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <center>
                                <h5>Keuangan</h5>
                            </center>
                            </br>
                            <div class="row">
                                <div class="col-6 col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4   d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="iconly-boldArrow---Down"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                            <h6 class="text-muted font-semibold">Pemasukan</h6>
                                            <h6 class="font-extrabold mb-0"> <?= rupiah(intval($countPemasukan)) ?> </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldWallet"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                            <h6 class="text-muted font-semibold">Keuntungan</h6>
                                            <h6 class="font-extrabold mb-0"> <?= rupiah(intval($countKeuntungan)) ?> </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <!-- <div class="col-6 col-lg-3 col-md-6">
                                </div> -->
                                <div class="col-6 col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldArrow---Up"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                            <h6 class="text-muted font-semibold">Pengeluaran</h6>
                                            <h6 class="font-extrabold mb-0"> <?= rupiah(intval($countPengeluaran)) ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <center>
                                <h5>Transaksi</h5>
                            </center>
                            </br>
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldChart"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Total Transaksi</h6>
                                    <h6 class="font-extrabold mb-0"> <?= $countTransaksi ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>

</div>

<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<script src="<?= base_url(); ?>/public/assets/js/bootstrap.js"></script>
<script src="<?= base_url(); ?>/public/assets/js/app.js"></script>

<!-- Need: Apexcharts -->
<script src="<?= base_url(); ?>/public/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url(); ?>/public/assets/js/pages/dashboard.js"></script>

<?= $this->endSection(); ?>