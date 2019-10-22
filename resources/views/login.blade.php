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
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

    <style>
      .login-logo {
        height: 90px;
      }

      .login-topnav {
        box-shadow: 0 4px 2px -2px gray;
      }
      .form-title h3{
        font-size: 30px;
        font-weight: bold;
      }

      .login-wrapper {
        background: url('{{asset("img/login-bg.png")}}');
        height: 100vh;
        width: 100%;
        background-size: 100%;
      }

      .card-login {
        background-color: black;
        color: white;
        margin-top: 50px;
      }

      .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px; /* Set the fixed height of the footer here */
        line-height: 50px; /* Vertically center the text there */
        box-shadow: 0 -4px 2px -2px gray;
        background-color: white;
      }
      .footer-copyright{
        color: black;
      }

    </style>
  </head>
  <body class="login-wrapper">
    <div class="container-fluid bg-white login-topnav">
      <img class="login-logo" src="{{asset('img/login-logo.png')}}">
    </div>
    <div class="container">
        <div class="card card-login">
        <div class="card-body">
          <form id="form-login" method="post" action="/login">
            <div class="form-title"><h4>Login</h4></div>
            <div class="form-group mt-3">
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
            <!-- <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember_me" name="remember_me">
                  Remember me
                </label>
              </div>
            </div> -->
<!--           <div class="text-right my-3">
            <a class="forgot-password" href="forgot-password.php">Forgot Password?</a>
          </div> -->
            <button type="submit" class="btn btn-primary btn-block" name="btn-submit">Login</button>
          </form>
        </div>
      </div>
    </div>

  <footer class="footer">
      <div class="container text-center">
        <span class="footer-copyright">Copyright</span>
      </div>
    </footer>

  </body>
  </html>

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
              if (data.success === true)  {
                localStorage.setItem('token', data.token);
                window.location.href = data.url;
              }
              else {
                alert(data.error);
              } 
                
             
            }
          });
          return false;
        });
      });
    </script>
  </body>

</html>
