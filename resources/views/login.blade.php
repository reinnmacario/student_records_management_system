<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
      .logo{
        text-align: center;
        height: auto;
        margin-bottom: 10px;
        width: 80px;
      }
      .form-title h3{
        font-size: 30px;
        font-weight: bold;
      }
    </style>
  </head>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="form-login" method="post" action="/login">
            <div class="text-center">
               <div class="form-title"><h3>Student Record Management System</h3></div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="username" name="email" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                <label for="password">Password</label>
              </div>
            </div>
            <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember_me" name="remember_me">
                  Remember me
                </label>
              </div>
            </div>
<!--           <div class="text-right my-3">
            <a class="forgot-password" href="forgot-password.php">Forgot Password?</a>
          </div> -->
            <button type="submit" class="btn btn-primary btn-block" name="btn-submit">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script>
      $(document).ready(function() {

        $(document).on('submit', '#form-login', function() {

          $.ajax({
            url: "login",
            type: "POST",
            beforeSend: function(request) {
              request.setRequestHeader("Authority", $('#token').val());
            },
            data: $(this).serialize(),
            processData: false,
            success: function(data) {
              if (data.token !== undefined) {
                window.location.href = "/dashboard";
              }
             
            },
            error: function(data) {
              if(data.status == 400) {
                console.log(data);
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, val) {
                      alert(val);
                    });
                }
            }
          });

          return false;

        });
      });
    </script>
  </body>

</html>
