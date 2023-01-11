<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Mazer Admin Dashboard</title>
  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main/app.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/pages/auth.css" />
  <link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.svg" type="image/x-icon" />
  <link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo/favicon.png" type="image/png" />
</head>

<body>
  <div id="auth">
    <div class="position-center">
      <section class="sign-in">
        <div class="container">
          <div class="signin-content">
            <div class="signup-image">
              <figure><img src="<?= base_url(); ?>/public/assets/images/regis icon.png" alt="sing up image"></figure>
            </div>
            <div class="signin-form">
              <h2 class="form-title">Register Here</h2>
              <?= $pesan_ui; ?>
              <form method="POST" class="register-form" id="login-form" role="form" action="<?= base_url('public/login/daftar'); ?>">
                <div class="form-group position-relative has-icon-left mb-4">
                  <input type="text" name="username" class="form-control form-control-l" placeholder="Username" />
                  <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                  </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                  <input type="text" name="nama" class="form-control form-control-l" placeholder="Name" />
                  <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                  </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                  <input type="password" name="password" class="form-control form-control-l" placeholder="Password" />
                  <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                  </div>
                </div>
                <div class="mb-3">
                  <select id="role" name="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                  </select>
                </div>
                <div class="form-check form-check-lg d-flex align-items-end">
                  <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label text-gray-600" for="flexCheckDefault">
                    Keep me logged in
                  </label>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill btn-block btn-lg shadow-lg mt-5">
                  Sign up
                </button>
              </form>

              <p class="text-gray-600">
                <br>
                Already have an account?
                <a href="<?= base_url('public/login'); ?>" class="font-bold">Login</a>.
              </p>
              <!-- <p>
                  <a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.
                </p> -->
            </div>
          </div>
        </div>
      </section>
      <!-- <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right"></div>
      </div> -->
    </div>
  </div>


</body>

</html>