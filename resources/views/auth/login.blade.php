<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/svg+xml" href="/icon.svg" />
  <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>


<body style="height: 100vh;">
  <div class="container-fluid" style="height: 100vh;">
    <div class="row" style="height: 100vh;">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="d-flex align-items-center my-3 ">
          <div class="mb-5">

            <h1 class="display-5 font-weight-bold mb-4">Masuk Akun</h1>
            <!-- <h2 class="mt-5 mb-4 text-bold">Masuk Akun</h2> -->
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="Alamat E-mail">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>

              </div>
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="input-group mt-3 mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="div mb-3">
                {!! NoCaptcha::display() !!}
                {!! NoCaptcha::renderJs() !!}
                @error('g-recaptcha-response')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary btn-block mb-3 shadow">Masuk</button>

              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember" class="">
                  Ingat Saya
                </label>
              </div>
            </form>
            <div class="d-flex d-flex justify-content-between d-flex align-items-center">
              <div class="mt-5 mb-5">
                <div style="box-sizing: border-box;width: 430px; height: 70px;">


                  <a href="#" class="">{{ setting('footer_text') }}</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 d-flex justify-content-center" style="background: linear-gradient(to top, transparent, rgba(0,0,0,0.8)), url(bg.jpg); background-repeat: no-repeat; background-size: cover;">
        <!-- Page Wrapper -->
        <div class="page-holder bg-cover">

          <div class="container py-5">
            <header class="text-center text-white py-5">
              <p class="display-4 font-weight-bold mb-4 text-capitalize">{{ setting('site_name') }}</p>
              <h1 class="lead p text-capitalize mb-4">{{ setting('site_title') }}</h1>
              <img src="{{ setting('logo_url') ?? '' }}" class="img-circle elevation-1" alt="User Image" style="height: 200px; width: 200px;">

            </header>


          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>