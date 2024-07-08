<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="orange" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default" data-select2-id="37">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
    <title>Login</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo2.jpg')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/material.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">

            <div class="container">

                <div class="account-logo">
                    <a href="admin-dashboard.html"><img src="{{ asset('assets/img/logo2.jpg')}}" alt="Dreamguy's Technologies" style="width: 150px"></a>
                </div>

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Login</h3>
                        <p class="account-subtitle">Access to our dashboard</p>

                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        <form method="POST" action="/login">
                            @csrf
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email Address</label>
                                <input name="email" class="form-control" type="text">
                            </div>
                            <div class="input-block mb-4">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="col-form-label">Password</label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="">
                                            Forgot password?
                                        </a>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <input name="password" class="form-control" type="password"s id="password">
                                    <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
                                </div>
                            </div>
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Login</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.7.1.min.js')}}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/app.js')}}" type="text/javascript"></script>
    <script src="{{ asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="b088b91653b1af364f2aee96-|49" defer></script>
</body>

</html>
