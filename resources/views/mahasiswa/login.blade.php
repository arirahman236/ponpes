<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Pergudangan - Fahri</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="images/logo.png" type="image/x-icon"/>

  <!-- Fonts and icons -->
  <script src="js/plugin/webfont/webfont.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
    WebFont.load({
      google: {"families":["Lato:300,400,700,900"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["assets/css/fonts.min.css"]},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/atlantis.min2.css">
</head>
<body class="login">
  <div class="wrapper wrapper-login wrapper-login-full p-0">
    <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
    <div class="border-slate-300 text-slate-300"><img src="images/logo.png" alt="User Image" style="width:100px"></div>
      <h1 class="title fw-bold text-white mt-3 mb-3">Login Mahasiswa</h1>
      <p class="subtitle text-white op-7">Sistem Informasi Kampus</p>
    </div>
    <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
      <div class="container container-login container-transparent animated fadeIn">
        <h3 class="text-center">Sign In</h3>
        <form action="{{ url('/login') }}" method="post">
            @csrf
        <div class="login-form">
          <div class="form-group">
            <label for="email" class="placeholder"><b>Email</b></label>
            <input id="email" name="email" type="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password" class="placeholder"><b>Password</b></label>
            <div class="position-relative">
              <input id="password" name="password" type="password" class="form-control" required>
              <div class="show-password">
                <i class="fa fa-eye"></i>
              </div>
            </div>
          </div>
          <div class="form-group form-action-d-flex mb-3">
                <button type="submit" name="submit" value="login" class="btn btn-primary col-md-12 float-right mt-3 mt-sm-0 fw-bold" style="background-color: '#372eb3'">Sign in</button>
          </div>
          <div class="login-account">

            <a href="lupa-password.html" id="show-signup" class="link">Forget Password ?</a>
          </div>
          <br>
          <div class="login-account">
            <span class="msg">&copy; Sistem Informasi Kampus - 2021</span>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</body>
  <script src="js/jquery.3.2.1.min.js"></script>
  <script src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/atlantis.min.js"></script>
</html>
