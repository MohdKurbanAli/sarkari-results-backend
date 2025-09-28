<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from phpstack-1384472-5121645.cloudwaysapps.com/template/html/ra-admin/template/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Sep 2025 12:27:50 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
  <meta name="keywords"
    content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="la-themes">
  <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">

  <title>Sign In | ra-admin - Premium Admin Template</title>

  <!--font-awesome-css-->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.css') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&amp;display=swap" rel="stylesheet">

  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.css') }}">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">

  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
  <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">  

</head>

<body class="sign-in-bg">
    <div class="app-wrapper d-block">
        <div class="main-container">
        <!-- Body main section starts -->
        <div class="container">
            <div class="row sign-in-content-bg">
            <div class="col-lg-6 image-contentbox d-none d-lg-block">
                <div class="form-container ">
                <div class="signup-content mt-4">
                    <span>
                    <img src="{{ asset('assets/images/logo/1.png') }}" alt="" class="img-fluid ">
                    </span>
                </div>
                
                <div class="signup-bg-img">
                    <img src="{{ asset('assets/images/login/04.png') }}" alt="" class="img-fluid">
                </div>
                </div>

            </div>
            <div class="col-lg-6 form-contentbox">
                <div class="form-container">
                <form class="app-form" id="login" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5 text-center text-lg-start">
                            <h2 class="text-primary f-w-600">Welcome To <br> SARKARI RESULTS BACKEND! </h2>
                            <p>Sign in with your credientials</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" placeholder="Enter Your Username" id="username" name="username" value="{{ old('username') }}">
                                <span id="usernameerror" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>                            
                                <input type="password" class="form-control" placeholder="Enter Your Password" id="password" name="password" value="{{ old('password') }}">
                                <span id="passworderror" style="color: red;"></span>
                            </div>
                        </div>                    
                        <div class="col-12">
                            <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                            </div>
                        </div>                    
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <!-- Body main section ends -->
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "1000"
        }

        $(document).ready(function () {
            $('#login').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('admin_login') }}",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false, 
                    success: function (data) {
                        if (data == '1') {
                            toastr.success("Login Successful");
                            setTimeout(function () {
                                window.location.href = '/';
                            }, 2000);
                        } else {
                            toastr.warning("Invalid credentials");                            
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            if (xhr.responseJSON.errors.username) {
                                $('#usernameerror').text(xhr.responseJSON.errors.username);
                            } else {
                                $('#usernameerror').text(''); 
                            }

                            if (xhr.responseJSON.errors.password) {
                                $('#passworderror').text(xhr.responseJSON.errors.password);
                            } else {
                                $('#passworderror').text('');
                            }
                        }

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        } else {
                            toastr.error('An unexpected error occurred.');
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>    