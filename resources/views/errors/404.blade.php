<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/app.css">
    <style type="text/css">
        body {
            margin-top: 150px;
        }
    </style>
</head>

<body>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page No Results Found.</h3>

                <p>
                    Mohon Maaf ini terjadi saat halaman tidak di temukan dan
                </p>
                <p>
                    Terdekteksi boot segera reload halaman atau <a href="{{ route('dashboard') }}">Kembali ke home</a>
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
</body>

</html>