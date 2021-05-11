<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <style>
        span.field-icon {
            position: absolute;
            display: inline-block;
            cursor: pointer;
            right: 0.7rem;
            top: 1rem;
            z-index: 2;
        }
    </style>

    <title>Register</title>
</head>
<body>
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image" style="background-image: url({{asset('images/logo.png')}});"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Daftar Akun Baru</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-label-group">
                                    <input id="nama" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus >
                                    <label for="inputEmail">Nama Lengkap (Sesuai KTP)</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required >
                                    <label for="inputEmail">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="no_ktp" minlength="16" maxlength="16" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp"  required >
                                    <label for="inputEmail">Nomor KTP</label>
                                    @error('no_ktp')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="no_hp" class="form-control @error('no_ktp') is-invalid @enderror" name="no_hp"  required>
                                    <label for="inputEmail">Nomor HP</label>
                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="input-pwd" name="password" class="form-control @error('password') is-invalid @enderror"  required>
                                    <label for="inputPassword">Kata Sandi</label>
                                    <span toggle="#input-pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <button class="btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2" style="  background-color: #e46931; color: white" type="submit">Daftar Sekarang</button>
                                <div class="text-center">
                                    Sudah punya akun? <a class="medium" href="{{ route('login') }}">Masuk Sekarang</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script type="text/javascript">

    $('.toggle-password').on('click', function() {
        $(this).toggleClass('fa-eye fa-eye-slash');
        let input = $($(this).attr('toggle'));
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
        }
        else {
            input.attr('type', 'password');
        }
    });
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
</body>
</html>
