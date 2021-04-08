@extends('layouts.user')

@section('title','Ubah Kata Sandi')

@section('style')

    <style>
        small {
            float: right;
        }

        span.field-icon {
            position: absolute;
            display: inline-block;
            cursor: pointer;
            right: 1.6rem;
            top: 2.75rem;
            z-index: 2;
        }

    </style>


@endsection



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="container d-flex justify-content-center">
                    <div class="card mt-5 px-4 pt-4 pb-2">
                        <div class="media p-2"> <img src="https://imgur.com/yVjnDV8.png" class="mr-1 align-self-start">
                            <div class="media-body">
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <h6 class="mt-2 mb-0">{{Auth::user()->name}}</h6>
                            </div>
                        </div>
                        <ul class="list text-muted mt-3 pl-0">
                            <li @if(Request::is('user/biodata')) class="option-active" @endif><a href="{{url('user/biodata')}}" style="color: inherit" ><i class="fa fa-user mr-3 ml-2"></i> Biodata Saya</a></li>
                            <li @if(Request::is('user/dokumen')) class="option-active" @endif><a href="{{url('user/dokumen')}}" style="color: inherit" ><i class="fa fa-file mr-3 ml-2"></i> Dokumen Saya</a></li>
                            <li @if(Request::is('user/ubah_katasandi')) class="option-active" @endif><a href="{{url('user/ubah_katasandi')}}" style="color: inherit" ><i class="fa fa-lock mr-3 ml-2"></i> Ubah Kata Sandi </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <form action="{{url('user/ubah_katasandi/update')}}" method="post">
                    @csrf
                    <div class="row">
                        <h3 class="mt-5">Ubah Kata Sandi</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Kata Sandi Saat Ini</label>
                                <input id="input-pwd-saatini" minlength="8" type="password" class="form-control @error('password') is-invalid @enderror" name="passwordsaatini" required >
                                <span toggle="#input-pwd-saatini" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="noktp">Kata Sandi Baru</label>
                                <input id="input-pwd-baru" minlength="8" type="password" class="form-control @error('password') is-invalid @enderror" name="passwordbaru" required >
                                <span toggle="#input-pwd-baru" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nohp">Ulangi Kata Sandi Baru</label>
                                <input id="input-pwd-ulang" minlength="8" type="password" class="form-control @error('password') is-invalid @enderror" name="passwordulang" required >
                                <span toggle="#input-pwd-ulang" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button style="float: right" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>



@endsection


@section('script')
    <script type="text/javascript">
        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif
    </script>
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

    @endsection
