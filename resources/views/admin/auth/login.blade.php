<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    {{-- <title>Tiny Dashboard - A Bootstrap Dashboard Template</title> --}}
     <title>Admin Login</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="asset/admin/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="asset/admin/css/feather.css">
    <!-- Date Range Picker CSS -->
    {{-- <link rel="stylesheet" href="css/daterangepicker.css"> --}}
     <!-- App CSS -->
    <link rel="stylesheet" href="asset/admin/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="asset/admin/css/app-dark.css" id="darkTheme" disabled> 
  </head>
  <body class="light ">
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="{{route('adminLoginPost')}}" method="POST">
            @csrf
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
           <h1>Admin Login</h1> 
          </a>
          <h1 class="h6 mb-3">Sign in</h1>
            @if(\Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{ \Session::get('success') }}
                </div>
            </div>
            @endif
            {{ \Session::forget('success') }}
            @if(\Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{ \Session::get('error') }}
                </div>
            </div>
            @endif
          <div class="form-group">
            <a class=" btn-secondary mb-3 btn btn-block" href="{{ route('google.redirect') }}">Login with Google</a>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="email" name="email"   value="{{ old('email') }}" class="form-control form-control-lg @if ($errors->has('email')) is-invalid  @endif" placeholder="Email address"  autofocus="">
              @if ($errors->has('email'))
                            <span class="">
                                <strong class="text-danger float-left">{{ $errors->first('email') }}</strong>
                            </span>
              @endif

          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg  @if ($errors->has('email')) is-invalid  @endif" placeholder="Password" >
             @if ($errors->has('password'))
                <span class="text-danger">
                    <strong class="text-danger float-left">{{ $errors->first('password') }}</strong>
                </span>
              @endif

          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">© 2022</p>
        </form>
      </div>
    </div>
   
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>
</body>
</html>