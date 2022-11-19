<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/svg+xml" href="{{ setting('logo_url') ?? '' }}" />
  <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 400px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }

    .form-signin .form-control:focus {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>


<body style="background: url(bg.jpeg);background-repeat: no-repeat;background-attachment: fixed; background-size: cover;">

  <form action="{{ route('login') }}" method="POST" class="form-signin card-body bg-white rounded">
    <h1 class="display-5 font-weight-bold mb-4">Masuk Akun</h1>
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      @error('email')
      <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
      @enderror

    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
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

    <div class="icheck-primary mb-2">
      <input type="checkbox" id="remember">
      <label for="remember" class="">
        Ingat Saya
      </label>
    </div>
  </form>
</body>

</html>