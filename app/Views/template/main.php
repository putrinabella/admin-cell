<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Mazer Admin Dashboard</title>

  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app-dark.css">
  <link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.svg" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png" type="image/png">

  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/shared/iconly.css">

</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
          <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
              <a href="#"><img src="<?= base_url(); ?>/public/assets/images/logo/logo.svg" alt="Logo" srcset=""></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                  <g transform="translate(-210 -1)">
                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                    <circle cx="220.5" cy="11.5" r="4"></circle>
                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                  </g>
                </g>
              </svg>
              <div class="form-check form-switch fs-6">
                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                <label class="form-check-label"></label>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
              </svg>
            </div>
            <div class="sidebar-toggler  x">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>

        <div class="sidebar-menu">
          <ul class="menu">
            <?php if (session()->get('role') == 'Admin') { ?>
              <li class="sidebar-title">Menu</li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/'); ?>" class='sidebar-link'>
                  <i class="bi bi-house-fill"></i>
                  <span>Dashboard</span>
                </a>
              </li>

              <li class="sidebar-title">Data Master</li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/namaoperator" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/namaoperator'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-window-plus"></i>
                  </i>
                  <span>Operator</span>
                </a>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/operator" ? "active" : "" ?>">
                <a href="<?= base_url('public/operator'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-list-ol"></i>
                  </i>
                  <span>Paket Internet</span>
                </a>
              <li class="sidebar-title">Transaksi</li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/transaksi" ? "active" : "" ?>">
                <a href="<?= base_url('public/transaksi'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-pencil-square"></i>
                  </i>
                  <span>Form</span>
                </a>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/transaksi/database" ? "active" : "" ?>">
                <a href="<?= base_url('public/transaksi/database'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-receipt"></i>
                  </i>
                  <span>Database</span>
                </a>
              <li class="sidebar-title">User Database</li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/datauser" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/datauser'); ?>" class='sidebar-link'>
                  <i class="bi bi-people-fill"></i>
                  <span>Manajemen User</span>
                </a>
              </li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/datauser" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/datauser'); ?>" class='sidebar-link'>
                  <i class="bi bi-people-fill"></i>
                  <span>Manajemen User</span>
                </a>
              </li>
              <li class="sidebar-title">Logout</li>
              <li class="sidebar-item">
                <a href="<?= base_url('public/login/logout'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-arrow-right"></i>
                  </i>
                  <span>Logout</span>
                </a>
              </li>
            <?php } ?>

            <!-- Untuk User -->
            <?php if (session()->get('role') == 'User') { ?>
              <li class="sidebar-title">Menu</li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/'); ?>" class='sidebar-link'>
                  <i class="bi bi-house-fill"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/operator/foruser" ? "active" : "" ?>">
                <a href="<?= base_url('public/operator/foruser'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-list-ol"></i>
                  </i>
                  <span>Paket Internet</span>
                </a>

              <li class="sidebar-title">Transaksi</li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/transaksi" ? "active" : "" ?>">
                <a href="<?= base_url('public/transaksi'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-pencil-square"></i>
                  </i>
                  <span>Form</span>
                </a>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/transaksi/databaseUser" ? "active" : "" ?>">

                <a href="<?= base_url('public/transaksi/databaseUser'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-receipt"></i>
                  </i>
                  <span>Database</span>
                </a>
              <li class="sidebar-title">Logout</li>
              <li class="sidebar-item">
                <a href="<?= base_url('public/login/logout'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-arrow-right"></i>
                  </i>
                  <span>Logout</span>
                </a>
              </li>
            <?php } ?>

            <!-- Untuk Developer -->
            <?php if (session()->get('role') == 'Developer') { ?>
              <li class="sidebar-title">Cancel Page</li>
              <li class="sidebar-item">
                <a href="<?= base_url('public/login/logout'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-arrow-right"></i>
                  </i>
                  <span>Logout</span>
                </a>
              </li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/kategoripelanggar" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/kategoripelanggar'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-people-fill"></i>
                  </i>
                  <span>Pelaku Pelanggar</span>
                </a>

              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/pelanggaran" ? "active" : "" ?>">
                <a href="<?= base_url('public/pelanggaran'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-bookmarks-fill"></i>
                  </i>
                  <span>Bentuk Pelanggaran</span>
                </a>

              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/form" ? "active" : "" ?>">
                <a href="<?= base_url('public/form'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-file-earmark-diff-fill"></i>
                  </i>
                  <span>Form Tilang</span>
                </a>
              </li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/databaseform" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/databaseform'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-file-earmark-diff-fill"></i>
                  </i>
                  <span>Database</span>
                </a>
              </li>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/kategori" ? "active" : "" ?>">
                <!-- <li class="sidebar-item active"> -->
                <a href="<?= base_url('public/home/kategori'); ?>" class='sidebar-link'>
                  <i class="bi bi-pen-fill"></i>
                  <span>Kategori</span>
                </a>
              </li>

              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/jenisview" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/jenisview'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-window-plus"></i>
                  </i>
                  <span>Jenis Barang</span>
                </a>

              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/jenis" ? "active" : "" ?>">
                <a href="<?= base_url('public/jenis'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-list-ol"></i>
                  </i>
                  <span>Data Barang</span>
                </a>

              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/formtransaksi" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/formtransaksi'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-list-ol"></i>
                  </i>
                  <span>Form Transaksi</span>
                </a>
              <li class="sidebar-item  <?= $_SERVER["REQUEST_URI"] == "/myproject/public/home/mbti" ? "active" : "" ?>">
                <a href="<?= base_url('public/home/mbti'); ?>" class='sidebar-link'>
                  <i class="the-icon">
                    <i class="bi bi-magic"></i>
                  </i>
                  <span>MBTI</span>
                </a>
              <?php } ?>

          </ul>
        </div>
      </div>
    </div>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      <div class="page-content">
        <section class="row">

          <?= $this->renderSection("content"); ?>

        </section>
      </div>
      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>Pemrograman Web Lanjut</p>
          </div>
          <div class="float-end">
            <!-- <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="https://www.instagram.com/putrinabella__/?hl=id">Putri Nabella - 2011016220026</a></p> -->
            <p><a href="https://www.instagram.com/putrinabella__/?hl=id">Putri Nabella - 2011016220026</a></p>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="<?= base_url(); ?>/public/assets/js/bootstrap.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/app.js"></script>

  <!-- Need: Apexcharts -->
  <script src="<?= base_url(); ?>/public/assets/extensions/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/pages/dashboard.js"></script>

</body>

</html>