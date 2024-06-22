<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MY SWADAYA - Login </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin')}}/assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Seal_of_Magetan_Regency.svg/442px-Seal_of_Magetan_Regency.svg.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <center>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Seal_of_Magetan_Regency.svg/442px-Seal_of_Magetan_Regency.svg.png" alt="logo">
                </center>
              </div>
              <h4 class="text-center">Air Swadaya Desa Sidorejo</h4>
              <h6 class="fw-light text-center">Sign in untuk melanjutkan</h6>
              @if (session()->has('loginError'))

              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
            
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <form class="pt-3" action="/login" method="POST">
                @csrf
                <div class="col-auto">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">@</div>
                    </div>
                    <input type="text" name="username" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                  </div>
                </div>
                <div class="col-auto">
                  <label class="sr-only" for="inlineFormInputGroup">Password</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="bi bi-key"></i></div>
                    </div>
                    <input type="password" name="password" class="form-control" id="inlineFormInputGroup" placeholder="Password">
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="width: 100%;" >SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('admin')}}/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="{{asset('admin')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('admin')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('admin')}}/assets/js/off-canvas.js"></script>
  <script src="{{asset('admin')}}/assets/js/hoverable-collapse.js"></script>
  <script src="{{asset('admin')}}/assets/js/template.js"></script>
  <script src="{{asset('admin')}}/assets/js/settings.js"></script>
  <script src="{{asset('admin')}}/assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>