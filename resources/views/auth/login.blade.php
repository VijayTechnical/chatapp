@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">

                    <div class="card-body">
                        <div class="row mt-5 text-center">
                            <div class="col-md-12">
                                <img src="{{ asset('form/logo.svg') }}" alt="">
                            </div>
                            <div class="col-md-12">
                                <h1 class="mt-2" style="font-size:16px;font-weight:500;">Sign in to continue</h1>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="mx-5 my-5">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="email" type="email" style="putline:none;"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="password" type="password" style="putline:none;"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 offset-md-12">
                                    <button type="submit" class="btn btn-primary" style="width: 100%; padding:10px 10px;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row my-2 text-center">
                                <div class="col-md-12">
                                    <h2 style="font-size: 20px;margin-top:2px;">OR</h2>
                                </div>
                                <div class="col-md-12">
                                    <a href="#" style="text-decoration: none;font-size:18px;">Register</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
