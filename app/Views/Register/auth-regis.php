<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png">
  <title>Register - Mazer Admin Dashboard</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url(); ?>/public/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>/public/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url(); ?>/public/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url(); ?>/public/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Register</h4>
                  <p class="mb-0">Enter your username, name and password to register</p>
                </div>
                <div class="card-body">
                  <?= $pesan_ui; ?>
                  <form method="POST" class="register-form" id="login-form" role="form" action="<?= base_url('public/login/daftar'); ?>">
                    <div class="mb-3">
                      <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="nama">
                    </div>
                    <div class="mb-3">
                      <input type="text" name="nama" class="form-control form-control-lg" placeholder="Name" aria-label="nama">
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="role" class="form-control form-control-lg" value="User">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Register</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Already have an account?
                    <a href="<?= base_url('public/login'); ?>" class="text-info text-gradient font-weight-bold">Login</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('<?= base_url(); ?>/public/assets/images/Regis.jpeg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Daily Reminder"</h4>
                <p class="text-white position-relative">Don't be so hard on yourself, you're doing great!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="<?= base_url(); ?>/public/assets/js/core/popper.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/bootstrap.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/app.js"></script>
  <script src="<?= base_url(); ?>/public/assets/extensions/jquery/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/pages/datatables.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url(); ?>/public/assets/js/argon-dashboard.min.js?v=2.0.4"></script>

  <!--login form Modal -->
  <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Register Form </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form id="form-simpan">
          <div class="modal-body">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username">
            <label>Password</label>
            <input type="password   " class="form-control" id="password" name="password">
            <label>Nama</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <label>Role</label>
            <input type="text" class="form-control" id="role" name="role">
            <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
              </button>
              <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block" onclick="simpan();">Sign Up</span>
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>