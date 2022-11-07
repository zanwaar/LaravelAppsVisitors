<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="/icon.svg" />
    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-info">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-9 px-5 mt-5 ">
                <div class=" my-5">
                    <div class=" p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="text-center p-5 mt-2">
                                    <img alt="logo" style="width: 10rem;">
                                    <h1 class="h3 mt-1 text-white font-weight-normal ">Kabupaten Maluku Tengah </h1>
                                    <p class="mt-4 text-white text-center">&copy; 2019-Dishub Malteng</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5 ">
                                    <div class="text-center ">
                                        <h1 class="h1 mb-5 text-white font-weight-normal"><strong>Dinas Perhubungan Maluku Tengah</strong></h1>
                                    </div>
                                    <form class="user" >
                                      
                                        <input type="hidden" />
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                          
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>

</html>