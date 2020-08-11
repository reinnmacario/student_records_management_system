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

      .card-login-info{
        margin-top: 50px;
        margin-bottom: 20px;
      }

      .tab-info{
        margin-top: 20px;
      }
      .footer {
        /*position: absolute;*/
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
     <h5 class="py-3">Student Records Management System</h5> 
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
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
        <div class="card-footer" style="background-color: gray; padding: 20px 20px 40px; ">
          <div class="card-footer-info">
            Contact Details
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 offset-md-1">
      <div class="card card-login-info">
        <div class="card-body">
          <h4>What is Student Activities Records System?</h4>
        <nav class="mt-3">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
            <a class="nav-item nav-link" id="nav-so-tab" data-toggle="tab" href="#nav-so" role="tab" aria-controls="nav-so" aria-selected="true">SO</a>
            <a class="nav-item nav-link" id="nav-socc-tab" data-toggle="tab" href="#nav-socc" role="tab" aria-controls="nav-socc" aria-selected="false">SOCC</a>
            <a class="nav-item nav-link" id="nav-osa-tab" data-toggle="tab" href="#nav-osa" role="tab" aria-controls="nav-osa" aria-selected="false">OSA</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
            <div class="tab-info">
              <h5>Info</h5>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et rhoncus enim, faucibus eleifend ex. Nunc felis sapien, pretium non turpis nec, lacinia convallis sem. Ut ac congue orci. Suspendisse pulvinar, felis id vehicula iaculis, massa neque viverra magna, a eleifend sem felis sit amet dolor. Aenean quis nisi posuere, ultricies ligula a, elementum eros. Phasellus a turpis quis ipsum feugiat imperdiet. Nam ullamcorper, nunc sit amet dictum consequat, lacus ligula sagittis elit, a scelerisque quam libero vel lorem. Fusce vel ornare massa. Donec velit nibh, consectetur nec vulputate in, dapibus ut est.</p>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget feugiat orci. Nullam vestibulum bibendum diam, quis mattis odio suscipit maximus. Morbi tempus lacus vestibulum tortor placerat, quis tincidunt dolor varius. Nunc tempor auctor iaculis. Praesent mauris erat, gravida eu magna nec, lobortis posuere orci. Nulla felis tellus, sodales viverra lacinia ac, condimentum sit amet metus. Proin pellentesque nisi nec vulputate elementum. Aliquam erat volutpat. Ut non massa elementum, tincidunt tortor sed, interdum ante. Curabitur in iaculis mi, non pellentesque ligula. Mauris hendrerit elit in auctor fermentum.
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-so" role="tabpanel" aria-labelledby="nav-so-tab">
            <div class="tab-info">
              <h5>SO</h5>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et rhoncus enim, faucibus eleifend ex. Nunc felis sapien, pretium non turpis nec, lacinia convallis sem. Ut ac congue orci. Suspendisse pulvinar, felis id vehicula iaculis, massa neque viverra magna, a eleifend sem felis sit amet dolor. Aenean quis nisi posuere, ultricies ligula a, elementum eros. Phasellus a turpis quis ipsum feugiat imperdiet. Nam ullamcorper, nunc sit amet dictum consequat, lacus ligula sagittis elit, a scelerisque quam libero vel lorem. Fusce vel ornare massa. Donec velit nibh, consectetur nec vulputate in, dapibus ut est.</p>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget feugiat orci. Nullam vestibulum bibendum diam, quis mattis odio suscipit maximus. Morbi tempus lacus vestibulum tortor placerat, quis tincidunt dolor varius. Nunc tempor auctor iaculis. Praesent mauris erat, gravida eu magna nec, lobortis posuere orci. Nulla felis tellus, sodales viverra lacinia ac, condimentum sit amet metus. Proin pellentesque nisi nec vulputate elementum. Aliquam erat volutpat. Ut non massa elementum, tincidunt tortor sed, interdum ante. Curabitur in iaculis mi, non pellentesque ligula. Mauris hendrerit elit in auctor fermentum.
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-socc" role="tabpanel" aria-labelledby="nav-socc-tab">
            <div class="tab-info">
              <h5>SOCC</h5>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et rhoncus enim, faucibus eleifend ex. Nunc felis sapien, pretium non turpis nec, lacinia convallis sem. Ut ac congue orci. Suspendisse pulvinar, felis id vehicula iaculis, massa neque viverra magna, a eleifend sem felis sit amet dolor. Aenean quis nisi posuere, ultricies ligula a, elementum eros. Phasellus a turpis quis ipsum feugiat imperdiet. Nam ullamcorper, nunc sit amet dictum consequat, lacus ligula sagittis elit, a scelerisque quam libero vel lorem. Fusce vel ornare massa. Donec velit nibh, consectetur nec vulputate in, dapibus ut est.</p>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget feugiat orci. Nullam vestibulum bibendum diam, quis mattis odio suscipit maximus. Morbi tempus lacus vestibulum tortor placerat, quis tincidunt dolor varius. Nunc tempor auctor iaculis. Praesent mauris erat, gravida eu magna nec, lobortis posuere orci. Nulla felis tellus, sodales viverra lacinia ac, condimentum sit amet metus. Proin pellentesque nisi nec vulputate elementum. Aliquam erat volutpat. Ut non massa elementum, tincidunt tortor sed, interdum ante. Curabitur in iaculis mi, non pellentesque ligula. Mauris hendrerit elit in auctor fermentum.
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-osa" role="tabpanel" aria-labelledby="nav-osa-tab">
            <div class="tab-info">
              <h5>OSA</h5>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et rhoncus enim, faucibus eleifend ex. Nunc felis sapien, pretium non turpis nec, lacinia convallis sem. Ut ac congue orci. Suspendisse pulvinar, felis id vehicula iaculis, massa neque viverra magna, a eleifend sem felis sit amet dolor. Aenean quis nisi posuere, ultricies ligula a, elementum eros. Phasellus a turpis quis ipsum feugiat imperdiet. Nam ullamcorper, nunc sit amet dictum consequat, lacus ligula sagittis elit, a scelerisque quam libero vel lorem. Fusce vel ornare massa. Donec velit nibh, consectetur nec vulputate in, dapibus ut est.</p>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget feugiat orci. Nullam vestibulum bibendum diam, quis mattis odio suscipit maximus. Morbi tempus lacus vestibulum tortor placerat, quis tincidunt dolor varius. Nunc tempor auctor iaculis. Praesent mauris erat, gravida eu magna nec, lobortis posuere orci. Nulla felis tellus, sodales viverra lacinia ac, condimentum sit amet metus. Proin pellentesque nisi nec vulputate elementum. Aliquam erat volutpat. Ut non massa elementum, tincidunt tortor sed, interdum ante. Curabitur in iaculis mi, non pellentesque ligula. Mauris hendrerit elit in auctor fermentum.
              </p>
            </div>
          </div>
        </div>
        </div>
      </div>
      
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
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

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
